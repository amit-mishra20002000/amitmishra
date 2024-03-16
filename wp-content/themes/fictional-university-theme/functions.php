<?php

function pageBanner($args = NULL){
    if(!isset($args['title'])){
        $args['title'] = get_the_title();
    }
    if(!isset($args['sub_title'])){
        $args['sub_title'] = get_field('page_banner_sub_title');
    }
    if(!isset($args['photo'])){
        if(get_field('page_banner_background_image')){
            $args['photo'] = get_field('page_banner_background_image')['sizes']['PageBanner'];
        }else{
            $args['photo'] = get_theme_file_uri('images/ocean.jpg');
        }
    }
?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo'] ?>)"></div>
            <div class="page-banner__content container container--narrow">
                <h1 class="page-banner__title"><?php echo  $args['title'] ?></h1>
                <div class="page-banner__intro">
                    <p><?php echo $args['sub_title']; ?></p>
                </div>
            </div>
        </div>
    </div>
<?php
}

function fictional_university_script(){
    wp_enqueue_style('google-font','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('bootstrapcdn','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('fictional-style-index',get_theme_file_uri('build/style-index.css'));
    wp_enqueue_style('fictional-index',get_theme_file_uri('build/index.css'));

    wp_enqueue_script('fictional-js',get_theme_file_uri('build/index.js'),array('jquery'),'1.0',true);
   
    wp_localize_script('fictional-js', 'universityData', array(
        'root_url' => get_site_url()
      ));
    
    
}
add_action('wp_enqueue_scripts','fictional_university_script');

function theme_slug_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_image_size('professorLandscspe','400','260',true);
    add_image_size('professorProtrait','480','650',true);
    add_image_size('PageBanner','1500','350',true);
}
add_action( 'after_setup_theme', 'theme_slug_setup' );

function university_adjust_queries($query){
    if ( ! is_admin() && is_post_type_archive( 'event' ) && $query->is_main_query() ) {
         $query->set( 'meta_key', 'event_date' );
         $query->set( 'orderby', 'meta_value_num' );
         $query->set( 'order', 'ASC');
         $query->set( 'meta_query', array(
             array(
                 'key'     => 'event_date',
                 'compare' => '>=',
                 'value'   => date('Ymd'),
                 'type'    => 'numeric',
             )
         ) );
    }
    if ( ! is_admin() && is_post_type_archive( 'program' ) && $query->is_main_query() ) {
        $query->set( 'orderby', 'title' );
        $query->set( 'order', 'ASC');
       $query->set( 'posts_per_page', -1 );
    }
 }
 add_action( 'pre_get_posts', 'university_adjust_queries' );
?>