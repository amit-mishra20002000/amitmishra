<?php
function fictional_university_script(){
    wp_enqueue_style('google-font','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('bootstrapcdn','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('fictional-style-index',get_theme_file_uri('build/style-index.css'));
    wp_enqueue_style('fictional-index',get_theme_file_uri('build/index.css'));

    wp_enqueue_script('fictional-js',get_theme_file_uri('build/index.js'),array('jquery'),'1.0',true);
}
add_action('wp_enqueue_scripts','fictional_university_script');

function theme_slug_setup() {
    add_theme_support( 'title-tag' );
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