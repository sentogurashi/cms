<?php get_header();
require_once('logic/colorManager.php');
$colorManager = new ColorManager();
?>

<div class="MainVisual" style="background-image:url('<?php echo $static_assets_path ?>images/standalone/article/top.jpg')">
  <h1 class="MainVisual__title">
    <a href="<?php echo home_url('/') ?>"><?php echo bloginfo('name') ?></a>
  </h1>
<?php
for ($i = 0; $i < 3 ; $i++) { ?>
  <canvas class="Wave__canvas Wave__canvas--<?php echo $i+1 ?> js-Wave__canvas--<?php echo $i+1 ?>"></canvas>
<?php } ?>
</div>

<div class="CategoryNavigation js-CategoryNavigation">
<?php wp_nav_menu([
  'menu_class' => 'CategoryNavigation__items',
  'container' => false
]); ?>
</div>

<ul class="CellList">
<?php
if(have_posts()):
  while(have_posts()):
    the_post();
?>

<li class="Cell">
  <a href="<?php the_permalink(); ?>">
    <?php if (has_post_thumbnail()) { ?>
    <div class="Cell__thumbNail" style="background-image:url('<?php echo get_the_post_thumbnail_url(false, 'thumbnail') ?>')"></div>
    <?php } else { ?>
    <div class="Cell__thumbNail Cell__thumbNail--noImage" style="background-image: linear-gradient(45deg,<?php echo $colorManager->getRandomHexColor(); ?>  0%,<?php echo $colorManager->getRandomHexColor(); ?>  100%);"></div>
    <?php } ?>
    <div class="Cell__main">
      <?php get_categories_label(false, 'Cell__category') ?>
      <p class="Cell__title"><?php the_title(); ?></p>
      <p class="Cell__date"><?php echo get_the_date();?></p>
    </div>
  </a>
  <?php the_tags( '<ul class="Cell__tags"><li>', '</li><li>', '</li></ul>' ); ?>
</li>

<?php
  endwhile;
else:
?>
<div class="Notice">
  <p class="Notice__text">記事はありません</p>
</div>
<?php
endif;
?>
</ul>
<!-- /.CellList -->

<div class="SocialButtonContainer">
<?php get_template_part('part/share'); ?>
</div>
<?php wp_enqueue_script('article-index-js', $static_assets_path . 'scripts/article-index.bundle.js'); ?>
<?php get_footer(); ?>