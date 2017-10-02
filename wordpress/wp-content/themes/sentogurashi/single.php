<?php get_header() ?>
<?php
if(have_posts()):
  while(have_posts()):
    the_post();
?>

<article class="Article">
<?php if (has_post_thumbnail()) { ?>
  <div class="Article__photoWrapper">
    <div class="Article__photoMain js-Article__photoMain" style="background-image:url('<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'large')[0] ?>')"></div>
  </div>
<?php } ?>
  <div class="Article__inner">
    <div class="Article__titleWrapper">
      <h1 class="Article__headingLv1"><?php the_title() ?></h1>
      <div class="Article__titleInfo">
        <?php get_categories_label(true, 'Article__titleCategory') ?>
        <p class="Article__titleDate"><?php echo get_the_date() ?></p>
        <!-- <p class="Article__titleSeriesName"><a href="TOOD">連載:ほげほげ</a></p> -->
        <?php the_tags('<ul class="Article__titleTags"><li>', '</li><li>', '</li></ul>'); ?>
      </div>
    </div>
    <section class="Article__main">
<?php the_content() ?>
    </section>
    <section class="Profile">
      <div class="Profile__column Profile__column--left">
        <div class="Profile__photo" style="background-image: url('<?php echo get_wp_user_avatar_url(get_the_author_meta('ID')) ?>')"></div>
      </div>
      <div class="Profile__column Profile__column--right">
        <div class="Profile__role">執筆</div>
        <p class="Profile__nameJp"><?php echo get_the_author_meta('last_name') . ' ' . get_the_author_meta('first_name'); ?></p>
        <div class="Profile__nameSub">
          <p class="Profile__nameEn"><?php echo strtoupper(get_the_author_meta('last_name_en') . ' ' . get_the_author_meta('first_name_en')); ?></p>
          <p class="Profile__title">ライター</p>
        </div>
        <p class="Profile__text"><?php the_author_meta('user_description') ?></p>
        <ul class="Profile__links">
          <li class="Profile__link Profile__link--web">
            <a href="<?php the_author_meta('user_url') ?>" target="_blank">ウェブサイト</a>
          </li>
          <li class="Profile__link Profile__link--twitter">
            <a href="<?php the_author_meta('twitter') ?>" target="_blank">twitter</a>
          </li>
          <li class="Profile__link Profile__link--facebook">
            <a href="<?php the_author_meta('facebook') ?>" target="_blank">facebook</a>
          </li>
          <li class="Profile__link Profile__link--instagram">
            <a href="<?php the_author_meta('instagram') ?>" target="_blank">instagram</a>
          </li>
        </ul>
      </div>
    </section>
  </div>
</article>

<?php
  endwhile;
endif;
?>
<?php get_footer() ?>