<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/reset.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
</head>
<body>
  <div id="header" class="container">
    <h1><a href="<?php echo home_url('/') ?>"><?php echo bloginfo('name') ?></a></h1>
    <?php wp_nav_menu(); ?>
  </div>
  <!-- /#header.container -->
<?php wp_head(); ?>