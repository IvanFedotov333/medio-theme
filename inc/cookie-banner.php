<?php
function medio_cookie_consent_banner()
{
    if (isset($_COOKIE['medio_cookie_consent'])) {
        return;
    }
    ?>
    <div id="medio-cookie-banner">
        <p>Мы используем файлы cookie для улучшения работы сайта. Продолжая использовать сайт, вы соглашаетесь с нашей <a href="<?php echo esc_url(get_privacy_policy_url()); ?>" target="_blank">Политикой конфиденциальности</a>.</p>
        <button class="medio-cookie-btn" id="medio-accept-cookies">Принять</button>
    </div>
    <?php
}
add_action('wp_footer', 'medio_cookie_consent_banner');
