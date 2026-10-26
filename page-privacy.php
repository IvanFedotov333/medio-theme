<?php
/**
 * Template Name: Политика конфиденциальности
 */
get_header();
?>

<main class="flex-grow-1">
    <section class="page-hero">
        <div class="container">
            <div class="page-hero__content">
                <h1 class="page-hero__header"><?php the_title(); ?></h1>
                <p class="page-hero__desc">
                    Как мы обрабатываем и защищаем ваши персональные данные.
                </p>
                <nav class="page-hero__crumbs" aria-label="Хлебные крошки">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Главная</a>
                    <span aria-hidden="true">/</span>
                    <span><?php the_title(); ?></span>
                </nav>
            </div>
        </div>
    </section>

    <section class="privacy">
        <div class="container">
            <div class="privacy__content">
                <?php
                // Выводим контент из редактора Гутенберга
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        the_content();
                    endwhile;
                endif;
?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>