<?php get_header(); ?>
<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg'); ?>)"></div>
  <div class="page-banner__content container t-center c-white">
    <h1 class="headline headline--large">
      All Events
    </h1>
    <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
    <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
    <a href="#" class="btn btn--large btn--blue">Find Your Major</a>
  </div>
</div>
<div class="container container--narrow page-section">
  <?php 
    while(have_posts()){ 
      the_post();
    ?>
    <div class="event-summary">
      <a class="event-summary__date t-center" href="#">
        <span class="event-summary__month">Mar</span>
        <span class="event-summary__day">25</span>
      </a>
      <div class="event-summary__content">
        <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h5>
        <p>
          <?php 
              if(get_the_content()){
                echo wp_trim_words( get_the_content(), 10, '...' );
              }else{
                echo get_the_excerpt();
              }
            ?> 
          <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a>
        </p>
      </div>
    </div>  
  <?php 
    }

  ?>
  <!-- <p>Looking for a recap of past events? <a href="<?php echo site_url('past-events/'); ?>">Checkout you past events archive</a></p> -->
</div>
<?php get_footer(); ?>