<?php get_header(); ?>

<div class="archive-header">
    <?php
    the_archive_title('<h1 class="archive-title">', '</h1>');
    the_archive_description('<div class="archive-description">', '</div>');
    ?>
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
        <h2>Bu kategoride henüz yazı bulunmuyor</h2>
        <p>Başka bir kategori seçin veya ana sayfaya dönün.</p>
    </div>
<?php endif; ?>

<?php get_footer(); ?> 