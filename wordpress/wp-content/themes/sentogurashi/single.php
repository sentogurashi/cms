<?php
get_header();

require_once('logic/colorManager.php');
$colorManager = new ColorManager();

if(have_posts()):
  while(have_posts()):
    the_post();
?>

<article class="Article">
<?php if (has_post_thumbnail()) { ?>
  <div class="Article__photoWrapper">
    <div class="Article__photoMain js-Article__photoMain" style="background-image:url('<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'large')[0] ?>')"></div>
    <?php
    for ($i = 0; $i < 3 ; $i++) { ?>
      <canvas class="Wave__canvas Wave__canvas--<?php echo $i+1 ?> js-Wave__canvas--<?php echo $i+1 ?>"></canvas>
    <?php } ?>
  </div>
<?php } ?>
  <div class="Article__inner">
    <div class="Article__titleWrapper">
      <h1 class="Article__headingLv1"><?php the_title() ?></h1>
      <div class="Article__titleInfo">
        <?php get_categories_label(true, 'Article__titleCategory'); ?>
        <p class="Article__titleDate"><?php echo get_the_date(); ?></p>
        <?php the_tags('<ul class="Article__titleTags"><li>', '</li><li>', '</li></ul>'); ?>
      </div>
    </div>
    <section class="Article__main">
<?php the_content(); ?>
    </section>
<?php
get_template_part('part/share');
get_template_part('part/profile');
?>
  </div>
</article>

<?php
  endwhile;
endif;

$relatedArticles = get_field('related_articles');
if ($relatedArticles): ?>
<aside class="RelatedArticles">
<h2 class="RelatedArticles__title">あわせて読みたい</h2>
<ul class="CellList">
<?php
  foreach($relatedArticles as $id):
?>
<li class="Cell">
  <a href="<?php echo get_the_permalink($id); ?>">
    <?php if (has_post_thumbnail($id)) { ?>
    <div class="Cell__thumbNail" style="background-image:url('<?php echo get_the_post_thumbnail_url($id, 'thumbnail'); ?>')"></div>
    <?php } else { ?>
    <div class="Cell__thumbNail Cell__thumbNail--noImage" style="background-image: linear-gradient(45deg,<?php echo $colorManager->getRandomHexColor(); ?>  0%,<?php echo $colorManager->getRandomHexColor(); ?>  100%);"></div>
    <?php } ?>
    <div class="Cell__main">
      <?php get_categories_label(false, 'Cell__category', $id); ?>
      <p class="Cell__title"><?php echo get_the_title($id); ?></p>
      <p class="Cell__date"><?php echo get_the_date(false, $id);?></p>
    </div>
  </a>
  <?php
  $tags = get_the_tags($id);
  if ($tags):
  ?>
  <ul class="Cell__tags">
  <?php
    $tags = array_merge($tags, []);
    foreach($tags as $tag):
    ?>
    <li>
      <a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>
    </li>
    <?php endforeach; ?>
  </ul>
  <?php endif; ?>
</li>

<?php endforeach; ?>
</ul>
<!-- /.CellList -->
</aside>
<!-- /.RelatedArticles -->
<?php endif; ?>

<?php wp_enqueue_script('article-index-js', $static_assets_path . 'scripts/article-detail.bundle.js'); ?>
<?php get_footer() ?>