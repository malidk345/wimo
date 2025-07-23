<?php
// Wim Theme - category.php
get_header();
$cat_title = strtolower(single_cat_title('', false));
?>
<main id="main" class="site-main">
    <h1 class="front-title">category: <?php echo $cat_title; ?></h1>
    <div class="reddit-feed">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post(); ?>
            <div class="reddit-post">
                <div class="reddit-content">
                    <div class="reddit-meta">
                        <span class="reddit-category category-color cat-<?php if($cat){ echo esc_attr($cat[0]->slug); } ?>">
                            <span class="cat-dot"></span><?php $cat = get_the_category(); if($cat){ echo strtolower(esc_html($cat[0]->name)); } ?>
                        </span>
                        <span class="reddit-date"><?php echo strtolower(get_the_date('M j, Y')); ?></span>
                        <span class="reddit-author">by <?php the_author(); ?></span>
                        <span class="reddit-comments">
                            <?php echo get_comments_number(); ?> comments
                        </span>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="reddit-title"><?php echo strtolower(get_the_title()); ?></a>
                    <div class="reddit-excerpt"><?php echo strtolower(get_the_excerpt()); ?></div>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="reddit-thumb">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                        </div>
                    <?php endif; ?>
                    <div class="reddit-vote">
                        <div class="reddit-actions-left">
                            <button class="action-btn like-btn" aria-label="like">
                                <span>♥</span>
                                <span class="action-count">0</span>
                            </button>
                            <button class="action-btn comment-btn" aria-label="comments">
                                <span>💬</span>
                                <span class="action-count"><?php echo get_comments_number(); ?></span>
                            </button>
                        </div>
                        <div class="reddit-actions-right">
                            <button class="action-btn share-btn" aria-label="share">
                                <span>📤</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile;
    else :
        echo '<p>no posts found.</p>';
    endif;
    ?>
    </div>
</main>
<?php
get_footer(); 