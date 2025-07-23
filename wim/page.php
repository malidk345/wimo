<?php
// Wim Theme - page.php
get_header();
?>
<main id="main" class="site-main">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('reddit-post'); ?>>
                <div class="reddit-content">
                    <h1 class="reddit-title"><?php echo strtolower(get_the_title()); ?></h1>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </article>
        <?php endwhile;
    else :
        echo '<p>no page found.</p>';
    endif;
    ?>
</main>
<?php
get_footer(); 