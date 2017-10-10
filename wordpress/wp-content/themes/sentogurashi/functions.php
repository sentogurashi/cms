<?php

// 管理バー非表示
add_filter('show_admin_bar', '__return_false');
// 自動pタグ挿入をoff
remove_filter('the_content', 'wpautop');

/* ------------
  base
 ------------ */

// staticファイルを読み込む
// http://rfs.jp/sb/wordpress/wp-lab/wp_enqueue_script.html
function add_static_files() {
  // WordPress提供のjquery.jsを読み込まない
  wp_deregister_script('jquery');
  // 絶対パスJS読み込み
  wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js');
  wp_enqueue_script( 'theme-common', '//www.sentogurashi.com/assets/scripts/common.bundle.js');
  // サイト共通JS
  //wp_enqueue_script( 'smart-script', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '20160608', true );
  // CSSの読み込み
  // TODO: あとでcommon参照変える
  wp_enqueue_style( 'theme-common', get_template_directory_uri() . '/static/styles/common.css');
  wp_enqueue_style( 'article', get_template_directory_uri() . '/static/styles/article.css');
  wp_enqueue_style( 'main', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'add_static_files');

// メインセットアップ
function theme_setup() {
  // メニューカスタマイズon
  add_theme_support('menus');

  // アイキャッチサポート
  add_theme_support('post-thumbnails');

  // titleタグ生成
  add_theme_support('title-tag');
}
add_action('after_setup_theme', 'theme_setup');

/* ------------
  shortcode
 ------------ */
function image_wrap($atts, $content) {
  extract(shortcode_atts([
    'caption' => ''
  ], $atts));
  return '<div class="Article__innerImage">' . $content . '<cite class="Article__caption">' . esc_html($caption) . '</cite></div>';
}
add_shortcode('image_wrap', 'image_wrap');

/* ------------
  filter
 ------------ */

// クラスを削除して、表示中メニューに 'is-active' クラスを付与する
// https://memocarilog.info/wordpress/6514
function remove_to_activeClass($classes, $item) {
    $classes = array();
    if( $item -> current == true ) {
        $classes[] = 'is-active';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'remove_to_activeClass', 10, 2 );
// IDを削除する
function removeId( $id ){
    return $id = array();
}
add_filter('nav_menu_item_id', 'removeId');

// プロフィールを拡張
// http://presentnote.com/useful-setup-to-write-by-several-authors02/
function custom_contactmethods( $contactmethods ) {
  $contactmethods['twitter'] = 'twitter';
  $contactmethods['facebook'] = 'facebook';
  $contactmethods['instagram'] = 'Instagram';
  $contactmethods['first_name_en'] = '名前（アルファベット）';
  $contactmethods['last_name_en'] = '名字（アルファベット）';
  $contactmethods['job'] = '肩書き';
  return $contactmethods;
}
add_filter('user_contactmethods','custom_contactmethods',10,1);

/* ------------
  utility
 ------------ */

// カテゴリのラベル化
// http://www.webopixel.net/wordpress/933.html
function get_categories_label($isSetLink, $className) {
    $categories = get_the_category();
    foreach($categories as $category){
        if($isSetLink) {
          echo '<a href="' . get_category_link($category->term_id) . '" class="' . $className . ' ' . $className . '--' . esc_attr($category->slug) . '">'. esc_html($category->name) . '</a>';
        } else {
          echo '<p class="' . $className . ' ' . $className . '--' . esc_attr($category->slug) . '">'. esc_html($category->name) . '</p>';
        }

    }
}

// アバターURLの抽出
// http://weble.org/2012/04/20/wordpress-get-avatar-url
function get_wp_user_avatar_url($id_or_email, $size = null, $default = null, $alt = null) {
    $image = get_wp_user_avatar($id_or_email, $size, $default, $alt);
    if(preg_match('/src="(.*?)"/', $image, $match)) {
        if(isset($match[1])) {
            return $match[1];
        } else {
            return false;
        }
    } else {
        return false;
    }
}