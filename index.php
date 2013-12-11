<?php // 获取头部
	get_header(); ?>

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<?php // 获取文章展示模版 content.php
			get_template_part('content'); ?>
	<?php endwhile; ?>

	<?php // 输出页码
		dpt_pagenavi(); ?>

<?php else : ?>

	<h1>404</h1>
	
<?php endif; ?>

<?php // 获取尾部
	get_footer(); ?>