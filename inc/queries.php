<?php

// Меняем порядок вывода врачей в архиве (от старых к новым)
add_action('pre_get_posts', 'medio_doctors_archive_order');
function medio_doctors_archive_order($query)
{
    // Проверяем, что мы не в админке и что это главный запрос архива врачей
    if (! is_admin() && $query->is_main_query() && is_post_type_archive('doctors')) {
        $query->set('order', 'ASC'); // ASC = по возрастанию, DESC = по убыванию
        $query->set('orderby', 'date'); // Сортировать по дате
    }
}
// Меняем порядок вывода услуг в архиве (от старых к новым)
add_action('pre_get_posts', 'medio_services_archive_order');
function medio_services_archive_order($query)
{
    // Проверяем, что мы не в админке и что это главный запрос архива услуг
    if (! is_admin() && $query->is_main_query() && is_post_type_archive('services')) {
        $query->set('order', 'ASC'); // ASC = по возрастанию, DESC = по убыванию
        $query->set('orderby', 'date'); // Сортировать по дате
    }
}
