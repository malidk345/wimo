<?php
// Wim Theme - functions.php

function wim_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
}
add_action( 'after_setup_theme', 'wim_theme_setup' );

function wim_enqueue_scripts() {
    wp_enqueue_style( 'wim-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'wim_enqueue_scripts' );

function wim_register_menus() {
    register_nav_menus(
        array(
            'menu-1' => __( 'Ana Menü', 'wim' ),
        )
    );
}
add_action( 'after_setup_theme', 'wim_register_menus' );

function wim_enqueue_theme_scripts() {
    wp_enqueue_script( 'wim-script', get_template_directory_uri() . '/script.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'wim_enqueue_theme_scripts' );

// --- Voting REST API ---
add_action('rest_api_init', function() {
    register_rest_route('wim/v1', '/vote/', array(
        'methods' => 'POST',
        'callback' => 'wim_handle_vote',
        'permission_callback' => function() { return is_user_logged_in(); },
        'args' => array(
            'post_id' => array('required' => true, 'type' => 'integer'),
            'vote'    => array('required' => true, 'type' => 'string'), // 'up'|'down'|'none'
        ),
    ));
});

function wim_handle_vote($request) {
    $post_id = intval($request['post_id']);
    $vote = sanitize_text_field($request['vote']);
    $user_id = get_current_user_id();
    if (!$user_id || !$post_id) return new WP_Error('invalid', 'Invalid request', array('status' => 400));
    $user_votes = get_user_meta($user_id, 'wim_votes', true);
    if (!is_array($user_votes)) $user_votes = array();
    $prev_vote = isset($user_votes[$post_id]) ? $user_votes[$post_id] : 'none';
    $user_votes[$post_id] = $vote;
    update_user_meta($user_id, 'wim_votes', $user_votes);
    // Post meta güncelle
    $upvotes = intval(get_post_meta($post_id, 'wim_upvotes', true));
    $downvotes = intval(get_post_meta($post_id, 'wim_downvotes', true));
    // Önceki oyu sil
    if ($prev_vote === 'up') $upvotes--;
    if ($prev_vote === 'down') $downvotes--;
    // Yeni oyu ekle
    if ($vote === 'up') $upvotes++;
    if ($vote === 'down') $downvotes++;
    update_post_meta($post_id, 'wim_upvotes', max(0, $upvotes));
    update_post_meta($post_id, 'wim_downvotes', max(0, $downvotes));
    return array('upvotes' => $upvotes, 'downvotes' => $downvotes, 'vote' => $vote);
}

// Oy sayısını post REST API'ye ekle
add_action('rest_api_init', function() {
    register_rest_field('post', 'wim_votes', array(
        'get_callback' => function($obj) {
            $up = intval(get_post_meta($obj['id'], 'wim_upvotes', true));
            $down = intval(get_post_meta($obj['id'], 'wim_downvotes', true));
            return array('up' => $up, 'down' => $down);
        },
    ));
});

// Tüm öne çıkan görsellerde lazy loading
add_filter('wp_get_attachment_image_attributes', function($attr) {
    $attr['loading'] = 'lazy';
    return $attr;
}); 