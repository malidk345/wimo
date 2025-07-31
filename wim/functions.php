<?php
/**
 * WIM - Reddit Style Blog Theme Functions
 */

if (!defined('_S_VERSION')) {
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function wim_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // Add support for responsive embeds.
    add_theme_support('responsive-embeds');

    // Add support for custom logo.
    add_theme_support('custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // Add support for HTML5 markup.
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for editor styles.
    add_theme_support('editor-styles');

    // Add support for full and wide align images.
    add_theme_support('align-wide');

    // Add support for custom line height controls.
    add_theme_support('custom-line-height');

    // Add support for experimental link color control.
    add_theme_support('experimental-link-color');

    // Add support for custom units.
    add_theme_support('custom-units');

    // Register navigation menus.
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'wim'),
        'footer'  => esc_html__('Footer Menu', 'wim'),
    ));
}
add_action('after_setup_theme', 'wim_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function wim_content_width() {
    $GLOBALS['content_width'] = apply_filters('wim_content_width', 800);
}
add_action('after_setup_theme', 'wim_content_width', 0);

/**
 * Register widget area.
 */
function wim_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'wim'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'wim'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'wim_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function wim_scripts() {
    wp_enqueue_style('wim-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_style_add_data('wim-style', 'rtl', 'replace');

    wp_enqueue_script('wim-navigation', get_template_directory_uri() . '/script.js', array(), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'wim_scripts');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Add custom image sizes
 */
function wim_image_sizes() {
    add_image_size('wim-thumbnail', 300, 200, true);
    add_image_size('wim-medium', 600, 400, true);
    add_image_size('wim-large', 1200, 800, true);
}
add_action('after_setup_theme', 'wim_image_sizes');

/**
 * Custom excerpt length
 */
function wim_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'wim_excerpt_length');

/**
 * Custom excerpt more
 */
function wim_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'wim_excerpt_more');

/**
 * Add custom classes to body
 */
function wim_body_classes($classes) {
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'wim_body_classes');

/**
 * Add preconnect for Google Fonts.
 */
function wim_resource_hints($urls, $relation_type) {
    if (wp_style_is('wim-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}
add_filter('wp_resource_hints', 'wim_resource_hints', 10, 2);

/**
 * Add support for core custom logo.
 */
function wim_custom_logo_setup() {
    $defaults = array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array('site-title', 'site-description'),
    );
    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'wim_custom_logo_setup');

/**
 * Remove WordPress version from head
 */
remove_action('wp_head', 'wp_generator');

/**
 * Remove emoji scripts
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

/**
 * Add custom post meta
 */
function wim_post_meta() {
    echo '<div class="post-meta">';
    echo '<span class="post-author">' . get_the_author() . '</span>';
    echo '<span class="post-date">' . get_the_date() . '</span>';
    if (has_category()) {
        echo '<div class="post-categories">';
        $categories = get_the_category();
        foreach ($categories as $category) {
            echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="post-category">' . esc_html($category->name) . '</a>';
        }
        echo '</div>';
    }
    echo '</div>';
}

/**
 * Add custom pagination
 */
function wim_pagination() {
    global $wp_query;
    
    $big = 999999999;
    
    echo '<div class="pagination">';
    echo paginate_links(array(
        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format'    => '?paged=%#%',
        'current'   => max(1, get_query_var('paged')),
        'total'     => $wp_query->max_num_pages,
        'prev_text' => '← Önceki',
        'next_text' => 'Sonraki →',
        'type'      => 'list',
    ));
    echo '</div>';
} 