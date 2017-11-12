<section class="Profile">
  <div class="Profile__column Profile__column--left">
    <div class="Profile__photo" style="background-image: url('<?php echo get_wp_user_avatar_url(get_the_author_meta('ID')) ?>')"></div>
  </div>
  <div class="Profile__column Profile__column--right">
    <div class="Profile__role">執筆</div>
    <p class="Profile__nameJp"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author_meta('last_name') . ' ' . get_the_author_meta('first_name'); ?></a></p>
    <div class="Profile__nameSub">
      <p class="Profile__nameEn"><?php echo strtoupper(get_the_author_meta('first_name_en') . ' ' . get_the_author_meta('last_name_en')); ?></p>
<?php if(get_the_author_meta('job')) { ?>
      <p class="Profile__job"><?php the_author_meta('job') ?></p>
<?php } ?>
    </div>
    <p class="Profile__text"><?php the_author_meta('user_description') ?></p>
    <ul class="Profile__links">
<?php if(get_the_author_meta('user_url')) { ?>
      <li class="Profile__link Profile__link--web">
        <a href="<?php the_author_meta('user_url') ?>" target="_blank">ウェブサイト</a>
      </li>
<?php }
if(get_the_author_meta('twitter')) { ?>
      <li class="Profile__link Profile__link--twitter">
        <a href="<?php the_author_meta('twitter') ?>" target="_blank">twitter</a>
      </li>
<?php }
if(get_the_author_meta('facebook')) { ?>
      <li class="Profile__link Profile__link--facebook">
        <a href="<?php the_author_meta('facebook') ?>" target="_blank">facebook</a>
      </li>
<?php }
if(get_the_author_meta('instagram')) { ?>
      <li class="Profile__link Profile__link--instagram">
        <a href="<?php the_author_meta('instagram') ?>" target="_blank">instagram</a>
      </li>
<?php } ?>
    </ul>
  </div>
</section>