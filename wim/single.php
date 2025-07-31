<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
        <header class="post-header">
            <div class="post-meta">
                <span class="post-author"><?php the_author(); ?></span>
                <span class="post-date"><?php echo get_the_date(); ?></span>
                <?php if (has_category()) : ?>
                    <div class="post-categories">
                        <?php
                        $categories = get_the_category();
                        foreach ($categories as $category) {
                            echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="post-category">' . esc_html($category->name) . '</a>';
                        }
                        ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <h1 class="post-title"><?php the_title(); ?></h1>
        </header>

        <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail('large'); ?>
            </div>
        <?php endif; ?>

        <div class="post-content">
            <?php the_content(); ?>
        </div>

        <footer class="post-footer">
            <div class="post-tags">
                <?php
                $tags = get_the_tags();
                if ($tags) {
                    echo '<span class="tags-label">Etiketler:</span>';
                    foreach ($tags as $tag) {
                        echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="post-tag">' . esc_html($tag->name) . '</a>';
                    }
                }
                ?>
            </div>
        </footer>
    </article>

    <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;
    ?>

    <nav class="post-navigation">
        <div class="nav-links">
            <div class="nav-previous">
                <?php previous_post_link('%link', '← %title'); ?>
            </div>
            <div class="nav-next">
                <?php next_post_link('%link', '%title →'); ?>
            </div>
        </div>
    </nav>

<?php endwhile; ?>

<?php get_footer(); ?> 