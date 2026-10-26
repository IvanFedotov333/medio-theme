<?php
get_header();
?>

<main class="flex-grow-1">
    <section class="page-hero">
        <div class="container">
            <div class="page-hero__content">
                <h1 class="page-hero__header"><?php echo esc_html(get_field('contact_hero_title')); ?></h1>
                <p class="page-hero__desc">
                    <?php
                    $hero_desc = get_field('contact_hero_desc');
echo $hero_desc ? esc_html($hero_desc) : 'Есть вопросы? Отправьте форму — ответим в течение 24 часов.';
?>
                </p>
                <nav class="page-hero__crumbs" aria-label="Хлебные крошки">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Главная</a>
                    <span aria-hidden="true">/</span>
                    <span>Контакты</span>
                </nav>
            </div>
        </div>
    </section>

    <section class="contact">
        <div class="container">
            <div class="contact__inner">
                <!-- Левая — белая с контактами -->
                <div class="contact__info">
                    <h2 class="contact__info-header">
                        <?php echo esc_html(get_field('contact_info_title')); ?>
                    </h2>

                    <ul class="contact__list">
                        <?php
    $email = get_field('contact_email');
$phone = get_field('contact_phone');
?>
                        <?php if ($email) : ?>
                        <li>
                            <a href="mailto:<?php echo esc_attr($email); ?>" class="contact__link">
                                <?php echo esc_html($email); ?>
                            </a>
                        </li>
                        <?php endif; ?>
                        
                        <?php if ($phone) : ?>
                        <li>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="contact__link">
                                <?php echo esc_html($phone); ?>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Правая — оранжевая форма -->
                <div class="contact__form-wrap">
                    <form class="contact__form" id="contactForm" action="#" method="post" novalidate>
    <?php wp_nonce_field('contact_form_action', 'contact_nonce'); ?>
    
    <div class="contact__fields">
        <div class="contact__field contact__field--full">
            <label for="fullname" class="contact__label">Имя *</label>
            <input type="text" id="fullname" name="fullname" class="contact__input" required />
        </div>
        <div class="contact__field">
            <label for="email" class="contact__label">Email *</label>
            <input type="email" id="email" name="email" class="contact__input" required />
        </div>
        <div class="contact__field">
            <label for="phone" class="contact__label">Телефон *</label>
            <input type="tel" id="phone" name="phone" class="contact__input" required pattern="[0-9+\-\s()]{10,18}" />
        </div>
        <div class="contact__field contact__field--full">
            <label for="subject" class="contact__label">Тема *</label>
            <input type="text" id="subject" name="subject" class="contact__input" required />
        </div>
        <div class="contact__field contact__field--full">
            <label for="message" class="contact__label">Сообщение *</label>
            <textarea id="message" name="message" class="contact__input contact__textarea" rows="3" required></textarea>
        </div>
    </div>
    <div class="contact__field contact__field--full">
        <label class="form-consent">
            <input type="checkbox" name="consent" class="form-consent__input" required />
            <span class="form-consent__text">
                Я согласен на обработку персональных данных(включая сведения о состоянии здоровья) в соответствии с <a href="<?php echo esc_url(get_privacy_policy_url()); ?>" target="_blank" rel="noopener noreferrer">Политикой конфиденциальности</a> 
            </span>
        </label>
    </div>
    <button type="submit" class="contact__btn">
        <span>Отправить</span>
        <span class="contact__btn-circle" aria-hidden="true"></span>
    </button>
    <div class="form-message" id="contactMessage" hidden></div>
</form>
                </div>
            </div>

            <!-- Большое фото внизу -->
            <?php
            $photo_url = get_field('contact_photo');
if ($photo_url) :
    ?>
                <div class="contact__photo" style="background-image: url('<?php echo esc_url($photo_url); ?>');"></div>
            <?php else : ?>
                <div class="contact__photo" aria-hidden="true"></div>
            <?php endif; ?>
            
        </div>
    </section>
</main>

<?php get_footer(); ?>