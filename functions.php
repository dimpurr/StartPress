<?php

// Setup Language

add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup() {
	load_theme_textdomain('dpt', get_template_directory() . '/lang');
}

// Setup Navigation

register_nav_menus(array(
	'main' => __( 'Main Nav','dpt' ),
));

// Setup Sidebar

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => __( 'Sidebar', 'dpt' ),
		'id' => 'dpt',
		'description' => 'Right Sidebar',
		'class' => '',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	)
);

// Check Upload

require_once(TEMPLATEPATH . '/func/theme-update-checker.php'); 
$wpdaxue_update_checker = new ThemeUpdateChecker(
	'what',
	'http://work.dimpurr.com/theme/what/update/info.json'
);

// Theme Count

function dpt_count() {

// Ajax Count Function

function dpt_tjaj() { ?>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery.get("http://work.dimpurr.com/theme/theme_tj.php?theme_name=what&blog_url=<?=get_bloginfo('url')?>&t=" + Math.random());
	});
	</script>
<?php };

// Count Condition

$dpt_fitj = get_option('dpt_fitj');
$dpt_dayv = get_option('dpt_dayv');
$dpt_date = date('d'); 

if ($dpt_fitj == true) { 
	if($dpt_date == '01') {
		if ($dpt_dayv != true) {
			dpt_tjaj();
			update_option( 'dpt_dayv', true );
		};
	} elseif ($dpt_date != '01') {
		update_option( 'dpt_dayv', false );
	};
} else {
	dpt_tjaj();
	update_option( 'dpt_fitj', true );
};

};

// Page Navigation

function dp_pagenavi () {
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

	$pagination = array(
		'base' => @add_query_arg('paged','%#%'),
		'format' => '',
		'total' => $wp_query->max_num_pages,
		'current' => $current,
		'show_all' => false,
		'type' => 'plain',
		'end_size'=>'0',
		'mid_size'=>'5',
		'prev_text' => __('<<','dpt'),
		'next_text' => __('>>','dpt')
	);

	if( $wp_rewrite->using_permalinks() )
		$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');

	if( !empty($wp_query->query_vars['s']) )
		$pagination['add_args'] = array('s'=>get_query_var('s'));

	echo paginate_links($pagination);
}

// Load Comment

if ( ! function_exists( 'dp_comment' ) ) :
function dp_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php echo 'Pingback:'; ?> <?php comment_author_link(); ?> <?php edit_comment_link( '编辑', '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<div class="cmt_meta_head"><cite class="fn">%1$s',
						get_comment_author_link() );
					printf( '%1$s </cite>',
						( $comment->user_id === $post->post_author ) ? '<span class="cmt_meta_auth"> ' . __('作者','clrs') . '</span>' : '' );
					printf( '</div><span class="cmt_meta_time"><a href="%1$s"><time datetime="%2$s">%3$s</time></a></span>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						sprintf( '%1$s %2$s' , get_comment_date(), get_comment_time() )
					);
					$wbos = get_option('clrs_wbos');
					if ($wbos == "yes" ) {
						echo '<a href="javascript:void(0)" class="cmt_ua_a">';
						clrs_wp_useragent();
						echo '</a>';
					};
				?>
			</header>

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e('审核中','clrs'); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __('編輯','clrs'), '<span class="edit-link">', '</span>' ); ?>
				<?php delete_comment_link(get_comment_ID()); ?>
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __('回复','clrs'), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</section>

		</article>
	<?php
		break;
	endswitch;
}
endif;

// Admin Option

function dpt_menu_func(){   
	add_theme_page(
		__('What?!','dpt'),
		__('What?!','dpt'),
		'administrator',
		'dpt_menu',
		'dpt_config');
}

add_action('admin_menu', 'dpt_menu_func');

function dpt_config(){ dpt_thtj(); ?>

<?php }

?>