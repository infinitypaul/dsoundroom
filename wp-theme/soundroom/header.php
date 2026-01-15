<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Page Loader -->
<div class="loader" id="loader">
    <img src="<?php echo SOUNDROOM_URI; ?>/assets/images/logo-white.svg" alt="" class="loader__logo">
</div>

<!-- Header -->
<header class="header" id="header">
    <div class="container">
        <div class="header__inner">
            <?php soundroom_custom_logo(); ?>
            
            <nav class="nav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'walker'         => new Soundroom_Nav_Walker(),
                    'fallback_cb'    => false,
                ));
                ?>
            </nav>
            
            <button class="menu-toggle" id="menuToggle" aria-label="<?php esc_attr_e('Toggle menu', 'soundroom'); ?>">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>

<!-- Mobile Navigation -->
<nav class="mobile-nav" id="mobileNav">
    <?php
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'container'      => false,
        'items_wrap'     => '%3$s',
        'link_before'    => '',
        'link_after'     => '',
        'fallback_cb'    => false,
        'walker'         => new class extends Walker_Nav_Menu {
            public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
                $output .= sprintf(
                    '<a href="%s" class="mobile-nav__link">%s</a>',
                    esc_url($item->url),
                    esc_html($item->title)
                );
            }
        },
    ));
    ?>
</nav>

<!-- Main Content -->
<main class="page-content">
