<?php get_header();
while (have_posts())
{
    the_post();
?>

<div class="page-banner">
  <!-- <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg'); ?>)"></div> -->
  <?php 
    $backgroundImage = get_field('page_banner_background_image');
    //print_r($backgroundImage['sizes']['PageBanner']);
  ?>
  <div class="page-banner__bg-image" style="background-image: url(<?php echo $backgroundImage['sizes']['PageBanner']; ?>)"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title(); ?></h1>
      <div class="page-banner__intro">
        <p><?php the_field('page_banner_sub_title'); ?></p>
        </div>
      </div>
    </div>

    <div class="container container--narrow page-section">
    
      <div class="generic-content">
        <div class="row group">
          <div class="one-third">
            <?php the_post_thumbnail('professorProtrait'); ?>
          </div>
          <div class="one-thirds">
          <?php the_content(); ?>
          </div>
        </div>
        
      </div>
      <?php 
        $relatedPrograms = get_field('related_programs');
        if($relatedPrograms){
      ?>
        <hr class="section-break"/>
        <h2 class="headline headline--medium">Subject Taught(s)</h2>
        <ul class="link-list min-list">
          <?php 
        
            foreach($relatedPrograms as $program){
              echo '<li><a href="'.get_permalink($program).'">'.get_the_title($program).'</a></li>';
            }
          ?>
        </ul>
      </div>
    <?php
      }
}
get_footer(); ?>