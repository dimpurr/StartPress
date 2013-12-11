<!DOCTYPE html>
<html lang="zh-cn">

<head>

<title><?php wp_title( '|', true, 'right' ); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="author" content="dimpurr" />
<meta name="application-name" content="<?php bloginfo('name'); ?>"/>
<meta charset="<?php bloginfo('charset'); ?>" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url')?>" />
<link rel="alternate" type="application/rdf+xml" title="RSS 1.0" href="<?php bloginfo('rss_url')?>" />
<link rel="alternate" type="application/atom+xml" title="ATOM 1.0" href="<?php bloginfo('atom_url')?>" />

<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"> // IE HTML 兼容 </script>
<![endif]-->

<?php wp_head(); ?>

<?php if ( is_user_logged_in() ) {
	// 如果有 fiexd top 定位的元素，在这为 Admin Bar 增加 32px 顶边距
	echo '<style type="text/css" media="screen"> #float { top: 32px; } </style>' ;
} ?>

</head>

<body>
<div id="page">

<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
<h2><?php bloginfo( 'description' ); ?></h2>

	<?php wp_nav_menu( array( 'theme_location' => 'Nav' ) ); ?>
