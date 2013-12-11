<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part('content'); ?>

	<?php endwhile; ?>

<?php dp_pagenavi(); ?>

<?php else : ?>

	404.

<?php endif; ?>

<?php get_footer(); ?>
