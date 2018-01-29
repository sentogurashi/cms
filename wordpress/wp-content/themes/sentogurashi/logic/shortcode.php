<?php
/* ------------
  shortcode
 ------------ */
// 画像ラッパー
add_shortcode('image_wrap', function ($atts, $content) {

  extract(shortcode_atts([
    'caption' => ''
  ], $atts));

  $wrapped_tag = '<div class="Article__innerImage">' . $content;

  if($caption !== '') {
    $wrapped_tag .= '<cite class="Article__caption">' . esc_html($caption) . '</cite>';
  }

  $wrapped_tag .= '</div>';

  return $wrapped_tag;
});

add_shortcode('deflist_wrap', function ($atts, $content) {

  $content = do_shortcode(shortcode_unautop($content));
  $wrapped_tag = '<div class="Article__defList">' . $content . '</div>';

  return $wrapped_tag;
});

add_shortcode('deflist', function ($atts, $content) {

  extract(shortcode_atts([
    'term' => '',
    'description' => ''
  ], $atts));

  $wrapped_tag = '<dl>' . $content;

  if($term !== '') {
    $wrapped_tag .= '<dt>' . esc_html($term) . '</dt>';
  }

  if($description !== '') {
    $wrapped_tag .= '<dd>' . esc_html($description) . '</dd>';
  }

  $wrapped_tag .= '</dl>';

  return $wrapped_tag;
});

add_shortcode('movie', function ($atts, $content) {

  return <<<EOM
  <div class="Article__movie">
    ${content}
  </div>
EOM;
});

add_shortcode('profile', function ($atts, $content) {

  extract(shortcode_atts([
    'name' => '',
    'img' => '',
    'text' => ''
  ], $atts));

  return <<<EOM
  <div class="Article__profile">
    <div class="Article__profileColumn Article__profileColumn--left">
      <div class="Article__profilePhoto" style="background-image: url('${img}')"></div>
    </div>
    <div class="Article__profileColumn Article__profileColumn--right">
      <div class="Article__profileName">${name}</div>
      <div class="Article__profileText">${text}</div>
    </div>
  </div>
EOM;
});

add_shortcode('gmap', function ($atts, $content) {

  extract(shortcode_atts([
    // 何も入ってこない場合は東京にセット
    'lat' => '35.689521',
    'lon' => '139.691704',
    'zoom' => '16'
  ], $atts));

  return <<<EOM
<div class="Article__map js-Article__map" style="width: 100%; height:450px;"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4I0l_TnkmiAjPeKgJJ6OOy27h_5uFtxk"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var position = new google.maps.LatLng(${lat}, ${lon});
  var map = new google.maps.Map(
    document.querySelector('.js-Article__map'), {
      zoom: ${zoom},
      center: position,
      scrollWheel: false,
      // disable UI controls
      mapTypeControl: false,
      scaleControl: false,
      streetViewControl: false,
      rotateControl: false,
      fullscreenControl: false
    }
  )
  map.setOptions({
    styles: [{
      stylers: [{
        saturation: -100
      }]
    }]
  });
  var marker = new google.maps.Marker({
    position: position,
    map: map
  })
});
</script>

EOM;
});
