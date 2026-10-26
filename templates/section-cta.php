<section class="cta">
       <?php
$cta_label = get_field('cta_label', 'option') ?: 'Запись';
       $cta_title = get_field('cta_title', 'option') ?: 'Улыбка, Которую Вы Заслуживаете!';
       $cta_btn   = get_field('cta_btn_text', 'option') ?: 'Записаться На Приём';
       $cta_btn_link = get_field('cta_btn_link', 'option');

       if (is_array($cta_btn_link) && ! empty($cta_btn_link['url'])) {
           $btn_url = $cta_btn_link['url'];
           $btn_target = ! empty($cta_btn_link['target']) ? 'target="' . esc_attr($cta_btn_link['target']) . '"' : '';
       } else {
           $btn_url = home_url('/appointment/');
           $btn_target = '';
       }

       $photo_1 = get_field('cta_photo_1', 'option');
       $photo_2 = get_field('cta_photo_2', 'option');
       $photo_3 = get_field('cta_photo_3', 'option');
       $photo_4 = get_field('cta_photo_4', 'option');
       ?>
        <div class="cta__bg" aria-hidden="true"></div>

        <div class="cta__inner">
          <div class="cta__content">
            <div class="cta__badge d-flex align-items-center gap-2">
              <span class="cta__badge-slash">//</span>
              <span><?php echo esc_html($cta_label); ?></span>
            </div>
            <h2 class="cta__header"><?php echo wp_kses_post($cta_title); ?></h2>
            <a href="<?php echo esc_url($btn_url); ?>" <?php echo $btn_target; ?> class="cta__btn">
              <span><?php echo esc_html($cta_btn); ?></span>
              <span class="cta__btn-circle" aria-hidden="true"></span>
            </a>
          </div>

          <div class="cta__photo cta__photo--1" aria-hidden="true" <?php if ($photo_1) {
              echo 'style="background-image: url(\'' . esc_url($photo_1) . '\');"';
          } ?>></div>
          <div class="cta__photo cta__photo--2" aria-hidden="true" <?php if ($photo_2) {
              echo 'style="background-image: url(\'' . esc_url($photo_2) . '\');"';
          } ?>></div>
          <div class="cta__photo cta__photo--3" aria-hidden="true" <?php if ($photo_3) {
              echo 'style="background-image: url(\'' . esc_url($photo_3) . '\');"';
          } ?>></div>
          <div class="cta__photo cta__photo--4" aria-hidden="true" <?php if ($photo_4) {
              echo 'style="background-image: url(\'' . esc_url($photo_4) . '\');"';
          } ?>></div>
        </div>
      </section>