 <?php get_header();?>
 <?php
// Получаем данные для Hero из ACF
$hero_title = get_field('about_hero_title') ?: 'Наша Миссия — Сделать Вашу Улыбку Неотразимой';
$hero_desc  = get_field('about_hero_desc') ?: 'Используем современные технологии, чтобы обеспечить точную диагностику, индивидуальный план лечения и бережную заботу.';

// Обложка
$cover_img = get_field('about_cover_img');

// Партнеры
$partners_title = get_field('about_partners_title') ?: 'Наши партнёры';

// Ценности
$values_title = get_field('about_values_title') ?: 'Наши ценности';
$values_img   = get_field('about_values_img');

// Слоган врачей
$doctors_slogan = get_field('about_doctors_slogan') ?: 'Вы Можете Доверять нашей <span class="doctors-slogan__title-accent">Команде</span>';
?>
 <main class="flex-grow-1">
      <section class="page-hero">
        <div class="container">
          <div class="page-hero__content">
            <h1 class="page-hero__header">
                    <?php echo wp_kses_post($hero_title); ?>
              <!--  -->
            </h1>
            <p class="page-hero__desc">
              <?php echo esc_html($hero_desc); ?>
            </p>
            <nav class="page-hero__crumbs" aria-label="Хлебные крошки">
              <a href="<?php echo esc_url(home_url('/')); ?>">Главная</a>
              <span aria-hidden="true">/</span>
              <span>О нас</span>
            </nav>
          </div>
        </div>
      </section>

      <section class="about-page">
        <div class="container">
          <!-- Большое фото -->
          <div class="about-page__cover" aria-hidden="true"<?php if ($cover_img) {
              echo 'style="background-image: url(\'' . esc_url($cover_img) . '\');"';
          } ?>></div>

          <!-- Trusted Partners -->
          <div class="about-page__partners">
            <h2 class="about-page__partners-title"><?php echo esc_html($partners_title); ?></h2>
            <div class="row g-4">
              <?php for($i = 1; $i <= 4; $i++) :
                  $logo = get_field('about_partner_logo_' . $i);
                  if($logo) : ?>
                            <div class="col-6 col-lg-3">
                                <div class="partner-card">
                                    <img src="<?php echo esc_url($logo); ?>" alt="Партнёр <?php echo $i; ?>" class="partner-card__logo" />
                                </div>
                            </div>
                    <?php endif; endfor; ?>
            </div>
          </div>
        </div>
      </section>
      <section class="values">
        <div class="container">
          <div class="values__inner">
            <!-- Левая — белая карточка -->
            <div class="values__card">
              <h2 class="values__title"><?php echo esc_html($values_title); ?></h2>

              <ul class="values__list">
                <?php for($i = 1; $i <= 4; $i++) :
                    $item_title = get_field('about_values_item_' . $i);
                    $item_desc  = get_field('about_values_item_' . $i . '_desc');

                    if($item_title) : ?>
                                <li class="values__item">
                                    <h3 class="values__item-title">
                                        <?php echo esc_html($item_title); ?>
                                    </h3>
                                    <?php if($item_desc) : ?>
                                        <p class="values__item-desc">
                                            <?php echo esc_html($item_desc); ?>
                                        </p>
                                    <?php endif; ?>
                                </li>
                        <?php endif; endfor; ?>
              </ul>
            </div>

            <!-- Правая — фото -->
            <div class="values__photo" aria-hidden="true"<?php if($values_img) {
                echo 'style="background-image: url(\'' . esc_url($values_img) . '\');"';
            } ?>></div>
          </div>
        </div>
      </section>
      <section class="doctors">
        <div class="container">
          <div class="row g-4">
            <!-- 6 карточек -->
            <?php
                // Запрашиваем врачей из базы
                $doctors_query = new WP_Query(array(
                    'post_type'      => 'doctors',
                    'posts_per_page' => 5, // Выводим 5 врачей (как в макете)
                    'order'          => 'ASC',
                ));

if ($doctors_query->have_posts()) :
    $i = 1;
    while ($doctors_query->have_posts()) : $doctors_query->the_post();

        // Вставляем слоган после 4-го врача
        if ($i === 5) : ?>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="doctors-slogan">
                                    <div class="doctors-slogan__badge">
                                        <span class="doctors-slogan__slash">//</span>
                                        <span>Врачи</span>
                                    </div>
                                    <h2 class="doctors-slogan__title">
                                        <?php echo wp_kses_post($doctors_slogan); ?>
                                    </h2>
                                </div>
                            </div>
                        <?php endif;

        // Получаем поля для карточки врача
        $role = get_field('doctors_role'); // Поле из группы CPT doctors
        $photo_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
        ?>

                        <div class="col-12 col-md-6 col-lg-4">
                            <article class="doctor-card">
                                <div class="doctor-card__top">
                                    <div class="doctor-card__socials">
                                        <a href="#" class="doctor-card__social" aria-label="Facebook">
                                            <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M9 16V8.5h2.5l.5-3H9V4c0-.8.3-1.5 1.5-1.5h1.3V.1C11.5 0 10.5 0 9.5 0 7 0 5.5 1.5 5.5 4v1.5H3v3h2.5V16h3.5z"/></svg>
                                        </a>
                                        <a href="#" class="doctor-card__social" aria-label="Instagram">
                                            <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3"><rect x="1" y="1" width="14" height="14" rx="4" /><circle cx="8" cy="8" r="3.5" /><circle cx="12" cy="4" r="0.7" fill="currentColor" stroke="none" /></svg>
                                        </a>
                                        <a href="#" class="doctor-card__social" aria-label="Twitter">
                                            <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M15 3.5c-.5.2-1 .4-1.6.4.6-.3 1-.9 1.2-1.5-.5.3-1.1.5-1.8.7C12.3 2.5 11.5 2 10.7 2c-1.5 0-2.8 1.2-2.8 2.8 0 .2 0 .4.1.6C5.7 5.3 3.4 4.1 1.9 2.3c-.3.4-.4.9-.4 1.4 0 1 .5 1.8 1.2 2.3-.4 0-.8-.1-1.2-.3v.1c0 1.3 1 2.5 2.2 2.7-.2.1-.5.1-.7.1-.2 0-.3 0-.5-.1.3 1.1 1.4 1.9 2.6 1.9-1 .8-2.2 1.2-3.5 1.2H1c1.2.8 2.7 1.3 4.3 1.3 5.2 0 8-4.3 8-8v-.4c.6-.4 1-.9 1.4-1.5z"/></svg>
                                        </a>
                                    </div>
                                    <div class="doctor-card__photo doctor-card__photo--<?php echo esc_attr($i); ?>" aria-hidden="true" <?php if($photo_url) {
                                        echo 'style="background-image: url(\'' . esc_url($photo_url) . '\');"';
                                    } ?>></div>
                                </div>
                                <div class="doctor-card__info">
                                    <a href="<?php the_permalink(); ?>" class="doctor-card__name-link"><?php the_title(); ?></a>
                                    <p class="doctor-card__role"><?php echo esc_html($role); ?></p>
                                </div>
                            </article>
                        </div>

                    <?php
                        $i++;
    endwhile;
    wp_reset_postdata();
endif;
?>

          </div>
        </div>
      </section>
      <?php get_template_part('templates/section', 'cta'); ?>
    </main>
    <?php get_footer(); ?>