<!DOCTYPE html>
<html lang="ja">

<head prefix="og:http://ogp.me/ns#">
	<meta charset="UTF-8">
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	<?php if (is_single()) : ?>
		<meta name="description" content="<?php echo get_the_excerpt(); ?>">
	<?php else : ?>
		<meta name="description" content="<?php bloginfo('description'); ?>">
	<?php endif; ?>
	<?php if (is_404()) : ?>
		<meta name="robots" content="noindex,nofollow">
	<?php endif; ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
	<meta name="format-detection" content="email=no,telephone=no,address=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="canonical" href="<?php echo esc_url((empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/src/images/favicon.ico" sizes="any">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/src/images/apple-touch-icon.png">

	<?php if (is_single()) : ?>
		<meta name="description" content="<?php echo get_the_excerpt(); ?>">
		<meta property="og:title" content="<?php echo get_the_title(); ?>">
		<meta property="og:description" content="<?php echo get_the_excerpt(); ?>">
		<meta property="og:type" content="article">
		<meta property="og:url" content="<?php echo esc_url((empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>">
		<?php
		if (has_post_thumbnail()) {
			$og_img_url = get_the_post_thumbnail_url(null, 'large');
			echo '<meta property="og:image" content="' . esc_url($og_img_url) . '">';
		} else {
			$og_img_url = get_template_directory_uri() . "/src/images/ogp.png";
			echo '<meta property="og:image" content="' . esc_url($og_img_url) . '">';
		}
		?>
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="">
	<?php else : ?>
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<meta property="og:title" content="<?php wp_title('|', false, 'right'); ?><?php bloginfo('name'); ?>">
		<meta property="og:description" content="<?php bloginfo('description'); ?>">
		<meta property="og:type" content="website">
		<meta property="og:url" content="<?php echo esc_url((empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>">
		<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/src/images/ogp.png">
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="wrapper">
		<!-- header -->
		<header id="header" class="header">
			<div class="logo">
				<a href="<?php echo esc_url(home_url()); ?>/">
					<img src="<?php echo get_template_directory_uri(); ?>/src/images/common/" alt="">
				</a>
			</div>

			<div class="menuBox">
				<div id="menu" class="menu">
					<span class="menuTop"></span>
					<span class="mennuCenter"></span>
					<span class="menuBottom"></span>
				</div>
			</div>
		</header>