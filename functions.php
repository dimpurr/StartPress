<?php

// 定义语言

add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup() {
	load_theme_textdomain('dpt', get_template_directory() . '/lang');
}

// 定义导航

register_nav_menus(array(
	'main' => __( 'Main Nav','dpt' ),
));

// 定义侧边栏

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => __( 'Sidebar', 'dpt' ),
		'id' => 'dpt',
		'description' => 'Sidebar',
		'class' => '',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	)
);

// 检查更新，需要一个·服务器存放 info.json 和主题安装包。请参见 func 目录

require_once(TEMPLATEPATH . '/func/theme-update-checker.php'); 
$wpdaxue_update_checker = new ThemeUpdateChecker(
	'StartPress',
	'http://work.dimpurr.com/theme/startpress/update/info.json'
);

// 主题使用统计，如果需要。

function dpt_count() {

// Ajax 统计函数

function dpt_tjaj() { ?>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		// 修改地址为服务器的 theme_tj.php 页面。请参见 func 目录
		jQuery.get("http://work.dimpurr.com/theme/theme_tj.php?theme_name=StartPress&blog_url=<?=get_bloginfo('url')?>&t=" + Math.random());
	});
	</script>
<?php };

// 统计筛选条件

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

// 页面导航

function dpt_pagenavi () {
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
		'prev_text' => __('上一页','dpt'),
		'next_text' => __('下一页','dpt')
	);

	if( $wp_rewrite->using_permalinks() )
		$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');

	if( !empty($wp_query->query_vars['s']) )
		$pagination['add_args'] = array('s'=>get_query_var('s'));

	echo paginate_links($pagination);
}

// 加载评论

if ( ! function_exists( 'dpt_comment' ) ) :
function dpt_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php echo 'Pingback '; ?> <?php comment_author_link(); ?> <?php edit_comment_link( '编辑', '<span class="edit-link">', '</span>' ); ?></p>
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
						( $comment->user_id === $post->post_author ) ? '<span class="cmt_meta_auth"> ' . __('作者','dpt') . '</span>' : '' );
					printf( '</div><span class="cmt_meta_time"><a href="%1$s"><time datetime="%2$s">%3$s</time></a></span>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						sprintf( '%1$s %2$s' , get_comment_date(), get_comment_time() )
					);
				?>
			</header>

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e('审核中','dpt'); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __('編輯','dpt'), '<span class="edit-link">', '</span>' ); ?>
				<?php delete_comment_link(get_comment_ID()); ?>
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __('回复','dpt'), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</section>

		</article>
	<?php
		break;
	endswitch;
}
endif;

// 后台设置页面

function dpt_menu_func(){   
	add_theme_page(
		__('设置','dpt'),
		__('设置','dpt'),
		'administrator',
		'dpt_menu',
		'dpt_config');
}

add_action('admin_menu', 'dpt_menu_func');

function dpt_config(){ dpt_thtj(); ?>

<form method="post" name="dpt_form" id="dpt_form">

<h1><?php _e('主题设置'); ?></h1>

<input type="text" size="80" name="dpt_example" id="dpt_example" placeholder="<?php _e('示例控件','dpt'); ?>" value="<?php echo get_option('dpt_example'); ?>"/>
<input type="button" name="upload_button" value="<?php _e('上传','dpt'); ?>" id="upbottom"/><br>

<input type="submit" name="option_save" value="<?php _e('保存设置','dpt'); ?>" />

<?php wp_enqueue_script('thickbox'); wp_enqueue_style('thickbox'); ?>
	<script type="text/javascript">
	// 导入 WordPress 媒体上传组件
jQuery(document).ready(function() {
	// 选择按钮
	jQuery('#upbottom').click(function() {
		// 选择目标文本框
		targetfield = jQuery(this).prev('#dpt_example');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});
	window.send_to_editor = function(html) {
		imgurl = jQuery('img',html).attr('src');
		jQuery(targetfield).val(imgurl);
		tb_remove();
	}	
});
	</script>

<?php wp_nonce_field('update-options'); ?>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="dpt_copy_right" />

</form>

<?php }

// 提交设置

if(isset($_POST['option_save'])){

	$dpt_example = stripslashes($_POST['dpt_example']);
	update_option( 'dpt_example', $dpt_example );
}

?>