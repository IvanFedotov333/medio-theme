<?php get_header(); ?>
    <main class="flex-grow-1">
      <?php
    // Начинаем цикл WordPress
    if (have_posts()) :
        while (have_posts()) : the_post();

            // Получаем картинку записи
            $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
            // Получаем краткое описание (создадим поле в ACF чуть позже)
            $short_desc = get_field('service_desc');
            $price = get_field('service_price');
            ?>
      <section class="page-hero">
        <div class="container">
          <div class="page-hero__content">
            <h1 class="page-hero__header"><?php the_title(); ?></h1>
            <?php if($short_desc) : ?>
                    <p class="page-hero__desc"><?php echo esc_html($short_desc); ?></p>
            <?php endif; ?>
            <nav class="page-hero__crumbs" aria-label="Хлебные крошки">
              <a href="<?php echo esc_url(home_url('/')); ?>">Главная</a>
              <span aria-hidden="true">/</span>
              <a href="<?php echo esc_url(get_post_type_archive_link('services')); ?>">Услуги</a>
              <span aria-hidden="true">/</span>
              <span><?php the_title(); ?></span>
            </nav>
          </div>
        </div>
      </section>

      <section class="service-single">
        <div class="container">
          <!-- Большое фото -->
          <div class="service-single__cover" style="background-image: url('<?php echo esc_url($img_url); ?>');" aria-hidden="true"></div>

          <!-- Контент -->
          <div class="service-single__content">
            <?php the_content(); ?>
<?php if ($price) : ?>
                <div class="service-single__price-wrap">
                    <span class="service-single__price-label">Стоимость:</span>
                    <span class="service-single__price-value"><?php echo esc_html($price); ?></span>
                </div>
            <?php endif; ?>
            <a href="<?php echo esc_url(home_url('/appointment/')); ?>" class="service-single__btn">
              <span>Записаться на приём</span>
              <span
                class="service-single__btn-circle"
                aria-hidden="true"
              ></span>
            </a>
          </div>
        </div>
      </section>
       <?php get_template_part('templates/section', 'cta'); ?>
      <?php
        endwhile;
    endif;
?>
    </main>
<?php get_footer(); ?>
