<?php
// Wim Theme - 404.php
get_header();
?>
<main id="main" class="site-main">
    <h1 class="front-title">404 - not found</h1>
    <div class="reddit-feed">
        <div class="reddit-post">
            <div class="reddit-content">
                <div class="reddit-meta">
                    <span class="reddit-category">error</span>
                    <span class="reddit-date"><?php echo strtolower(date('M j, Y')); ?></span>
                </div>
                <div class="reddit-title">the page you are looking for does not exist.</div>
                <div class="reddit-excerpt">please check the url or return to the <a href="<?php echo esc_url( home_url( '/' ) ); ?>">homepage</a>.</div>
            </div>
        </div>
    </div>
</main>
<?php
get_footer(); 