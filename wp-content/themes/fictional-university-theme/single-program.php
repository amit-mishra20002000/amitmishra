<?php get_header();
while (have_posts())
{
    the_post();
    pageBanner();
?>

<!-- <div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg'); ?>)"></div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title"><?php the_title(); ?></h1>
    <div class="page-banner__intro">
      <p>Learn how the school of your dreams got started.</p>
    </div>
  </div>
</div> -->

    <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
          <p>
            <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>">
              <i class="fa fa-home" aria-hidden="true"></i> Back to Program
            </a> 
            <span class="metabox__main"><?php echo get_the_title(); ?></span>
          </p>
        </div>
      <div class="generic-content"><?php the_content(); ?></div>
      <hr class="section-break"/>
      <h2>Professor of <?php echo get_the_title(); ?></h2>
      <ul class="professors-cards">
      <?php

        $professor_args = array(
          'post_type' => 'professor',
          'post_status' => 'publish',
          'posts_per_page' => -1,
          'orderby' => 'title',
          'order' => 'ASC',
          'meta_query' => array(
            
            array(
              'key' => 'related_programs',
              'compare' => 'LIKE',
              'value' => '"'.get_the_ID().'"'
            )
          ),
        );
        $professor_query = new WP_Query( $professor_args );
        if($professor_query->have_posts()){
          while ( $professor_query->have_posts() ) : $professor_query->the_post();
         
      ?>
        <li class="professor-card__list-item">
          <a class="professor-card" href="<?php the_permalink(); ?>">
            <img class="professor-card__image" src=<?php the_post_thumbnail_url('professorLandscspe'); ?> />
            <span class="professor-card__name"><?php echo get_the_title(); ?></span>
          </a>
        </li>
            
      <?php
         endwhile;
        }
         wp_reset_postdata();
        ?>
        </ul>
       <hr class="section-break"/>
       
        <?php

         $event_args = array(
          'post_type' => 'event',
          'post_status' => 'publish',
          'posts_per_page' => -1,
          'meta_key' => 'event_date',
          'orderby' => 'meta_value_num',
          'order' => 'ASC',
          'meta_query' => array(
            array(
                'key' => 'event_date',
                'value'    => date('Ymd'),
                'compare'    => '>=',
                'type' => 'number'
            ),
            array(
              'key' => 'related_programs',
              'compare' => 'LIKE',
              'value' => '"'.get_the_ID().'"'
            )
           ),
        );
      ?>
      <h2>Upcoming <?php echo get_the_title(); ?> Events</h2>
      <?php

        $event_query = new WP_Query( $event_args );
        if($event_query->have_posts()){
          while ( $event_query->have_posts() ) : $event_query->the_post();

         
          get_template_part('template-parts/content','event');
     
         endwhile;
        }
         wp_reset_postdata();
      ?>
    </div>
    <?php
}
get_footer(); ?>