<?php
get_header();

if(have_posts()):
  while(have_posts()):
    the_post();
?>

<article class="Article">
<?php if (has_post_thumbnail()) { ?>
  <div class="Article__photoWrapper">
    <div class="Article__photoMain js-Article__photoMain" style="background-image:url('<?php echo get_the_post_thumbnail_url(false, 'large') ?>')"></div>
<?php get_template_part('part/waveEffect'); ?>
  </div>
<?php } ?>
  <div class="Article__inner">
    <div class="Article__titleWrapper">
      <h1 class="Article__headingLv1"><?php the_title() ?></h1>
      <div class="Article__titleInfo">
        <?php get_categories_label(true, 'Article__titleCategory'); ?>
        <p class="Article__titleDate"><?php echo get_the_date(); ?></p>
        <p class="Article__titleAuthorName">text by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author_meta('last_name') . get_the_author_meta('first_name'); ?></a></p>
        <?php the_tags('<ul class="Article__titleTags"><li>', '</li><li>', '</li></ul>'); ?>
      </div>
<?php get_template_part('part/share'); ?>
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
?>

<?php get_template_part('part/relatedArticles'); ?>

<?php get_footer() ?>