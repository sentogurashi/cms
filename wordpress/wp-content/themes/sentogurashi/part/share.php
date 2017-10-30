<?php
global $post;

$shareUrl = is_single() ?  get_the_permalink() : get_bloginfo('url');
$shareTitle = is_single() ? get_the_title() : get_bloginfo('title');
?>
<ul class="SocialButton">
  <li class="SocialButton__item SocialButton__item--twitter js-SocialButton__item--twitter"><a href="https://twitter.com/share?url=<?php echo rawurlencode($shareUrl); ?>&text=<?php echo rawurlencode($shareTitle); ?>"><span>ツイート</span></a></li>
  <li class="SocialButton__item SocialButton__item--facebook js-SocialButton__item--facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode($shareUrl); ?>"><span>シェア</span></a></li>
  <li class="SocialButton__item SocialButton__item--line js-SocialButton__item--line"><a href="http://line.me/R/msg/text/?<?php echo rawurlencode("${shareTitle}　${shareUrl}"); ?>"><span>送る</span></a></li>
</ul>