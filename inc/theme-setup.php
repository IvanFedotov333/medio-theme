
<?php
function medio_theme_setup()
{
    add_theme_support('title-tag');
    // Разрешаем теме поддерживать изображения записей
    add_theme_support('post-thumbnails');
    // Добавляем поддержку меню
    add_theme_support('menus');

    // Регистрируем места для меню
    register_nav_menus(array(
        'header_menu' => 'Меню в шапке',
        'footer_menu_main' => 'Подвал: Основные',
        'footer_menu_company' => 'Подвал: Компания'
    ));
}
add_action('after_setup_theme', 'medio_theme_setup');
// Добавляем класс footer__link к ссылкам в меню подвала
add_filter('nav_menu_link_attributes', 'add_footer_menu_link_class', 10, 3);
function add_footer_menu_link_class($atts, $item, $args)
{
    if ($args->theme_location === 'footer_menu_main' || $args->theme_location === 'footer_menu_company') {
        $atts['class'] = 'footer__link';
    }
    return $atts;
}
// Создание страницы настроек темы для ACF

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'    => 'Настройки темы',
        'menu_title'    => 'Настройки темы',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'manage_options',
        'redirect'      => false
    ));
}
