<?php get_header(); ?>
  <div id="main" class="container">
    <div id="posts">

<?php
if(have_posts()):
  while(have_posts()):
    the_post();
?>
      <div clsss="post">
        <div class="post-header">
          <h2>
            <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
          </h2>
          <div class="post-meta">
            <?php echo get_the_date();?>【<?php the_category(', ') ?>】
          </div>
          <div class="post-content">
            <div class="post-image">
              <img src="./img/noimage.png" alt="" width="100" height="100">
            </div>
            <div class="post-body">
              <?php the_excerpt(); ?>
            </div>
          </div>
        </div>
      </div>
      <!-- /.post -->

<?php
  endwhile;
else:
?>
<p>記事はありません</P>
<?php
endif;
?>

      <div class="navigation">
        <div class="prev">prev</div>
        <div class="next">next</div>
      </div>
    </div>
    <!-- /#posts -->
<?php get_sidebar(); ?>
  </div>
  <!-- /#main.container -->
<?php get_footer(); ?>