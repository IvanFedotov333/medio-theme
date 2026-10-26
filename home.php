<?php get_header(); ?>
<main class="flex-grow-1">
      <!-- Хлебные крошки + заголовок -->
      <section class="page-hero">
        <div class="container">
          <div class="page-hero__content">
            <?php
                // Получаем данные из настроек, если пусто - ставим дефолт
                $blog_title = get_field('blog_hero_title', 'option') ?: 'Наш блог';
$blog_desc  = get_field('blog_hero_desc', 'option') ?: 'Простые эстетические решения для уверенной улыбки каждый день.';
?>
            <h1 class="page-hero__header"><?php echo esc_html($blog_title); ?></h1>
            <p class="page-hero__desc">
              <?php echo esc_html($blog_desc); ?>
            </p>
            <nav class="page-hero__crumbs" aria-label="Хлебные крошки">
              <a href="<?php echo esc_url(home_url('/')); ?>">Главная</a>
              <span aria-hidden="true">/</span>
              <span>Блог</span>
            </nav>
          </div>
        </div>
      </section>

      <!-- Сетка карточек -->
      <section class="blog-archive">
        <div class="container">
          <?php
          $blog_args = array(
  'post_type'      => 'post',
  'posts_per_page' => -1, // -1 значит вывести все посты (или поставь 6, 9 и т.д.)
  'order'          => 'ASC', // <--- ВОТ ОНО, СНАЧАЛА НОВЫЕ
  'orderby'        => 'date'
          );
$blog_query = new WP_Query($blog_args);

if ($blog_query->have_posts()) : ?>
                <div class="row g-4">
                    <?php
          $i = 0; // Счетчик для чередования классов картинок
    while ($blog_query->have_posts()) : $blog_query->the_post();
        // Получаем категорию
        $categories = get_the_category();
        $cat_name = ! empty($categories) ? esc_html($categories[0]->name) : 'Без категории';

        // Получаем картинку (если нет - ставим заглушку)
        $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
        if(!$thumb_url) {
            $thumb_url = get_template_directory_uri() . '/assets/images/okay-man.webp';
        }
        ?>
                        <div class="col-12 col-md-6 col-lg-4">
                            <a href="<?php the_permalink(); ?>" class="post-card">
                                <div class="post-card__img" style="background-image: url('<?php echo esc_url($thumb_url); ?>');"></div>
                                <div class="post-card__info">
                                    <span class="post-card__category"><?php echo $cat_name; ?></span>
                                    <h3 class="post-card__title">
                                        <?php the_title(); ?>
                                    </h3>
                                </div>
                            </a>
                        </div>
                    <?php
                    $i++;
    endwhile;
    wp_reset_postdata(); // ОБЯЗАТЕЛЬНО сбрасываем кастомный запрос
    ?>
                </div>
          <?php else : ?>
                <div class="row">
                    <div class="col-12 text-center py-5">
                        <p>Пока записей нет.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
      </section>
     
    <?php get_template_part('templates/section', 'cta'); ?>
</main>
<?php get_footer(); ?>