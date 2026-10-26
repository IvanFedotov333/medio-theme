<?php

function medio_register_cpt()
{
    // Услуги
    register_post_type('services', array(
        'labels' => array('name' => 'Услуги', 'singular_name' => 'Услуга'),
        'public' => true, 'has_archive' => true, 'menu_icon' => 'dashicons-clipboard',
        'supports' => array('title', 'editor', 'thumbnail'),
        'rewrite' => array('slug' => 'uslugi'), 'show_in_rest' => true,
        'show_in_nav_menus' => true,
    ));
    // Врачи
    register_post_type('doctors', array(
        'labels' => array('name' => 'Врачи', 'singular_name' => 'Врач'),
        'public' => true, 'has_archive' => true, 'menu_icon' => 'dashicons-businessperson',
        'supports' => array('title', 'editor', 'thumbnail'),
        'rewrite' => array('slug' => 'vrachi'), 'show_in_rest' => true,
        'show_in_nav_menus' => true,
    ));
    // Отзывы
    register_post_type('testimonials', array(
        'labels' => array(
            'name'          => 'Отзывы',
            'singular_name' => 'Отзыв',
            'add_new'       => 'Добавить отзыв',
            'add_new_item'  => 'Добавить новый отзыв',
            'edit_item'     => 'Редактировать отзыв',
        ),
        'public'       => true,
        'has_archive'  => false, // Нам не нужна отдельная страница со всеми отзывами
        'menu_icon'    => 'dashicons-format-quote', // Иконка кавычек
        'supports'     => array('title', 'editor', 'thumbnail'), // Заголовок (Имя), Текст (Отзыв), Картинка (Фото)
        'show_in_rest' => true, // Включаем Гутенберг
        'show_in_nav_menus' => false, // В меню их выводить не будем
    ));
}
add_action('init', 'medio_register_cpt');
