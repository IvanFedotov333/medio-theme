<?php

function medio_enqueue_scripts()
{
    // 1. Главный файл style.css (обязателен для WP)
    wp_enqueue_style('medio-theme-style', get_stylesheet_uri());

    // 2. Сброс стилей и шрифты (пути теперь без assets/)
    wp_enqueue_style('medio-reset', get_template_directory_uri() . '/css/reset.css');
    wp_enqueue_style('medio-fonts', get_template_directory_uri() . '/css/fonts.css');

    // 3. Bootstrap
    wp_enqueue_style('medio-bootstrap-css', get_template_directory_uri() . '/libs/bootstrap/css/bootstrap.min.css');
    wp_enqueue_script('medio-bootstrap-js', get_template_directory_uri() . '/libs/bootstrap/js/bootstrap.bundle.min.js', array(), '5.0.0', true);

    // 4. Основные стили сайта
    wp_enqueue_style('medio-main-css', get_template_directory_uri() . '/css/style.css');

    // 5. Основной JS скрипт
    wp_enqueue_script('medio-main-js', get_template_directory_uri() . '/js/main.js', array(), '1.0', true);
    wp_localize_script('medio-main-js', 'ajax_object', array(
    'ajax_url' => admin_url('admin-ajax.php'),
    'nonce'    => wp_create_nonce('appointment_nonce') // Передаем nonce в JS
));
}
add_action('wp_enqueue_scripts', 'medio_enqueue_scripts');
