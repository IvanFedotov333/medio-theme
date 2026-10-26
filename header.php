<!doctype html>
<html <?php language_attributes(); ?>> 
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
  </head>
 <body <?php body_class('d-flex flex-column min-vh-100'); ?>>
    <header class="header">
      <nav class="navbar navbar-expand-xl navbar--sticky">
        <div class="container">
        
          <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand">Medio.</a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainMenu"
            aria-controls="mainMenu"
            aria-expanded="false"
            aria-label="Переключить навигацию"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
                    <div class="collapse navbar-collapse" id="mainMenu">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'header_menu',
                'container'      => false,
                'menu_class'     => 'navbar-nav mx-auto',
                'fallback_cb'    => '__return_false',
                'depth'          => 2,
                'walker'         => new WP_Bootstrap_Navwalker()
            ));
?>
            
            <?php
// Ищем страницу по ярлыку 'contacts'
$contact_page = get_page_by_path('contacts');
if ($contact_page) : ?>
                <a href="<?php echo esc_url(get_permalink($contact_page->ID)); ?>" class="btn-contact">
                    Связаться с нами
                </a>
            <?php endif; ?>

          </div>
        </div>
      </nav>
    </header>