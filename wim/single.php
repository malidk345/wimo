<?php
// Wim Theme - single.php
get_header();
?>
<main id="main" class="site-main">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('reddit-post'); ?>>
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="reddit-thumb">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
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
                    <h1 class="reddit-title"><?php echo strtolower(get_the_title()); ?></h1>
                    <div class="reddit-excerpt"><?php echo strtolower(get_the_excerpt()); ?></div>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </article>
            <div class="reddit-comments">
                <?php comments_template(); ?>
            </div>
        <?php endwhile;
    else :
        echo '<p>no post found.</p>';
    endif;
    ?>
</main>
<?php
get_footer(); 