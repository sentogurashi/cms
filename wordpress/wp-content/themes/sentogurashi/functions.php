<?php

// メニューカスタマイズon
add_theme_support('menus');

// ウィジェットon & サイドバーのラッパータグを設定
register_sidebar(
  [
    'id' => 'sidebar-1',
    'before_widgets' => '<div class="widget">',
    'after_widgets' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ]
);