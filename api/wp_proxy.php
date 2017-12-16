<?php
$endPoint = 'http://sentogurashi.com/article/wp-json/wp/v2/posts?';
$query = $_SERVER['QUERY_STRING'];

$context = stream_context_create([
  'http' => [
    'ignore_errors' => true
  ]
]);

$postList = json_decode(file_get_contents($endPoint . $query, false, $context));

if(!$postList->data->status) {

  $resultArray = [];

  foreach ($postList as $key => $value) {

    $tags = [];
    $categories = [];

    foreach ($value->tag_list as $tagKey => $tagValue) {
      array_push($tags, $tagValue->name);
    }

    foreach ($value->category_list as $categoryKey => $categoryValue) {
      array_push($categories, [
        'name' => $categoryValue->name,
        'slug' => $categoryValue->slug
      ]);
    }

    array_push($resultArray, [
      'link' => $value->link,
      'title' => $value->title->rendered,
      'date' => $value->date,
      'tags' => $tags,
      'categories' => $categories,
      'thumbnail' => $value->_embedded->{'wp:featuredmedia'}[0]->media_details->sizes->thumbnail->source_url
    ]);
  }

  $response = json_encode([
    'status' => 'ok',
    'data' => $resultArray
  ]);

} else {

  $response = json_encode([
    'status' => 'failed',
    'data' => []
  ]);
}

header('content-type: application/json; charset=utf-8');
echo $response;