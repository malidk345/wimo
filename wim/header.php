<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
    <meta property="og:description" content="<?php bloginfo('description'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url( home_url( add_query_arg( array(), $wp->request ) ) ); ?>">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
    <meta name="twitter:description" content="<?php bloginfo('description'); ?>">
    <link rel="icon" href="<?php echo get_site_icon_url(); ?>" type="image/png">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="site-header">
    <div class="container header-flex">
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <div class="header-icons">
            <button class="icon-btn" id="searchToggle" aria-label="search" tabindex="0"><span class="icon-search"></span></button>
            <?php if ( is_user_logged_in() ) : 
                $current_user = wp_get_current_user(); ?>
                <div class="profile-menu" role="menu" aria-label="profile menu">
                    <button class="icon-btn profile-btn" id="profileBtn" aria-label="profile" aria-haspopup="true" aria-expanded="false" tabindex="0">
                        <span class="icon-login"></span>
                    </button>
                    <div class="profile-dropdown" id="profileDropdown" role="menu" aria-label="profile dropdown" tabindex="-1">
                        <a href="<?php echo esc_url( get_edit_profile_url( $current_user->ID ) ); ?>" role="menuitem" tabindex="0">profile</a>
                        <a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" role="menuitem" tabindex="0">logout</a>
                    </div>
                </div>
            <?php else : ?>
                <a href="<?php echo esc_url( wp_login_url() ); ?>" class="icon-btn" aria-label="login" tabindex="0"><span class="icon-login"></span></a>
            <?php endif; ?>
            <button class="icon-btn" id="menuToggle" aria-label="menu" aria-expanded="false" aria-controls="mainNav" tabindex="0"><span class="icon-menu"></span></button>
        </div>
    </div>
</header>
<div class="toast" id="wimToast" role="status" aria-live="polite"></div>
<div class="search-modal" id="searchModal" tabindex="-1" aria-modal="true" role="dialog" aria-label="search modal" style="display:none;">
    <div class="search-modal-content">
        <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="search" name="s" class="search-input" placeholder="search..." autocomplete="off" autofocus aria-label="search input" tabindex="0" />
            <button type="submit" class="search-submit" aria-label="submit search" tabindex="0">search</button>
        </form>
        <button class="search-modal-close" id="searchModalClose" aria-label="close search modal" tabindex="0">&times;</button>
    </div>
</div>
<script>
// Hamburger menü aç/kapa
const menuToggle = document.getElementById('menuToggle');
const mainNav = document.getElementById('mainNav');
menuToggle.addEventListener('click', function() {
  mainNav.classList.toggle('open');
});
// Profil menüsü aç/kapa
const profileBtn = document.getElementById('profileBtn');
const profileDropdown = document.getElementById('profileDropdown');
if(profileBtn && profileDropdown) {
  profileBtn.addEventListener('click', function(e) {
    e.stopPropagation();
    profileDropdown.classList.toggle('open');
  });
  document.addEventListener('click', function() {
    profileDropdown.classList.remove('open');
  });
}
// Arama modalı aç/kapa
const searchToggle = document.getElementById('searchToggle');
const searchModal = document.getElementById('searchModal');
const searchModalClose = document.getElementById('searchModalClose');
if(searchToggle && searchModal) {
  searchToggle.addEventListener('click', function() {
    searchModal.style.display = 'flex';
    setTimeout(() => {
      const input = searchModal.querySelector('.search-input');
      if(input) input.focus();
    }, 100);
  });
}
if(searchModalClose && searchModal) {
  searchModalClose.addEventListener('click', function() {
    searchModal.style.display = 'none';
  });
}
document.addEventListener('keydown', function(e) {
  if(e.key === 'Escape' && searchModal && searchModal.style.display === 'flex') {
    searchModal.style.display = 'none';
  }
});
</script> 