<?php
/**
 * Template Name: Лицензии
 */
get_header();
?>

<main class="flex-grow-1">
    <section class="page-hero">
        <div class="container">
            <div class="page-hero__content">
                <h1 class="page-hero__header"><?php the_title(); ?></h1>
                <p class="page-hero__desc">Официальные документы нашей клиники</p>
                <nav class="page-hero__crumbs" aria-label="Хлебные крошки">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Главная</a>
                    <span aria-hidden="true">/</span>
                    <span><?php the_title(); ?></span>
                </nav>
            </div>
        </div>
    </section>

    <section class="licenses">
        <div class="container">
            <div class="licenses__inner">
                
                <div class="licenses__info">
                    <?php the_content(); ?>
                    
                    <ul class="licenses__details">
                        <?php if ($num = get_field('license_number')) : ?>
                            <li><strong>Регистрационный номер:</strong> <?php echo esc_html($num); ?></li>
                        <?php endif; ?>
                        
                        <?php if ($date = get_field('license_date')) : ?>
                            <li><strong>Дата выдачи:</strong> <?php echo esc_html($date); ?></li>
                        <?php endif; ?>
                        
                        <li><strong>Выдана:</strong> Комитет по здравоохранению</li>
                    </ul>
                </div>

                <?php
                $qr = get_field('license_qr');
if ($qr) : ?>
                    <div class="licenses__qr">
                        <img src="<?php echo esc_url($qr); ?>" alt="QR-код выписки из реестра лицензий">
                        <p>Наведите камеру, чтобы проверить лицензию в реестре Росздравнадзора</p>
                    </div>
                <?php endif; ?>
                
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>