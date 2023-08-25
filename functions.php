<?php
// CSS
function mytheme_enqueue()
{
	// テーマのCSS
	wp_enqueue_style('mytheme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue');
// ------------------------------
// グーテンベルクCSS
// ------------------------------
add_action('after_setup_theme', 'nxw_setup_theme');
function nxw_setup_theme()
{
	add_theme_support('wp-block-styles');
}
// ------------------------------
// ウィジェット
// ------------------------------
function my_theme_widgets_init()
{
	register_sidebar(array(
		'name' => 'Main Sidebar',
		'id' => 'main-sidebar',
	));
}
add_action('widgets_init', 'my_theme_widgets_init');
// ------------------------------
// siteurl
// ------------------------------
add_shortcode('surl', 'shortcode_surl');
function shortcode_surl()
{
	return site_url();
}
// ------------------------------
// ショートコード設定
// ------------------------------
function siteurl_shortcode()
{
	return site_url();
}
add_shortcode('siteurl', 'siteurl_shortcode');
function themeurl_shortcode()
{
	return get_bloginfo('template_url');
}
add_shortcode('themeurl', 'themeurl_shortcode');
// ------------------------------
// アイキャッチ画像を有効にする。
// ------------------------------
add_theme_support('post-thumbnails');
// ------------------------------
// css,jsの読み込み
// ------------------------------
function my_script_init()
{
	wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css', array(), null, false);
	wp_enqueue_script('swiper_js-01', get_template_directory_uri() . '/assets/js/libs/swiper-bundle.min.js', array(), null, true);
	wp_enqueue_script('swiper_js-02', get_template_directory_uri() . '/assets/js/swiper.js', array(), null, true);
	wp_enqueue_script('ajax_js', 'https://ajaxzip3.github.io/ajaxzip3.js', array(), false);
	wp_enqueue_script('js', get_template_directory_uri() . '/dist/bundle.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'my_script_init');
// ------------------------------
// type="module"をscriptタグに追加
// ------------------------------
function add_type_module_attribute($tag, $handle, $src)
{
	if ('js' === pathinfo($src, PATHINFO_EXTENSION) && in_array($handle, array('js', 'main', 'gsap'), true)) {
		$tag = '<script type="module" src="' . esc_url($src) . '"></script>';
	}
	return $tag;
}
add_filter('script_loader_tag', 'add_type_module_attribute', 10, 3);
// ------------------------------
// the_archive_title 余計な文字を削除
// ------------------------------
add_filter('get_the_archive_title', function ($title) {
	if (is_category()) {
		$title = single_cat_title('', false);
	} elseif (is_tag()) {
		$title = single_tag_title('', false);
	} elseif (is_tax()) {
		$title = single_term_title('', false);
	} elseif (is_post_type_archive()) {
		$title = post_type_archive_title('', false);
	} elseif (is_date()) {
		$title = get_the_time('Y年n月');
	} elseif (is_search()) {
		$title = '検索結果：' . esc_html(get_search_query(false));
	} elseif (is_404()) {
		$title = '「404」ページが見つかりません';
	} else {
	}
	return $title;
});
// ------------------------------
// worpdressのバージョン非表示
// ------------------------------
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'wp_resource_hints', 2);
remove_action('wp_head', 'wp_oembed_add_host_js');

// カテゴリーとタグのmeta descriptionからpタグを除去
remove_filter('term_description', 'wpautop');

// ------------------------------
// 記事IDを投稿画面に表示させる
// ------------------------------
function add_posts_columns_postid($columns)
{
	$columns['postid'] = 'ID';
	return $columns;
}
function add_posts_columns_postid_row($column_name, $post_id)
{
	if ('postid' == $column_name) {
		echo $post_id;
	}
}
add_filter('manage_posts_columns', 'add_posts_columns_postid');
add_action('manage_posts_custom_column', 'add_posts_columns_postid_row', 10, 2);

// ------------------------------
//サイト内検索で日本語の種類を区別しない 
// ------------------------------
function change_search_char($where, $obj)
{
	if ($obj->is_search) {
		$where = str_replace(".post_title", ".post_title COLLATE utf8_unicode_ci", $where);
		$where = str_replace(".post_content", ".post_content COLLATE utf8_unicode_ci", $where);
	}
	return $where;
}
add_filter('posts_where', 'change_search_char', 10, 2);
// ------------------------------
//パーマリンクからタクソノミー名を削除
// ------------------------------
function my_custom_post_type_permalinks_set($termlink, $term, $taxonomy)
{
	return str_replace('/' . $taxonomy . '/', '/', $termlink);
}
add_filter('term_link', 'my_custom_post_type_permalinks_set', 11, 3);

// ------------------------------
// wp_nav_menuのliにclass追加
// ------------------------------
function add_additional_class_on_li($classes, $item, $args)
{
  if (isset($args->add_li_class)) {
    $classes['class'] = $args->add_li_class;
  }
  return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

// wp_nav_menuのaにclass追加
function add_additional_class_on_a($classes, $item, $args)
{
  if (isset($args->add_li_class)) {
    $classes['class'] = $args->add_a_class;
  }
  return $classes;
}
add_filter('nav_menu_link_attributes', 'add_additional_class_on_a', 1, 3);