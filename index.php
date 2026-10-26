<?php get_header(); ?>

<main class="main flex-grow-1">
    <div class="container py-5">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post(); ?>
                
                <!-- Базовый вывод для любой страницы, если нет спецшаблона -->
                <h1 class="mb-4"><?php the_title(); ?></h1>
                <div class="content">
                    <?php the_content(); ?>
                </div>

            <?php endwhile;
        else : ?>
            <h1>Ничего не найдено</h1>
            <p>К сожалению, по вашему запросу ничего не найдено.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>