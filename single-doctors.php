<?php get_header(); ?>

<main class="flex-grow-1">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            // Получаем ACF-поля
            $role = get_field('doctors_role');
            $exp  = get_field('doctors_experience');
            // Получаем картинку
            $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
            ?>

    <section class="doctor-single">
        <div class="container">
            <div class="doctor-single__inner">
                <!-- Левая колонка — инфо -->
                <div class="doctor-single__info">
                    <h2 class="doctor-single__name"><?php the_title(); ?></h2>
                    <p class="doctor-single__role">
                        <?php echo esc_html($role); ?> 
                        <?php echo $exp ? ' · ' . esc_html($exp) : ''; ?>
                    </p>

                    <!-- Соцсети (SVG вернул как в макете) -->
                    <div class="doctor-single__socials">
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

                    <div class="doctor-single__divider"></div>

                    <!-- Биография (если захочешь добавить текст через Гутенберг) -->
                    <div class="doctor-single__block">
                        <?php the_content(); ?>
                    </div>

                    <!-- Локация (пока захардкожено, если надо будет - выведем через ACF) -->
                    <div class="doctor-single__block">
                        <h3 class="doctor-single__label">Адрес</h3>
                        <p class="doctor-single__text">Санкт-Петербург, Заневский проспект д. 43 стр. 1</p>
                        <a href="#" class="doctor-single__link">Открыть в Google Maps</a>
                    </div>

                    <div class="doctor-single__divider"></div>

                    <!-- Часы работы -->
                    <div class="doctor-single__block">
                        <h3 class="doctor-single__label">Часы работы</h3>
                        <p class="doctor-single__text">Пн–Сб: 8:00–17:00</p>
                        <p class="doctor-single__text">Вторник: 10:00–16:00</p>
                    </div>

                    <div class="doctor-single__divider"></div>

                    <!-- Контакты -->
                    <div class="doctor-single__block">
                        <h3 class="doctor-single__label">Связаться</h3>
                        <a href="tel:+74085550382" class="doctor-single__link">+7 (408) 555-0382</a>
                        <a href="mailto:contact@reddentcare.com" class="doctor-single__link">contact@reddentcare.com</a>
                    </div>
                </div>

                <!-- Правая колонка — фото (ДИНАМИЧЕСКОЕ) -->
                <div class="doctor-single__photo" style="background-image: url('<?php echo esc_url($img_url); ?>');" aria-hidden="true"></div>
            </div>
            <?php
            $certificates = get_field('doctors_license');
            if ($certificates) : ?>
                <div class="doctor-single__certificates">
                    <h3 class="doctor-single__label" style="margin-top: 50px; margin-bottom: 20px;">Сертификаты и дипломы</h3>
                    <div class="certificates-grid">
                        <?php foreach ($certificates as $cert) : ?>
                            <a href="<?php echo esc_url($cert['url']); ?>" target="_blank" class="certificates-grid__item">
                                <img src="<?php echo esc_url($cert['sizes']['medium']); ?>" alt="<?php echo esc_attr($cert['alt']); ?>">
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- Секция CTA (осталась без изменений) -->
    <section class="cta">
        <div class="cta__bg" aria-hidden="true"></div>
        <div class="cta__inner">
            <div class="cta__content">
                <div class="cta__badge d-flex align-items-center gap-2">
                    <span class="cta__badge-slash">//</span>
                    <span>Запись</span>
                </div>
                <h2 class="cta__header">Улыбка, Которую Вы Заслуживаете!</h2>
                <a href="<?php echo esc_url(home_url('/appointment/')); ?>" class="cta__btn">
                    <span>Записаться На Приём</span>
                    <span class="cta__btn-circle" aria-hidden="true"></span>
                </a>
            </div>
            <div class="cta__photo cta__photo--1" aria-hidden="true"></div>
            <div class="cta__photo cta__photo--2" aria-hidden="true"></div>
            <div class="cta__photo cta__photo--3" aria-hidden="true"></div>
            <div class="cta__photo cta__photo--4" aria-hidden="true"></div>
        </div>
    </section>

    <?php
        endwhile;
    endif;
?>
</main>

<?php get_footer(); ?>