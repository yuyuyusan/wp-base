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
	wp_enqueue_style('style', get_template_directory_uri() . '/dist/css/style.css', array(), null, false);
	wp_enqueue_script('swiper_js-01', get_template_directory_uri() . '/dist/js/lib/swiper-bundle.min.js', array(), null, true);
	wp_enqueue_script('swiper_js-02', get_template_directory_uri() . '/src/js/swiper.js', array(), null, true);
	wp_enqueue_script('ajax_js', 'https://ajaxzip3.github.io/ajaxzip3.js', array(), false);
	wp_enqueue_script('js', get_template_directory_uri() . '/src/js/index.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'my_script_init');
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
// カテゴリーとタグのmeta descriptionからpタグを除去
// ------------------------------
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
//メニュー説明
// ------------------------------
function edit_menu_link($atts, $item)
{
	// メニュー項目が「説明」を持っている場合
	if (!empty($item->description)) {
		// リンクにdata-desc属性を追加する
		$atts['data-desc'] = $item->description;
	}
	return $atts;
}
add_filter('nav_menu_link_attributes', 'edit_menu_link', 10, 2);

// ------------------------------
// カスタム投稿のパーマリンク設定
// ------------------------------
//パーマリンクからタクソノミー名を削除
function my_custom_post_type_permalinks_set($termlink, $term, $taxonomy)
{
	return str_replace('/' . $taxonomy . '/', '/', $termlink);
}
add_filter('term_link', 'my_custom_post_type_permalinks_set', 11, 3);

//リライトルールの追加	
//★それぞれownersblogはカスタム投稿タイプ名、ownersblog-catはカスタムタクソノミー名を挿入

//↓カスタム投稿タイプの一覧ページ
add_rewrite_rule('works/page/([0-9]+)/?$', 'index.php?post_type=works&paged=$matches[1]', 'top');

//↓親タームに属する記事ページ
add_rewrite_rule('works/([^/]+)/([0-9]+)/?$', 'index.php?post_type=works&p=$matches[2]', 'top');

//↓親ターム一覧ページ
add_rewrite_rule('works/([^/]+)/?$', 'index.php?shop_cat=$matches[1]', 'top');
add_rewrite_rule('works/([^/]+)/page/([0-9]+)/?$', 'index.php?shop_cat=$matches[1]&paged=$matches[2]', 'top');

//↓子ターム一覧ページ
add_rewrite_rule('works/([^/]+)/([^/]+)/?$', 'index.php?shop_cat=$matches[2]', 'top');
add_rewrite_rule('works/([^/]+)/([^/]+)/page/([0-9]+)/?$', 'index.php?shop_cat=$matches[1]&paged=$matches[2]', 'top');


// タクソノミー未選択公開時にデフォルトで特定のタームを選択させる

function add_defaulttaxonomy($post_ID)
{
	global $wpdb;
	//カスタム分類のタームを取得
	$curTerm = wp_get_object_terms($post_ID, 'shop_cat'); //★カスタムタクソノミー名
	//ターム指定数が未設定の時に特定のタームを指定
	if (0 == count($curTerm)) {
		$defaultTerm = array(1); //★選択させたいタームID
		wp_set_object_terms($post_ID, $defaultTerm, 'shop_cat'); //★カスタムタクソノミー名
	}
}
//カスタム投稿
add_action('publish_works', 'add_defaulttaxonomy'); //★publish_カスタム投稿タイプ名


// ------------------------------
// カスタム投稿のパーマリンク設定
// ------------------------------
add_action(
	'pre_get_posts',
	function ($query) {
		if (is_admin() && !$query->is_main_query()) {
			return;
		}
		if (is_tax('shop_cat')) {
			$query->set('posts_per_page', 9);
			return;
		}
	}
);





// ------------------------------
// keywords description
// // ------------------------------
// add_action('admin_menu', 'add_custom_fields');
// add_action('save_post', 'save_custom_fields');

// // 記事ページと固定ページでカスタムフィールドを表示
// function add_custom_fields()
// {
// 	add_meta_box('my_sectionid', 'カスタムフィールド', 'my_custom_fields', 'post');
// 	add_meta_box('my_sectionid', 'カスタムフィールド', 'my_custom_fields', 'page');
// }
// function my_custom_fields()
// {
// 	global $post;
// 	// $keywords = get_post_meta($post->ID, 'keywords', true);
// 	$description = get_post_meta($post->ID, 'description', true);
// 	// echo '<p>キーワード（半角カンマ区切り）<br>';
// 	// echo '<input type="text" name="keywords" value="' . esc_html($keywords) . '" size="60"></p>';
// 	echo '<p>ページの説明（description）140文字以内 ※未入力の場合本文の最初が抜粋されます<br>';
// 	echo '<input type="text" style="width: 600px;height: 40px;" name="description" value="' . esc_html($description) . '" maxlength="140"></p>';
// }

// // カスタムフィールドの値を保存
// function save_custom_fields($post_id)
// {
// 	// if (!empty($_POST['keywords'])) {
// 	// 	update_post_meta($post_id, 'keywords', $_POST['keywords']);
// 	// } else {
// 	// 	delete_post_meta($post_id, 'keywords');
// 	// }
// 	if (!empty($_POST['description'])) {
// 		update_post_meta($post_id, 'description', $_POST['description']);
// 	} else {
// 		delete_post_meta($post_id, 'description');
// 	}
// }
// function metaTitle()
// {
// 	// カスタムフィールドの値を読み込む
// 	$custom = get_post_custom();
// 	// if (!empty($custom['keywords'][0])) {
// 	// 	$keywords = $custom['keywords'][0];
// 	// }
// 	if (!empty($custom['description'][0])) {
// 		$description = $custom['description'][0];
// 	}
// 	if (is_home()) { // トップページ
// 		// echo '<meta name="keywords" content="' . $keywords . '">';
// 		echo '<meta name="description" content="' . $description . '">';
// 	} elseif (is_single()) { // 記事ページ
// 	// 	// echo '<meta name="keywords" content="' . $keywords . '">';
// 		echo '<meta name="description" content="' . $description . '">';
// 	} elseif (is_page()) { // 固定ページ
// 		// echo '<meta name="keywords" content="' . $keywords . '">';
// 		echo '<meta name="description" content="' . $description . '">';
// 	} elseif (is_archive()) { // 記事ページ
// 		// echo '<meta name="keywords" content="' . $keywords . '">';
// 		echo '<meta name="description" content="' . $description . '">';
// 	} elseif (is_category()) { // カテゴリーページ
// 		echo '<meta name="description" content="' . single_cat_title() . 'の記事一覧">';
// 	} elseif (is_tag()) { // タグページ
// 		echo '<meta name="robots" content="noindex, follow">';
// 		echo '<meta name="description" content="' . single_tag_title("", true) . 'の記事一覧">';
// 	} elseif (is_404()) { // 404ページ
// 		echo '<meta name="robots" content="noindex, follow">';
// 		echo '<title>404:お探しのページが見つかりませんでした</title>';
// 	} else { // その他ページ
// 		echo '<meta name="robots" content="noindex, follow">';
// 	};
// }


// 固定ページで「抜粋」を有効化
// add_post_type_support('page', 'excerpt');


// ------------------------------
//リライトルールの書き替え プラグインFV top levelを使用しないで投稿のページ送り等
// // ------------------------------
// function my_category_rewrite_rules_array($rules) {
//   // 順番の入れ替え
//   $exp = '(.+?)/page/?([0-9]{1,})/?$';
//   $add_rules[$exp] = $rules[$exp];
//   unset($rules[$exp]);
//   return $add_rules + $rules;
// }
// add_action('rewrite_rules_array', 'my_category_rewrite_rules_array', 10, 1);



// ------------------------------
//メニュー表示設定
// ------------------------------
// function remove_menus() {
//   remove_menu_page( 'index.php' ); // ダッシュボード
//   remove_menu_page( 'edit.php' ); // 投稿
//   remove_menu_page( 'upload.php' ); // メディア
//   remove_menu_page( 'edit.php?post_type=page' ); // 固定
//   remove_menu_page( 'edit-comments.php' ); // コメント
//   remove_menu_page( 'themes.php' ); // 外観
//   remove_menu_page( 'plugins.php' ); // プラグイン
//   remove_menu_page( 'users.php' ); // ユーザー
//   remove_menu_page( 'tools.php' ); // ツール
//   remove_menu_page( 'options-general.php' ); // 設定
// }
// add_action( 'admin_menu', 'remove_menus' );

// ------------------------------
//投稿名設定
// ------------------------------
// function change_post_menu_label() {
// 	global $menu;
// 	global $submenu;
// 	$menu[5][0] = 'News';
// 	$submenu['edit.php'][5][0] = 'News一覧';
// 	$submenu['edit.php'][10][0] = '新しいNews';
// 	$submenu['edit.php'][16][0] = 'タグ';
// }
// function change_post_object_label() {
// 	global $wp_post_types;
// 	$labels = &$wp_post_types['post']->labels;
// 	$labels->name = 'News';
// 	$labels->singular_name = 'News';
// 	$labels->add_new = _x('追加', 'News');
// 	$labels->add_new_item = 'Newsの新規追加';
// 	$labels->edit_item = 'Newsの編集';
// 	$labels->new_item = '新規News';
// 	$labels->view_item = 'Newsを表示';
// 	$labels->search_items = 'Newsを検索';
// 	$labels->not_found = '記事が見つかりませんでした';
// 	$labels->not_found_in_trash = 'ゴミ箱に記事は見つかりませんでした';
// }
// add_action( 'init', 'change_post_object_label' );
// add_action( 'admin_menu', 'change_post_menu_label' );

// ------------------------------
//管理ツールバー メニュー表示設定
// ------------------------------
// function mytheme_remove_item( $wp_admin_bar ) {
// 	$wp_admin_bar->remove_node('wp-logo'); //wordpressロゴ
// 	$wp_admin_bar->remove_node('site-name'); //サイト名
// 	$wp_admin_bar->remove_node('updates'); //アップデート通知
// 	$wp_admin_bar->remove_node('comments'); //コメント
// 	$wp_admin_bar->remove_node('new-content'); //新規追加
// 	$wp_admin_bar->remove_node('new-media'); // メディア
// 	$wp_admin_bar->remove_node('new-link'); // リンク
// 	$wp_admin_bar->remove_node('new-page'); // 個別ページ
// 	$wp_admin_bar->remove_node('new-user'); // ユーザー
// 	$wp_admin_bar->remove_node('view'); //投稿を表示
// 	$wp_admin_bar->remove_node('archive'); //投稿一覧を表示
// 	$wp_admin_bar->remove_node('my-account'); //右のプロフィール欄全体
// 	$wp_admin_bar->remove_node('edit-profile'); // プロフィール編集
// 	$wp_admin_bar->remove_node('user-info'); // ユーザー
// 	$wp_admin_bar->remove_node('logout'); //ログアウト
// }
// add_action( 'admin_bar_menu', 'mytheme_remove_item', 1000 );

// ------------------------------
//管理ツールバー 表示設定
// ------------------------------
// add_filter('show_admin_bar', '__return_false');
