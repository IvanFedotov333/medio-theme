<?php get_header();?>
<main class="flex-grow-1">
      <section class="page-hero">
        <div class="container">
          <div class="page-hero__content">
            <h1 class="page-hero__header">Наши Специалисты</h1>
            <p class="page-hero__desc">
              Опытные специалисты, которые бережно заботятся о здоровье вашей
              улыбки.
            </p>
            <nav class="page-hero__crumbs" aria-label="Хлебные крошки">
              <a href="<?php echo esc_url(home_url('/')); ?>">Главная</a>
              <span aria-hidden="true">/</span>
              <span>Врачи</span>
            </nav>
          </div>
        </div>
      </section>

      <section class="doctors">
        <div class="container">
          <div class="row g-4">
            <?php
// Основной цикл WordPress для архива
if (have_posts()) :
    while (have_posts()) : the_post();
        // Получаем наши ACF-поля (специализацию и опыт)
        $role = get_field('doctors_role');
        $exp  = get_field('doctors_experience');

        // Получаем ссылку на картинку
        $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');

        ?>

    <div class="col-12 col-md-6 col-lg-4">
      <article class="doctor-card">
        <div class="doctor-card__top">
          <!-- Соцсети пока оставляем статичными -->
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
          
          <!-- ДИНАМИЧЕСКОЕ ФОТО ВРАЧА -->
          <div class="doctor-card__photo" style="background-image: url('<?php echo esc_url($img_url); ?>');" aria-hidden="true"></div>
        </div>
        
        <div class="doctor-card__info">
          <!-- ДИНАМИЧЕСКОЕ ИМЯ И ССЫЛКА -->
          <a href="<?php echo esc_url(get_permalink()); ?>" class="doctor-card__name-link">
            <?php the_title(); ?>
          </a>
          
          <!-- ДИНАМИЧЕСКАЯ СПЕЦИАЛИЗАЦИЯ И ОПЫТ -->
          <p class="doctor-card__role">
            <?php echo esc_html($role); ?> 
            <?php echo $exp ? ' · ' . esc_html($exp) : ''; ?>
          </p>
        </div>
      </article>
    </div>

<?php
    endwhile;
else :
    echo '<div class="col-12"><p>Врачи пока не добавлены.</p></div>';
endif;
?>        </div>
        </div>
      </section>

      <?php get_template_part('templates/section', 'cta'); ?>
    </main>
<?php get_footer(); ?>