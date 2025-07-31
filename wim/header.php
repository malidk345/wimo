<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <header id="masthead" class="site-header">
        <div class="header-container">
            <div class="site-branding">
                <?php if (is_front_page() && is_home()) : ?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    </h1>
                <?php else : ?>
                    <p class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    </p>
                <?php endif; ?>
            </div>

            <nav id="site-navigation" class="main-navigation">
                <ul class="nav-menu">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Ana Sayfa</a></li>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'fallback_cb'    => false,
                    ));
                    ?>
                </ul>
            </nav>

            <button class="mobile-menu-toggle" id="mobile-menu-toggle">
                <span class="menu-icon">☰</span>
            </button>
        </div>

        <div class="mobile-menu" id="mobile-menu">
            <ul>
                <li><a href="<?php echo esc_url(home_url('/')); ?>">Ana Sayfa</a></li>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'mobile-menu-items',
                    'container'      => false,
                    'fallback_cb'    => false,
                ));
                ?>
            </ul>
        </div>
    </header>

    <div id="content" class="site-content">
        <main id="main" class="site-main"> 