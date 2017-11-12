<?php
$static_assets_path = 'http://www.sentogurashi.com/assets/';

/* ------------
  base
 ------------ */

// staticファイルを読み込む
// http://rfs.jp/sb/wordpress/wp-lab/wp_enqueue_script.html
function add_static_files() {
  global $static_assets_path;
  // WordPress提供のjquery.jsを読み込まない
  wp_deregister_script('jquery');
  // 絶対パスJS読み込み
  wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js');
  wp_enqueue_script( 'theme-common', $static_assets_path . 'scripts/common.bundle.js');
  // CSSの読み込み
  wp_enqueue_style( 'theme-common', $static_assets_path . 'styles/common.css');
  wp_enqueue_style( 'article',  $static_assets_path . 'styles/article.css');
  // wp_enqueue_style( 'main', get_stylesheet_uri());
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
// 画像ラッパー
function image_wrap($atts, $content) {

  extract(shortcode_atts([
    'caption' => ''
  ], $atts));

  $wrapped_tag = '<div class="Article__innerImage">' . $content;

  if($caption !== '') {
    $wrapped_tag .= '<cite class="Article__caption">' . esc_html($caption) . '</cite>';
  }

  $wrapped_tag .= '</div>';

  return $wrapped_tag;
}
add_shortcode('image_wrap', 'image_wrap');

/* ------------
  disables
 ------------ */

// 絵文字対応off
// http://hayashikejinan.com/wordpress/1240/
remove_action( 'wp_head', 'print_emoji_detection_script', 7);
remove_action( 'wp_print_styles', 'print_emoji_styles', 10);

// 管理バー非表示
add_filter('show_admin_bar', '__return_false');
// 自動pタグ挿入をoff
remove_filter('the_content', 'wpautop');

// 余計なヘッダ情報の刈り取り
// https://wp-setting.info/setting/remove_header_edituri_wlwmanifest.html
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

// エディタの自動整形機能をoff
// https://qiita.com/jyokyoku/items/c560b0d1eacc1df61620
// http://accelboon.com/tn/?p=701
// 自動改行の無効化
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');
// 引用符変換の無効化
remove_filter('the_content', 'wptexturize');
remove_filter('the_excerpt', 'wptexturize');
// タグ変換の無効化
remove_filter('the_content', 'convert_chars');
remove_filter('the_excerpt', 'convert_chars');
// ビジュアルエディタの自動変換を無効化
function override_mce_options( $init_array ) {
  global $allowedposttags;

  $init_array['valid_elements']          = '*[*]';
  $init_array['extended_valid_elements'] = '*[*]';
  $init_array['valid_children']          = '+a[' . implode('|', array_keys($allowedposttags)) . ']';
  $init_array['indent']                  = true;
  $init_array['wpautop']                 = false;
  $init_array['force_p_newlines']        = false;

  return $init_array;
}
add_filter('tiny_mce_before_init', 'override_mce_options');

//画像挿入時の不要アトリビュート削除
// https://pg.kdtk.net/834
add_filter('image_send_to_editor', 'remove_img_att');
add_filter('post_thumbnail_html', 'remove_img_att');
function remove_img_att($html){
  $html = preg_replace('/(width|height)="\d*"\s/', '', $html);
  return $html;
}

add_filter('get_image_tag_class', 'remove_image_classname');
function remove_image_classname($class) {
  $class = preg_replace('/(alignnone|aligncenter|alignleft|alginright) /i', '', $class);
  return $class;
}

/* ------------
  filter
 ------------ */

// クラスを削除して、表示中メニューに 'is-active' クラスを付与する
// https://memocarilog.info/wordpress/6514
function remove_to_activeClass($classes, $item) {
    $classes = array();
    $classes[] = 'CategoryNavigation__item';
    if( $item -> current === true ) {
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
function get_categories_label($isSetLink, $className, $id = false) {
    $categories = get_the_category($id);
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

// descriptionの抽出
// http://easyramble.com/wordpress-meta-description.html
function get_meta_description() {
  global $post;
  $description = '';
  if (is_home()) {
    // ホームでは、ブログの説明文を取得
    $description = get_bloginfo('description');
  }
  else if (is_category()) {
    // カテゴリーページでは、カテゴリーの説明文を取得
    $description = category_description();
  }
  else if (is_single()) {
    /*
    if ($post->post_excerpt) {
      // 記事ページでは、記事本文から抜粋を取得
      $description = $post->post_excerpt;
    } else {
    */
    // post_excerpt で取れない時は、自力で記事の冒頭100文字を抜粋して取得
    $description = strip_tags($post->post_content);
    $description = strip_shortcodes($description);
    $description = str_replace("\n", '', $description);
    $description = str_replace("\r", '', $description);
    $description = mb_substr($description, 0, 100) . '…';
    //}
  }

  return $description;
}