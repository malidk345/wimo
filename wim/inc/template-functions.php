<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
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
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function wim_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'wim_pingback_header');

/**
 * Change the excerpt more string
 */
function wim_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'wim_excerpt_more');

/**
 * Customize the excerpt length
 */
function wim_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'wim_excerpt_length');

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