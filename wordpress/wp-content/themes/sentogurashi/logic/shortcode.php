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
