<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
	<meta name="format-detection" content="email=no,telephone=no,address=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="canonical" href="<?php echo esc_url(home_url()); ?>/">
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/dist/images/common/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/dist/images/common/apple-touch-icon.png">
	<?php wp_head(); ?>
</head>

<?php get_header(); ?>

<body <?php body_class(); ?>>
	<div class="wrapper">
		<!-- header -->
		<header id="header" class="header">
			<div class="logo">
				<a href="<?php echo esc_url(home_url()); ?>/">
					<img src="<?php echo get_template_directory_uri(); ?>/dist/images/common/" alt="">
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