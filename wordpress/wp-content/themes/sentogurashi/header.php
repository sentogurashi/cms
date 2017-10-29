<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
  <meta charset="<?php bloginfo('charset') ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="<?php echo get_meta_description(); ?>">
  <?php get_template_part('part/ogp'); ?>
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-100837084-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-100837084-1');
  </script>
  <?php wp_head(); ?>
</head>
<body>
<div class="Content js-Content">
  <div class="Column">

<?php get_template_part('part/navigation'); ?>

    <div class="Main">
