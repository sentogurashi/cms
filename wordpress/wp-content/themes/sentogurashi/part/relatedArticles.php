<?php
require_once(dirname(__FILE__) . '/../logic/colorManager.php');
$colorManager = new ColorManager();

$relatedArticles = get_field('related_articles');
if ($relatedArticles): ?>
<aside class="RelatedArticles Module">
<h2 class="Module__heading">あわせて読みたい</h2>
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