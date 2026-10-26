<?php
/**
 * Обработчик AJAX-запроса для формы записи на прием
 */

add_action('wp_ajax_process_appointment', 'handle_appointment_form');
add_action('wp_ajax_nopriv_process_appointment', 'handle_appointment_form');

function handle_appointment_form()
{
    // 1. Проверка безопасности (Nonce)
    check_ajax_referer('appointment_nonce', 'nonce');

    // 2. Получаем и очищаем данные
    $name    = sanitize_text_field($_POST['name'] ?? '');
    $email   = sanitize_email($_POST['email'] ?? '');
    $phone   = sanitize_text_field($_POST['phone'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');
    $consent = isset($_POST['consent']) ? true : false;

    // 3. Валидация
    if (empty($name) || empty($email) || empty($phone)) {
        wp_send_json_error(['message' => 'Пожалуйста, заполните все обязательные поля.']);
    }

    if (!is_email($email)) {
        wp_send_json_error(['message' => 'Пожалуйста, введите корректный Email.']);
    }

    if (!$consent) {
        wp_send_json_error(['message' => 'Необходимо согласие на обработку персональных данных.']);
    }

    // 4. Формируем текст сообщения
    $text = "🔥 Новая запись на приём!\n\n";
    $text .= "👤 Имя: $name\n";
    $text .= "📧 Email: $email\n";
    $text .= "📞 Телефон: $phone\n";
    $text .= "💬 Сообщение: $message\n";

    // ==========================================
    // 5. Отправка в TELEGRAM
    $tg_token   = TG_BOT_TOKEN;
    $tg_chat_id = TG_CHAT_ID;
    // ==========================================

    $tg_url = "https://api.telegram.org/bot{$tg_token}/sendMessage";
    $tg_args = array(
        'body' => array(
            'chat_id' => $tg_chat_id,
            'text'    => $text,
        )
    );

    // Отправляем запрос к API Telegram
    $tg_response = wp_remote_post($tg_url, $tg_args);

    // 6. ОТПРАВКА НА ПОЧТУ (Запасной вариант)
    $to = get_option('admin_email');
    $subject = 'Новая запись на приём: ' . $name;
    $headers = ['Content-Type: text/plain; charset=UTF-8'];
    $mail_sent = wp_mail($to, $subject, $text, $headers);

    // 7. Проверяем, ушло ли хотя бы куда-то
    if (! is_wp_error($tg_response) && wp_remote_retrieve_response_code($tg_response) == 200) {
        // Если Telegram ответил 200 ОК
        wp_send_json_success(['message' => 'Спасибо! Ваша заявка отправлена. Мы свяжемся с вами.']);
    } elseif ($mail_sent) {
        // Если Telegram упал, но почта ушла
        wp_send_json_success(['message' => 'Спасибо! Ваша заявка отправлена. Мы свяжемся с вами.']);
    } else {
        // Если вообще всё сломалось
        wp_send_json_error(['message' => 'Ошибка отправки. Пожалуйста, позвоните нам напрямую.']);
    }
}

/**
 * Обработчик AJAX-запроса для формы Контактов
 */
add_action('wp_ajax_process_contact', 'handle_contact_form');
add_action('wp_ajax_nopriv_process_contact', 'handle_contact_form');

function handle_contact_form()
{
    // 1. Проверка безопасности (используем имя поля из HTML)
    if (! isset($_POST['nonce']) || ! wp_verify_nonce($_POST['nonce'], 'contact_form_action')) {
        wp_send_json_error(['message' => 'Ошибка безопасности. Обновите страницу.']);
    }

    // 2. Получаем и очищаем данные
    $name    = sanitize_text_field($_POST['fullname'] ?? '');
    $email   = sanitize_email($_POST['email'] ?? '');
    $phone   = sanitize_text_field($_POST['phone'] ?? '');
    $subject = sanitize_text_field($_POST['subject'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');
    $consent = isset($_POST['consent']) ? true : false;

    // 3. Валидация
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        wp_send_json_error(['message' => 'Пожалуйста, заполните все обязательные поля.']);
    }

    if (!is_email($email)) {
        wp_send_json_error(['message' => 'Пожалуйста, введите корректный Email.']);
    }

    if (!$consent) {
        wp_send_json_error(['message' => 'Необходимо согласие на обработку персональных данных.']);
    }

    // 4. Формируем текст сообщения
    $text = "📩 Новое сообщение с формы Контактов!\n\n";
    $text .= "👤 Имя: $name\n";
    $text .= "📧 Email: $email\n";
    $text .= "📞 Телефон: $phone\n";
    $text .= "📌 Тема: $subject\n";
    $text .= "💬 Сообщение: $message\n";

    // 5. Отправка в TELEGRAM
    $tg_token   = TG_BOT_TOKEN;
    $tg_chat_id = TG_CHAT_ID;

    $tg_url = "https://api.telegram.org/bot{$tg_token}/sendMessage";
    $tg_args = array(
        'body' => array(
            'chat_id' => $tg_chat_id,
            'text'    => $text,
        )
    );

    $tg_response = wp_remote_post($tg_url, $tg_args);

    // 6. Отправка на почту
    $to = get_option('admin_email');
    $mail_subject = 'Сообщение с сайта: ' . $subject;
    $headers = ['Content-Type: text/plain; charset=UTF-8'];
    $mail_sent = wp_mail($to, $mail_subject, $text, $headers);

    // 7. Проверка результата
    if (! is_wp_error($tg_response) && wp_remote_retrieve_response_code($tg_response) == 200) {
        wp_send_json_success(['message' => 'Спасибо! Ваше сообщение отправлено. Мы ответим вам в ближайшее время.']);
    } elseif ($mail_sent) {
        wp_send_json_success(['message' => 'Спасибо! Ваше сообщение отправлено. Мы ответим вам в ближайшее время.']);
    } else {
        wp_send_json_error(['message' => 'Ошибка отправки. Пожалуйста, свяжитесь с нами по телефону.']);
    }
}
