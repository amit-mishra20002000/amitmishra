<?php get_header(); 
pageBanner(
  array('title' => 'We think you&rsquo;ll like it here.','sub_title' => 'Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?')
);
?>
<!-- <div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg'); ?>)"></div>
  <div class="page-banner__content container t-center c-white">
    <h1 class="headline headline--large">
      Past Events
    </h1>
    <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
    <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
    <a href="#" class="btn btn--large btn--blue">Find Your Major</a>
  </div>
</div> -->
<div class="container container--narrow page-section">
  <?php 
     $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
     $past_event_args = array(
        'paged' => $paged,
        'post_type' => 'event',
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
          array(
              'key' => 'event_date',
              'value'    => date('Ymd'),
              'compare'    => '<',
              'type' => 'number'
          ),
         ),
      );
      $past_event_query = new WP_Query( $past_event_args );
      while ( $past_event_query->have_posts() ) : $past_event_query->the_post();
        get_template_part('template-parts/content','event');
      endwhile;
    echo paginate_links(array('total'=>$past_event_query->max_num_pages));
?>
</div>
<?php get_footer(); ?>