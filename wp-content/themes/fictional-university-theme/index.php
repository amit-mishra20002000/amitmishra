<?php get_header(); 
pageBanner(
  array(
    'title' => 'We think you&rsquo;ll like it here.',
    'sub_title' => 'Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?'
  )
);
?>
<!-- <div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg'); ?>)"></div>
  <div class="page-banner__content container t-center c-white">
    <h1 class="headline headline--large">Blog</h1>
    <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
    <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
    <a href="#" class="btn btn--large btn--blue">Find Your Major</a>
  </div>
</div> -->
<div class="container container--narrow page-section">
  <?php 
    while(have_posts()){ 
      the_post();
    ?>
    <div class="post-item">
      <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      
      <div class="metabox">
        <p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('n.j.y'); ?> in <?php echo get_the_category_list(', '); ?></p>
      </div>

      <div class="generic-content">
        <?php the_excerpt(); ?>
        <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Continue reading &raquo;</a></p>
      </div>

    </div>
  <?php }
  echo paginate_links();
  ?>

</div>
<?php get_footer(); ?>