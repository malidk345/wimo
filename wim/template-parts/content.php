<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
    </header>
    <div class="entry-content">
        <?php the_content(); ?>
    </div>
    <footer class="entry-footer">
        <?php edit_post_link( __( 'Düzenle', 'wim' ), '<span class="edit-link">', '</span>' ); ?>
    </footer>
</article> 