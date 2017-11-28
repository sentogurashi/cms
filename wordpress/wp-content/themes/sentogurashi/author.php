<?php get_header();
?>

<section class="AuthorPageProfile">
  <div class="AuthorPageProfile__photo" style="background-image: url('<?php echo get_wp_user_avatar_url(get_the_author_meta('ID')) ?>')"></div>
  <h1 class="AuthorPageProfile__nameJp"><?php echo get_the_author_meta('last_name') . ' ' . get_the_author_meta('first_name'); ?></h1>
  <div class="AuthorPageProfile__nameSub">
    <p class="AuthorPageProfile__nameEn"><?php echo strtoupper(get_the_author_meta('first_name_en') . ' ' . get_the_author_meta('last_name_en')); ?></p>
<?php if(get_the_author_meta('job')) { ?>
    <p class="AuthorPageProfile__job"><?php the_author_meta('job') ?></p>
<?php } ?>
  </div>
  <p class="AuthorPageProfile__text"><?php the_author_meta('user_description') ?></p>
  <ul class="AuthorPageProfile__links">
<?php if(get_the_author_meta('user_url')) { ?>
    <li class="AuthorPageProfile__link AuthorPageProfile__link--web">
      <a href="<?php the_author_meta('user_url') ?>" target="_blank">ウェブサイト</a>
    </li>
<?php }
if(get_the_author_meta('twitter')) { ?>
    <li class="AuthorPageProfile__link AuthorPageProfile__link--twitter">
      <a href="<?php the_author_meta('twitter') ?>" target="_blank">twitter</a>
    </li>
<?php }
if(get_the_author_meta('facebook')) { ?>
    <li class="AuthorPageProfile__link AuthorPageProfile__link--facebook">
      <a href="<?php the_author_meta('facebook') ?>" target="_blank">facebook</a>
    </li>
<?php }
if(get_the_author_meta('instagram')) { ?>
    <li class="AuthorPageProfile__link AuthorPageProfile__link--instagram">
      <a href="<?php the_author_meta('instagram') ?>" target="_blank">instagram</a>
    </li>
<?php } ?>
  </ul>
</section>

<section class="Module">
  <h2 class="Module__heading"><span class="Module__headingTextBlock"><?php echo get_the_author_meta('last_name') . get_the_author_meta('first_name'); ?>が</span><span class="Module__headingTextBlock">執筆した記事</span></h2>
<?php get_template_part('part/cellList'); ?>
</section>

<div class="SocialButtonContainer">
<?php get_template_part('part/share'); ?>
</div>
<?php wp_enqueue_script('article-index-js', $static_assets_path . 'scripts/article-index.bundle.js'); ?>
<?php
// test
/*
wp_enqueue_script('test-js ','../../../sentogurashi-template/scripts/common.bundle.js');
wp_enqueue_style('test-css', '../../../sentogurashi-template/styles/common.css');
wp_enqueue_style('test-css2', '../../../sentogurashi-template/styles/article.css');
*/
?>
<?php get_footer(); ?>