<?php
require_once(dirname(__FILE__) . '/../logic/colorManager.php');
$colorManager = new ColorManager();
?>
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