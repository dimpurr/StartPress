<article>

<hgroup>
	<header>
		<div>
			<a href="<?php comments_link(); ?>" ><?php comments_number( __('无回复','dpt') , __('落单的回复','dpt') , __('% 回复','dpt') ); ?></a>
			<?php echo edit_post_link( __('编辑','dpt') ); ?>
		</div>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php the_category(' ') ?>
		<a href="<?php the_author_link(); ?>"><?php the_author(); ?></a>
		<?php the_tags('',',',''); ?>
	</header>
</hgroup>

<div><?php the_content('继续阅读','dpt'); ?></div>

</article>