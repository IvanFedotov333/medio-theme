<footer class="footer">
      <div class="container">
        <div class="row g-4 g-lg-5 footer__top">
          <!-- Колонка 1 -->
          <div class="col-6 col-md-3">
            <h3 class="footer__label">Основные</h3>
            <?php
wp_nav_menu(array(
    'theme_location' => 'footer_menu_main', // Наше зарегистрированное место
    'container'      => false,              // Без лишнего <div>
    'menu_class'     => 'footer__list',     // Твой класс для <ul>
    'fallback_cb'    => '__return_false',
    'depth'          => 1,                  // Только один уровень (без подменю)
));
            ?>
          </div>

          <!-- Колонка 2 -->
          <div class="col-6 col-md-3">
            <h3 class="footer__label">Компания</h3>
            <?php
wp_nav_menu(array(
    'theme_location' => 'footer_menu_company',
    'container'      => false,
    'menu_class'     => 'footer__list',
    'fallback_cb'    => '__return_false',
    'depth'          => 1,
));
            ?>
          </div>

          <!-- Колонка 3 -->
          <!-- Колонка 3 -->
<div class="col-6 col-md-3">
  <h3 class="footer__label">Контакты</h3>
  
  <?php
  // Второй аргумент 'option' указывает, что мы берем данные из Глобальных настроек
  $global_email = get_field('global_email', 'option');
            $global_phone = get_field('global_phone', 'option');
            $global_address = get_field('global_address', 'option');
            ?>
  
  <ul class="footer__list">
    <?php if($global_email): ?>
    <li>
      <a href="mailto:<?php echo esc_attr($global_email); ?>" class="footer__link">
        <?php echo esc_html($global_email); ?>
      </a>
    </li>
    <?php endif; ?>
    
    <?php if($global_phone): ?>
    <li>
      <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $global_phone)); ?>" class="footer__link">
        <?php echo esc_html($global_phone); ?>
      </a>
    </li>
    <?php endif; ?>
    
    <?php if($global_address): ?>
    <li>
      <span class="footer__link"><?php echo esc_html($global_address); ?></span>
    </li>
    <?php endif; ?>
  </ul>
</div>

          <!-- Колонка 4 -->
          <div class="col-6 col-md-3">
            <h3 class="footer__label">Соцсети</h3>
            <ul class="footer__list">
              <li><a href="#" class="footer__link">ВКонтакте</a></li>
              <li><a href="#" class="footer__link">Telegram</a></li>
              <li><a href="#" class="footer__link">Instagram</a></li>
              <li><a href="#" class="footer__link">YouTube</a></li>
            </ul>
          </div>
        </div>

        <!-- Гигантский лого -->
        <div class="footer__watermark" aria-hidden="true">Medio.</div>

        <!-- Копирайт -->
        <div class="footer__bottom">
          <span>© 2026 Copyright — Medio</span>
          <a href="<?php echo esc_url(get_privacy_policy_url()); ?>" class="footer__bottom-link"
            >Политика конфиденциальности</a
          >|<a href="https://cr.minzdrav.gov.ru/" target="_blank" rel="noopener noreferrer" class="footer__bottom-link">Клинические рекомендации</a>
          <span>Все права защищены</span>
        </div>
        <div class="footer__disclaimer">
          <small>Демонстрационный макет. Фотографии и тексты сгенерированы нейросетью.</small>
      </div>
      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>