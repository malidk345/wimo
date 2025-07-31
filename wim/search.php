<?php get_header(); ?>

<div class="search-header">
    <h1 class="search-title">
        <?php printf(esc_html__('Search Results for: %s', 'wim'), '<span>' . get_search_query() . '</span>'); ?>
    </h1>
    
    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
        <input type="search" class="search-input" placeholder="Yeni arama yapın..." value="<?php echo get_search_query(); ?>" name="s" />
        <button type="submit" class="search-submit">Ara</button>
    </form>
</div>

<?php if (have_posts()) : ?>
    <div class="posts-feed">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                <div class="post-header">
                    <div class="post-meta">
                        <span class="post-author"><?php the_author(); ?></span>
                        <span class="post-date"><?php echo get_the_date(); ?></span>
                    </div>
                    
                    <h2 class="post-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    
                    <?php if (has_excerpt()) : ?>
                        <div class="post-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    </div>
                <?php endif; ?>
                
                <div class="post-footer">
                    <div class="post-categories">
                        <?php
                        $categories = get_the_category();
                        if ($categories) {
                            foreach ($categories as $category) {
                                echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="post-category">' . esc_html($category->name) . '</a>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
    
    <?php
    // Pagination
    the_posts_pagination(array(
        'mid_size'  => 2,
        'prev_text' => '← Önceki',
        'next_text' => 'Sonraki →',
    ));
    ?>
    
<?php else : ?>
    <div class="no-posts">
        <h2>Arama sonucu bulunamadı</h2>
        <p>"<?php echo get_search_query(); ?>" için sonuç bulunamadı. Farklı anahtar kelimeler deneyin.</p>
        
        <div class="search-suggestions">
            <h3>Öneriler:</h3>
            <ul>
                <li>Farklı anahtar kelimeler kullanın</li>
                <li>Daha genel terimler deneyin</li>
                <li>Yazım hatası olup olmadığını kontrol edin</li>
            </ul>
        </div>
    </div>
<?php endif; ?>

<?php get_footer(); ?> 