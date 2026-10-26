<?php get_header();?>
<main class="flex-grow-1">
      <section class="page-hero">
        <div class="container">
          <div class="page-hero__content">
            <h1 class="page-hero__header">Наши Услуги</h1>
            <p class="page-hero__desc">
              Изучите наши стоматологические услуги — для здоровой, сияющей и
              уверенной улыбки.
            </p>
            <nav class="page-hero__crumbs" aria-label="Хлебные крошки">
              <a href="<?php echo esc_url(home_url('/')); ?>">Главная</a>
              <span aria-hidden="true">/</span>
              <span>Услуги</span>
            </nav>
          </div>
        </div>
      </section>

      <section class="services services--page">
        <div class="container">
          <?php
          // Основной цикл WordPress для архива
          if (have_posts()) :
              while (have_posts()) : the_post();
                  $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                  ?>
          <div class="services__row">
            <a href="<?php echo esc_url(get_permalink()); ?>" class="services__card"><?php the_title(); ?></a>
            <div class="services__img services__img--page" style="background-image: url('<?php echo esc_url($img_url); ?>');"></div>
          </div>
<?php
              endwhile;
          else :
              echo '<p>Услуги пока не добавлены.</p>';
          endif;
?>
          
        </div>
      </section>
      
      <?php get_template_part('templates/section', 'cta'); ?>
    </main>
<?php get_footer();?>