<?php get_header(); ?>

<main class="flex-grow-1">
    <!-- Заголовок + крошки -->
    <section class="page-hero">
        <div class="container">
            <div class="page-hero__content">
                <?php
                $hero_title = get_field('appointment_hero_title') ?: 'Запишитесь На Приём';
$hero_desc  = get_field('appointment_hero_desc') ?: 'Запишитесь сегодня — и сделайте первый шаг к здоровой и сияющей улыбке.';
?>
                <h1 class="page-hero__header"><?php echo esc_html($hero_title); ?></h1>
                <p class="page-hero__desc">
                    <?php echo esc_html($hero_desc); ?>
                </p>
                <nav class="page-hero__crumbs" aria-label="Хлебные крошки">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Главная</a>
                    <span aria-hidden="true">/</span>
                    <span>Запись на приём</span>
                </nav>
            </div>
        </div>
    </section>

    <!-- Двухколоночный блок: фото + форма -->
    <section class="appointment">
        <div class="container">
            <div class="appointment__inner">
                <?php
$appointment_img = get_field('appointment_img');
?>
                
                <!-- Левая колонка — фото -->
                <div class="appointment__photo" aria-hidden="true" <?php if ($appointment_img) {
                    echo 'style="background-image: url(\'' . esc_url($appointment_img) . '\');"';
                } ?>></div>

                <!-- Правая колонка — форма -->
                <div class="appointment__form-wrap">
                    <h2 class="appointment__title">Записаться на приём</h2>
                    
                    <form class="appointment__form" id="appointmentForm" method="post" novalidate>
                        <?php wp_nonce_field('appointment_nonce', 'appointment_nonce'); ?>
                        <div class="appointment__fields">
                            <div class="appointment__field">
                                <label for="name" class="appointment__label">Имя *</label>
                                <input type="text" id="name" name="name" class="appointment__input" required />
                            </div>
                            <div class="appointment__field">
                                <label for="email" class="appointment__label">Email *</label>
                                <input type="email" id="email" name="email" class="appointment__input" required />
                            </div>
                            <div class="appointment__field">
                                <label for="phone" class="appointment__label">Телефон *</label>
                                <input type="tel" id="phone" name="phone" class="appointment__input" required />
                            </div>
                            <div class="appointment__field appointment__field--full">
                                <label for="message" class="appointment__label">Расскажите о себе</label>
                                <textarea id="message" name="message" class="appointment__input appointment__textarea" rows="3"></textarea>
                            </div>
                        </div>
                        
                        <div class="appointment__field appointment__field--full">
                            <label class="form-consent">
                                <input type="checkbox" name="consent" class="form-consent__input" required />
                                <span class="form-consent__text">
                                    Я согласен на обработку персональных данных(включая сведения о состоянии здоровья) в соответствии с <a href="<?php echo esc_url(get_privacy_policy_url()); ?>" target="_blank" rel="noopener noreferrer">Политикой конфиденциальности</a> 
                                </span>
                            </label>
                        </div>
                        
                        <div class="form-message" id="appointmentMessage" hidden></div>

                        <button type="submit" class="appointment__btn">
                            <span>Отправить</span>
                            <span class="appointment__btn-circle" aria-hidden="true"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>