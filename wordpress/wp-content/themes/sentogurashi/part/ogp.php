<?php
global $post;
global $static_assets_path;

$meta_info = [
  'fb:app_id' => '306929856428469',
  'og:type' => 'article',
  'og:description' => get_meta_description(),
  'og:locale' => 'ja_JP',
  'og:site_name' => get_bloginfo('name'),
  'twitter:card' => 'summary_large_image'
];

if(is_single()) {
  $image_info = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
  $image_url = $image_info[0];

  $meta_info['og:title'] = get_the_title();
  $meta_info['og:url'] = get_the_permalink();
  $meta_info['og:image'] = $image_url;
  $meta_info['twitter:image'] = $image_url;
  $meta_info['og:image:width'] = $image_info[1];
  $meta_info['og:image:height'] = $image_info[2];
} else {
  $image_url = $static_assets_path . 'images/standalone/article/ogimage.jpg';

  $meta_info['og:title'] = get_bloginfo('title');
  $meta_info['og:url'] = get_bloginfo('url');
  $meta_info['og:image'] = $image_url;
  $meta_info['twitter:image'] = $image_url;
  $meta_info['og:image:width'] = 1200;
  $meta_info['og:image:height'] = 630;
}

$meta_tags = [];
foreach ($meta_info as $property => $content) {
  array_push($meta_tags, "<meta property=\"{$property}\" content=\"{$content}\">");
}

echo join("\n", $meta_tags);