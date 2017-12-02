<?php get_header(); ?>

<h1 class="Article__headingLv1">#<?php single_cat_title(); ?></h1>

<?php get_template_part('part/cellList'); ?>

<div class="SocialButtonContainer">
<?php get_template_part('part/share'); ?>
</div>
<?php get_footer(); ?>