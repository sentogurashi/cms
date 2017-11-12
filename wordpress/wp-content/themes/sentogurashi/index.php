<?php get_header();
?>
<div class="MainVisual" style="background-image:url('<?php echo $static_assets_path ?>images/standalone/article/top.jpg')">
  <h1 class="MainVisual__title">
    <a href="<?php echo home_url('/') ?>"><?php echo bloginfo('name') ?></a>
  </h1>
<?php get_template_part('part/waveEffect'); ?>
</div>

<div class="CategoryNavigation js-CategoryNavigation">
<?php wp_nav_menu([
  'menu_class' => 'CategoryNavigation__items',
  'container' => false
]); ?>
</div>

<?php get_template_part('part/cellList'); ?>

<div class="SocialButtonContainer">
<?php get_template_part('part/share'); ?>
</div>
<?php wp_enqueue_script('article-index-js', $static_assets_path . 'scripts/article-index.bundle.js'); ?>
<?php get_footer(); ?>