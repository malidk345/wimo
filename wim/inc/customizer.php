<?php
/**
 * WIM Theme Customizer
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wim_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => 'wim_customize_partial_blogname',
        ));
        $wp_customize->selective_refresh->add_partial('blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => 'wim_customize_partial_blogdescription',
        ));
    }

    // Add section for theme options
    $wp_customize->add_section('wim_theme_options', array(
        'title'    => __('Theme Options', 'wim'),
        'priority' => 30,
    ));

    // Add setting for primary color
    $wp_customize->add_setting('wim_primary_color', array(
        'default'           => '#0079d3',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wim_primary_color', array(
        'label'   => __('Primary Color', 'wim'),
        'section' => 'wim_theme_options',
    )));

    // Add setting for background color
    $wp_customize->add_setting('wim_background_color', array(
        'default'           => '#f8f9fa',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wim_background_color', array(
        'label'   => __('Background Color', 'wim'),
        'section' => 'wim_theme_options',
    )));

    // Add setting for text color
    $wp_customize->add_setting('wim_text_color', array(
        'default'           => '#1a1a1b',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wim_text_color', array(
        'label'   => __('Text Color', 'wim'),
        'section' => 'wim_theme_options',
    )));

    // Add setting for posts per page
    $wp_customize->add_setting('wim_posts_per_page', array(
        'default'           => 10,
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('wim_posts_per_page', array(
        'label'   => __('Posts per page', 'wim'),
        'section' => 'wim_theme_options',
        'type'    => 'number',
    ));

    // Add setting for show author
    $wp_customize->add_setting('wim_show_author', array(
        'default'           => true,
        'sanitize_callback' => 'wim_sanitize_checkbox',
    ));

    $wp_customize->add_control('wim_show_author', array(
        'label'   => __('Show author name', 'wim'),
        'section' => 'wim_theme_options',
        'type'    => 'checkbox',
    ));

    // Add setting for show date
    $wp_customize->add_setting('wim_show_date', array(
        'default'           => true,
        'sanitize_callback' => 'wim_sanitize_checkbox',
    ));

    $wp_customize->add_control('wim_show_date', array(
        'label'   => __('Show post date', 'wim'),
        'section' => 'wim_theme_options',
        'type'    => 'checkbox',
    ));

    // Add setting for show categories
    $wp_customize->add_setting('wim_show_categories', array(
        'default'           => true,
        'sanitize_callback' => 'wim_sanitize_checkbox',
    ));

    $wp_customize->add_control('wim_show_categories', array(
        'label'   => __('Show categories', 'wim'),
        'section' => 'wim_theme_options',
        'type'    => 'checkbox',
    ));
}
add_action('customize_register', 'wim_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wim_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wim_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wim_customize_preview_js() {
    wp_enqueue_script('wim-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), _S_VERSION, true);
}
add_action('customize_preview_init', 'wim_customize_preview_js');

/**
 * Sanitize checkbox
 */
function wim_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}

/**
 * Output customizer CSS
 */
function wim_customizer_css() {
    $primary_color = get_theme_mod('wim_primary_color', '#0079d3');
    $background_color = get_theme_mod('wim_background_color', '#f8f9fa');
    $text_color = get_theme_mod('wim_text_color', '#1a1a1b');
    
    ?>
    <style type="text/css">
        :root {
            --wim-primary-color: <?php echo esc_attr($primary_color); ?>;
            --wim-background-color: <?php echo esc_attr($background_color); ?>;
            --wim-text-color: <?php echo esc_attr($text_color); ?>;
        }
        
        body {
            background-color: var(--wim-background-color);
            color: var(--wim-text-color);
        }
        
        a {
            color: var(--wim-primary-color);
        }
        
        .post-category {
            background: var(--wim-primary-color);
        }
        
        .pagination .current {
            background: var(--wim-primary-color);
        }
    </style>
    <?php
}
add_action('wp_head', 'wim_customizer_css');