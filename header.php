<!DOCTYPE html>
<html lang="ja">

<head prefix="og: https://ogp.me/ns#">
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	<?php if (is_single()) : ?>
		<meta name="description" content="<?php echo get_the_excerpt(); ?>">
	<?php else : ?>
		<meta name="description" content="<?php bloginfo('description'); ?>">
	<?php endif; ?>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
	<meta name="format-detection" content="email=no,telephone=no,address=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="canonical" href="<?php echo esc_url(home_url()); ?>/">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/src/images/common/apple-touch-icon.png">
	<!-- twitter ogp -->
	<meta name="twitter:card" content="summary">
	<meta property="og:title" content="<?php the_title(); ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="<?php the_permalink(); ?>" />
	<meta property="og:description" content="<?php echo get_the_excerpt(); ?>" />
	<?php if (is_single() || is_page()) : ?>
		<?php if (has_post_thumbnail()) : ?>
			<meta property="og:image" content="<?php the_post_thumbnail_url(); ?>" />
		<?php else :
		?>
			<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/src/images/common/noimage.jpg" />
		<?php endif; ?>
	<?php elseif (is_archive() || is_tax()) : ?>
		<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/src/images/common/noimage.jpg" />
	<?php endif; ?>
	<!-- Facebook Open Graph -->
	<meta property="og:title" content="<?php the_title(); ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="<?php the_permalink(); ?>" />
	<meta property="og:description" content="<?php echo get_the_excerpt(); ?>" />
	<?php if (has_post_thumbnail()) : ?>
		<meta property="og:image" content="<?php the_post_thumbnail_url(); ?>" />
	<?php else : ?>
		<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/src/images/common/noimage.jpg" />
	<?php endif; ?>
	<!-- LINE ogp -->
	<meta property="og:image" content="<?php the_post_thumbnail_url(); ?>" />
	<meta property="og:image:width" content="1200">
	<meta property="og:image:height" content="630">
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