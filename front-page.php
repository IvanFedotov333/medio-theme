<?php get_header(); ?>


<!-- HERO-section -->

<main class="flex-grow-1">
      <?php
// Получаем данные из ACF
$hero_title = get_field('hero_title');
$hero_descr = get_field('hero_descr');
$hero_img   = get_field('hero_img');
$btn_text   = get_field('hero_btn_text');
$btn_link   = get_field('hero_btn_url');

// Логика для кнопки
$btn_url = !empty($btn_link['url']) ? $btn_link['url'] : '/appointment/'; // Если пусто, ведем на запись
$btn_target = !empty($btn_link['target']) ? 'target="' . esc_attr($btn_link['target']) . '"' : '';
?>

<section class="hero">
    <div class="container-fluid px-0">
        <div class="row g-0 g-lg-4">
            <div class="col-lg-6">
                <div class="hero__content">
                    
                    <!-- Выводим заголовок с разрешенным HTML -->
                    <h1 class="hero__header">
                        <?php echo wp_kses_post($hero_title); ?>
                    </h1>
                    
                    <!-- Выводим описание -->
                    <p class="hero__description">
                        <?php echo esc_html($hero_descr); ?>
                    </p>
                    
                    <!-- Выводим кнопку -->
                    <a href="<?php echo esc_url($btn_url); ?>" <?php echo $btn_target; ?> class="hero__btn">
                        <?php echo esc_html($btn_text); ?>
                        <span class="hero__btn-circle"></span>
                    </a>
                    
                </div>
            </div>
            <div class="col-lg-6">
                <!-- Выводим картинку в фон -->
                <div class="hero__image" style="background-image: url('<?php echo esc_url($hero_img); ?>');"></div>
            </div>
        </div>
    </div>
</section>

<!-- MARQUEE-section -->

      <?php
// Получаем данные из ACF для бегущей строки
$marq_email = get_field('marquee_email') ?: 'mediodental@gmail.com';
$marq_phone = get_field('marquee_phone') ?: '+7(987)654-32-10';

// Получаем ссылки на соцсети (с подстраховкой)
$marq_vk = get_field('marquee_vk') ?: '#';
$marq_tg = get_field('marquee_tg') ?: '#';
$marq_yt = get_field('marquee_yt') ?: '#';
?>

<section class="marquee">
    <div class="marquee__track">
        <?php
        // Запускаем цикл, чтобы продублировать блок 4 раза для плавной анимации
        for ($i = 0; $i < 4; $i++) :
            ?>
            <!-- Если это копия для анимации, скрываем её от скринридеров (aria-hidden) -->
            <div class="marquee__group" <?php echo $i > 0 ? 'aria-hidden="true"' : ''; ?>>
                
                <!-- Соцсети -->
                <div class="marquee__socials">
                    <a href="<?php echo esc_url($marq_vk); ?>" class="marquee__icon" aria-label="ВКонтакте">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor"><path d="M9 16V8.5h2.5l.5-3H9V4c0-.8.3-1.5 1.5-1.5h1.3V.1C11.5 0 10.5 0 9.5 0 7 0 5.5 1.5 5.5 4v1.5H3v3h2.5V16h3.5z"/></svg>
                    </a>
                    <a href="<?php echo esc_url($marq_tg); ?>" class="marquee__icon" aria-label="Telegram">
                        <!-- Тут должен быть твой SVG для телеграма из оригинала -->
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor"><path d="M15 3.5c-.5.2-1 .4-1.6.4.6-.3 1-.9 1.2-1.5-.5.3-1.1.5-1.8.7C12.3 2.5 11.5 2 10.7 2c-1.5 0-2.8 1.2-2.8 2.8 0 .2 0 .4.1.6C5.7 5.3 3.4 4.1 1.9 2.3c-.3.4-.4.9-.4 1.4 0 1 .5 1.8 1.2 2.3-.4 0-.8-.1-1.2-.3v.1c0 1.3 1 2.5 2.2 2.7-.2.1-.5.1-.7.1-.2 0-.3 0-.5-.1.3 1.1 1.4 1.9 2.6 1.9-1 .8-2.2 1.2-3.5 1.2H1c1.2.8 2.7 1.3 4.3 1.3 5.2 0 8-4.3 8-8v-.4c.6-.4 1-.9 1.4-1.5z"/></svg>
                    </a>
                    <a href="<?php echo esc_url($marq_yt); ?>" class="marquee__icon" aria-label="YouTube">
                        <!-- Тут должен быть твой SVG для ютуба из оригинала -->
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor"><path d="M15.6 4.5c-.2-.8-.8-1.4-1.6-1.6C12.5 2.5 8 2.5 8 2.5s-4.5 0-6 .4c-.8.2-1.4.8-1.6 1.6C0 6 0 8 0 8s0 2 .4 3.5c.2.8.8 1.4 1.6 1.6 1.5.4 6 .4 6 .4s4.5 0 6-.4c.8-.2 1.4-.8 1.6-1.6.4-1.5.4-3.5.4-3.5s0-2-.4-3.5zM6.4 10.5v-5l4 2.5-4 2.5z"/></svg>
                    </a>
                </div>
                
                <!-- Email -->
                <span class="marquee__item"><?php echo esc_html($marq_email); ?></span>
                <span class="marquee__item">/</span>
                
                <!-- Телефон -->
                <span class="marquee__item"><?php echo esc_html($marq_phone); ?></span>
            </div>
        <?php endfor; ?>
    </div>
</section>

<!-- ABOUT-section -->

      <?php
$about_label    = get_field('about_label') ?: ' О нас';
$about_descr    = get_field('about_descr');
$about_btn_text = get_field('about_btn_text') ?: 'Подробнее о Нас';
$about_btn_link = get_field('about_btn_url');
$about_btn_url = (is_array($about_btn_link) && !empty($about_btn_link['url']))
    ? $about_btn_link['url']
    : get_permalink(get_page_by_path('about'));
?>

<section class="about">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex flex-column align-items-center text-center">
                <div class="about__badge d-flex align-items-center gap-2">
                    <span class="about__badge-slash">//</span>
                    <span><?php echo esc_html($about_label); ?></span>
                </div>
                <h2 class="about__header">
                    <?php echo wp_kses_post($about_descr); ?>
                </h2>
                <a href="<?php echo esc_url($about_btn_url); ?>" class="about__btn d-inline-flex align-items-center gap-3">
                    <?php echo esc_html($about_btn_text); ?>
                    <span class="about__btn-circle"></span>
                </a>
            </div>
        </div>

        <div class="gallery">
            <div class="gallery__stage">
                <?php for($i = 1; $i <= 5; $i++) :
                    $img_url = get_field('about_img_' . $i);
                    if($img_url) :
                        $positions = ['pos--2', 'pos--1', 'pos-0', 'pos-1', 'pos-2'];
                        ?>
                    <div class="gallery__item <?php echo esc_attr($positions[$i - 1]); ?>">
                        <img src="<?php echo esc_url($img_url); ?>" alt="" />
                    </div>
                <?php endif; endfor; ?>
            </div>
        </div>

        <div class="highlight">
            <div class="row g-4">
                <?php for($i = 1; $i <= 4; $i++) :
                    $card_num = get_field('about_card_' . $i . '_num');
                    $card_label = get_field('about_card_' . $i . '_label');
                    if($card_num) :
                        ?>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="highlight__card">
                        <div class="highlight__label"><?php echo esc_html($card_label); ?></div>
                        <div class="highlight__number"><?php echo esc_html($card_num); ?></div>
                    </div>
                </div>
                <?php endif; endfor; ?>
            </div>
        </div>
    </div>
</section>

<!-- BENEFITS-section -->

<?php
$benefits_label = get_field('benefits_label') ?: 'Преимущества';
$benefits_title = get_field('benefits_title');
?><section class="benefits position-relative overflow-hidden">
        <!-- Фон — абсолютный слой -->
        <div
          class="benefits__bg position-absolute top-0 start-0 w-100 h-100"
        ></div>
        <!-- Контейнер -->

        <!-- Карточка -->
        <div class="benefits__card p-5 text-center text-lg-start">
          <div class="row align-items-center g-4">
            <!-- Левая колонка -->
            <div class="col-lg-6">
              <div
                class="benefits__badge d-flex align-items-center gap-2 mb-4 justify-content-center justify-content-lg-start"
              >
                <span class="benefits__badge-slash">//</span>
                <span><?php echo esc_html($benefits_label); ?></span>
              </div>
              <h2 class="benefits__header mb-0">
                <?php echo wp_kses_post($benefits_title); ?>
              </h2>
            </div>

            <!-- Правая колонка -->
            <div class="col-lg-6">
              <div
                class="benefits__tags d-flex flex-wrap gap-3 justify-content-center justify-content-lg-end"
              >
                <?php for($i = 1; $i <= 4; $i++) :
                    $tag = get_field('benefits_tag_' . $i);
                    if($tag): ?><span class="benefits__tag"><?php echo esc_html($tag); ?></span>
    <?php endif; endfor; ?>
              </div>
            </div>
          </div>
        </div>
      </section>

<!-- SERVICES-section -->

<section class="services">
        <div class="container">
          <!-- Заголовок -->
          <div class="services__header-wrap">
            <div class="services__badge d-flex align-items-center gap-2">
              <span class="services__badge-slash">//</span>
              <span>Услуги</span>
            </div>
            <h2 class="services__header">
              Комплексные <span class="services__header-accent">Услуги</span>
            </h2>
          </div>
           <?php
                    $services_query = new WP_Query(array(
                       'post_type'      => 'services',
                       'posts_per_page' => 4,
                       'order'          => 'ASC',
                    ));

if ($services_query->have_posts()) :
    $i = 0; // Счетчик для классов
    // Массив классов в том порядке, в котором они идут в макете
    $img_classes = ['lg', 'md', 'sm', 'xs'];

    while ($services_query->have_posts()) : $services_query->the_post();

        // Берем класс из массива по индексу. Если записи закончатся, возьмем 'md' по умолчанию.
        $size_class = isset($img_classes[$i]) ? $img_classes[$i] : 'md';

        // Получаем ссылку на картинку в размере 'large' (чтобы не грузить оригинал 3000px)
        $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
        ?>
        
        <div class="services__row">
            <a href="<?php echo esc_url(get_permalink()); ?>" class="services__card">
                <?php the_title(); ?>
            </a>
            <!-- Подставляем динамический класс -->
            <div class="services__img services__img--<?php echo esc_attr($size_class); ?>" style="background-image: url('<?php echo esc_url($img_url); ?>');"></div>
        </div>

    <?php
    $i++; // Увеличиваем счетчик
    endwhile;
    wp_reset_postdata();
endif;
?>
    
        </div>
      </section>

<!-- PROCESS-section -->

<?php
$process_label = get_field('process_label') ?: ' Процесс';
$process_title = get_field('process_title');
?>
      <section class="process">
        <div class="container">
          <!-- Заголовок -->
          <div class="process__head text-center">
            <div
              class="process__badge d-flex align-items-center justify-content-center gap-2"
            >
              <span class="process__badge-slash">//</span>
              <span><?php echo esc_html($process_label); ?></span>
            </div>
            <h2 class="process__header">
              <?php echo wp_kses_post($process_title); ?>
            </h2>
          </div>
<?php for($i = 1; $i <= 3; $i++) :
    $img_url = get_field('process_img_' . $i);
    $title   = get_field('process_title_' . $i);
    $desc    = get_field('process_desc_' . $i);

    if($title) :
        ?>
          <!-- Карточка 1 -->
          <div class="process__card">
            <div class="process__img" style="background-image: url('<?php echo esc_url($img_url); ?>');"></div>
            <div class="process__info">
              <h3 class="process__title"><?php echo esc_html($title); ?></h3>
              <p class="process__desc">
                <?php echo esc_html($desc); ?>
              </p>
            </div>
          </div><?php endif; endfor; ?>
        </div>
      </section>

<!-- TESTIMONIALS-section -->
<?php
$testimonials_label = get_field('testimonials_label') ?: ' Отзывы';
$testimonials_title = get_field('testimonials_title');
?>
      <section class="testimonials">
        <div class="container">
          <div class="testimonials__head text-center">
            <div
              class="testimonials__badge d-flex align-items-center justify-content-center gap-2"
            >
              <span class="testimonials__badge-slash">//</span>
              <span><?php echo esc_html($testimonials_label); ?></span>
            </div>
            <h2 class="testimonials__header">
              <?php echo wp_kses_post($testimonials_title); ?>
            </h2>
          </div>

          <div class="testimonials__panel">
            <?php
            // Запрашиваем отзывы из базы
            $testimonials_query = new WP_Query(array(
                'post_type'      => 'testimonials',
                'posts_per_page' => 3, // Выводим 3 штуки, как в макете
                'order' => 'ASC',
            ));

if ($testimonials_query->have_posts()) :
    $i = 1; // Счетчик для логики открытого отзыва
    while ($testimonials_query->have_posts()) : $testimonials_query->the_post();

        // Получаем поля ACF
        $city = get_field('testimonial_city');
        $date = get_field('testimonial_date');
        $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');

        // Логика: если это третий отзыв, делаем его активным по умолчанию
        $is_active = ($i === 3) ? 'is-active' : '';
        $aria_expanded = ($i === 3) ? 'true' : 'false';
        ?>
            <!-- Отзыв  -->
            <article class="testimonial <?php echo esc_attr($is_active); ?>" data-testimonial>
              <button
                class="testimonial__header"
                type="button"
                aria-expanded="<?php echo esc_attr($aria_expanded); ?>"
              >
                <span class="testimonial__city"><?php echo esc_html($city); ?></span>
                <span class="testimonial__name"><?php the_title(); ?></span>
                <span class="testimonial__arrow" aria-hidden="true"></span>
              </button>
              <div class="testimonial__body">
                <div class="testimonial__body-inner">
                  <div class="row g-4 align-items-end">
                    <div class="col-12 col-md-4">
                      <div class="testimonial__photo" style="background-image: url('<?php echo esc_url($img_url); ?>');"></div>
                    </div>
                    <div class="col-12 col-md-8">
                      <p class="testimonial__date"><?php echo esc_html($date); ?></p>
                      <p class="testimonial__text">
    <?php echo wp_strip_all_tags(get_the_content()); ?>
</p>
                    </div>
                  </div>
                </div>
              </div>
            </article>
<?php
            $i++;
    endwhile;
    wp_reset_postdata(); // Обязательно сбрасываем запрос
else :
    echo '<p class="text-center">Отзывов пока нет.</p>';
endif;
?>
          </div>
        </div>
      </section>
      <section class="blog">
        <?php
        $blog_label = get_field('blog_label') ?: ' Блог';
$blog_title = get_field('blog_title'); ?>

        <div class="container">
          <div class="blog__head">
            <div class="blog__head-left">
              <div class="blog__badge d-flex align-items-center gap-2">
                <span class="blog__badge-slash">//</span>
                <span><?php echo esc_html($blog_label); ?></span>
              </div>
              <h2 class="blog__header">
                <?php echo wp_kses_post($blog_title); ?>
              </h2>
            </div>

            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="blog__btn">
              <span>Все Статьи</span>
              <span class="blog__btn-circle" aria-hidden="true"></span>
            </a>
          </div>

          <div class="row g-4">
           <?php
           $img_classes = array(
                'post-card__img--short',
                'post-card__img--tall',
                'post-card__img--short',
                'post-card__img--tall'
           );
$blog_query = new WP_Query(array(
  'post_type' => 'post',
  'posts_per_page' => 4,
  'post_status' => 'publish',
  'order' => 'ASC'
));

if($blog_query->have_posts()) : $i = 0;
    while($blog_query->have_posts()) : $blog_query -> the_post();
        $current_class = $img_classes[$i % 4];
        $categories = get_the_category();
        $cat_name = ! empty($categories) ? esc_html($categories[0]->name) : 'Без категории';

        $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
        if(!$thumb_url) {
            $thumb_url = get_template_directory_uri() . '/assets/images/okay-man.webp';
        }
        ?>
            <!-- Карточка 1 — короткая -->
            <div class="col-12 col-md-6 col-lg-3">
              <a href="<?php the_permalink();?>" class="post-card">
                <div
                  class="post-card__img <?php echo esc_attr($current_class);?>"
                  style="background-image: url('<?php echo esc_url($thumb_url);?>');"
                ></div>
                <div class="post-card__info">
                  <span class="post-card__category"><?php echo $cat_name; ?></span>
                  <h3 class="post-card__title">
                    <?php the_title();?>
                  </h3>
                </div>
              </a>
            </div>

           <?php $i++;
    endwhile;
    wp_reset_postdata();
else :
    echo '<div class="col-12"><p>Записей пока нет.</p></div>';
endif; ?>
          </div>
        </div>
      </section>
      <?php get_template_part('templates/section', 'cta'); ?>
    </main>

<?php get_footer(); ?>