<?php get_header(); ?>

<div class="error-404">
    <div class="error-content">
        <h1 class="error-title">404</h1>
        <h2 class="error-subtitle">Sayfa Bulunamadı</h2>
        <p class="error-description">
            Aradığınız sayfa mevcut değil veya taşınmış olabilir.
        </p>
        
        <div class="error-actions">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary">
                Ana Sayfaya Dön
            </a>
            
            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="search" class="search-input" placeholder="Arama yapın..." name="s" />
                <button type="submit" class="search-submit">Ara</button>
            </form>
        </div>
        
        <div class="recent-posts">
            <h3>Son Yazılar</h3>
            <ul>
                <?php
                $recent_posts = wp_get_recent_posts(array(
                    'numberposts' => 5,
                    'post_status' => 'publish'
                ));
                
                foreach ($recent_posts as $post) {
                    echo '<li><a href="' . get_permalink($post['ID']) . '">' . $post['post_title'] . '</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<?php get_footer(); ?> 