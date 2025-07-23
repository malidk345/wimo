<?php
// Wim Theme - search.php
get_header();
?>
<main id="main" class="site-main">
    <h1 class="front-title">search results</h1>
    <div class="reddit-feed">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post(); ?>
            <div class="reddit-post">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="reddit-thumb">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
                    </div>
                <?php endif; ?>
                <div class="reddit-vote">
                    <button class="vote-btn up" aria-label="upvote">▲</button>
                    <span class="vote-count">0</span>
                    <button class="vote-btn down" aria-label="downvote">▼</button>
                </div>
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
                </div>
            </div>
        <?php endwhile;
    else :
        echo '<p>no results found.</p>';
    endif;
    ?>
    </div>
</main>
<?php
get_footer(); 