<?php
// ------------------------------
// アイキャッチ画像を有効にする。
// ------------------------------
add_theme_support('post-thumbnails');
// ------------------------------
// css,jsの読み込み
// ------------------------------
function my_script_init()
{
	wp_enqueue_style('style', get_template_directory_uri() . '/dist/css/style.css', array(), null, false);
	wp_enqueue_style('splide_css', get_template_directory_uri() . '/src/libs/css/splide.min.css', array(), null, false);
	wp_enqueue_script('ajax_js', 'https://ajaxzip3.github.io/ajaxzip3.js', array(), false);
	wp_enqueue_script('fontawsome', 'https://kit.fontawesome.com/6619226b9a.js', array(), false);
	wp_enqueue_script('splide-js', get_template_directory_uri() . '/dist/js/splide.bundle.js', array(), null, false);
	wp_enqueue_script('js', get_template_directory_uri() . '/dist/js/main.bundle.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'my_script_init');

// type="module"をscriptタグに追加
function add_type_module_attribute($tag, $handle, $src)
{
	$modules = array('js', 'splide-js');

	if ('js' === pathinfo($src, PATHINFO_EXTENSION) && in_array($handle, $modules, true)) {
		$tag = '<script type="module" src="' . esc_url($src) . '"></script>';
	}
	return $tag;
}
add_filter('script_loader_tag', 'add_type_module_attribute', 10, 3);

// worpdressのバージョン非表示
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

// 記事IDを投稿画面に表示させる
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

//パーマリンクからタクソノミー名を削除
function my_custom_post_type_permalinks_set($termlink, $term, $taxonomy)
{
	return str_replace('/' . $taxonomy . '/', '/', $termlink);
}
add_filter('term_link', 'my_custom_post_type_permalinks_set', 11, 3);


// wp_nav_menuのliにclass追加
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

// 指定したカスタムポストの詳細ページを404にする
function redirect_case_single_page_404()
{
	if (is_singular('stores')) {
		global $wp_query;
		$wp_query->set_404();
		status_header(404);
		get_template_part(404);
		exit();
	}
}
add_action('template_redirect', 'redirect_case_single_page_404');

// カテゴリーの階層をURLに反映させる
function category_link_custom($query)
{
	if (isset($query['name']) && isset($query['page'])) {
		if ($query['name'] === 'page' && is_numeric($query['page'])) {
			$query['paged'] = (int) $query['page'];
			unset($query['name']);
			unset($query['page']);
		}
	}

	if (isset($query['category_name']) && strpos($query['category_name'], '/') === false && isset($query['name'])) {
		$parent_category = get_category_by_slug($query['category_name']);
		if ($parent_category instanceof WP_Term) {
			$child_categories = get_categories('child_of=' . $parent_category->term_id);
			foreach ($child_categories as $child_category) {
				if ($query['name'] === $child_category->category_nicename) {
					$query['category_name'] = $query['category_name'] . '/' . $query['name'];
					unset($query['name']);
					break;
				}
			}
		}
	}
	return $query;
}
add_filter('request', 'category_link_custom');
