<?php get_header(); ?>

<main class="flex-grow-1">
    <?php
    // Запускаем цикл, чтобы получить данные текущего поста
    if (have_posts()) : while (have_posts()) : the_post();

        // Получаем картинку обложки (Featured Image)
        $cover_url = get_the_post_thumbnail_url(get_the_ID(), 'large');

        // Получаем категорию
        $categories = get_the_category();
        $cat_name = ! empty($categories) ? esc_html($categories[0]->name) : 'Без рубрики';
        $cat_link = ! empty($categories) ? esc_url(get_category_link($categories[0]->term_id)) : '#';

        // Получаем автора (если у поста указан автор)
        $author_id = get_the_author_meta('ID');
        $author_name = get_the_author();
        $author_role = get_the_author_meta('description'); // Берем из поля "Сведения" в профиле пользователя
        $author_avatar = get_avatar_url($author_id, array('size' => 150));
        if(empty($author_role)) {
            $author_role = 'Стоматолог'; // Заглушка, если не заполнено
        }
        ?>

    <!-- HERO секция поста -->
    <section class="page-hero">
        <div class="container">
            <div class="page-hero__content">
                <h1 class="page-hero__header">
                    <?php the_title(); ?>
                </h1>
                <?php if (has_excerpt()) : ?>
                    <p class="page-hero__desc">
                        <?php echo esc_html(get_the_excerpt()); ?>
                    </p>
                <?php endif; ?>
                
                <nav class="page-hero__crumbs" aria-label="Хлебные крошки">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Главная</a>
                    <span aria-hidden="true">/</span>
                    <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">Блог</a>
                    <span aria-hidden="true">/</span>
                    <span>Статья</span>
                </nav>
            </div>
        </div>
    </section>

    <!-- Основной контент поста -->
    <section class="post">
        <div class="container">
            
            <!-- Большое фото (если загружено) -->
            <?php if($cover_url) : ?>
                <div class="post__cover" style="background-image: url('<?php echo esc_url($cover_url); ?>');"></div>
            <?php endif; ?>

            <div class="post__body">
                <!-- ЛЕВАЯ КОЛОНКА (Сайдбар) -->
                <aside class="post__aside">
                    <div class="post-author">
                        <!-- Выводим аватар автора -->
                        <div class="post-author__avatar" style="background-image: url('<?php echo esc_url($author_avatar); ?>');"></div>
                        <div class="post-author__info">
                            <span class="post-author__name"><?php echo esc_html($author_name); ?></span>
                            <span class="post-author__role"><?php echo esc_html($author_role); ?></span>
                        </div>
                    </div>

                    <div class="post__divider"></div>

                    <div class="post__category">
                        <span class="post__category-label">Категория:</span>
                        <a href="<?php echo $cat_link; ?>" class="post__category-value"><?php echo $cat_name; ?></a>
                    </div>
                </aside>

                <!-- ПРАВАЯ КОЛОНКА (Текст статьи) -->
                <div class="post__content">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </section>

    <?php
    endwhile;
    endif;
?>

    <!-- Вызов глобальной CTA -->
    <?php get_template_part('templates/section', 'cta'); ?>
</main>

<?php get_footer(); ?>