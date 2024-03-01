<?php
function fictional_university_script(){
    wp_enqueue_style('google-font','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('bootstrapcdn','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('fictional-style-index',get_theme_file_uri('build/style-index.css'));
    wp_enqueue_style('fictional-index',get_theme_file_uri('build/index.css'));

    wp_enqueue_script('fictional-js',get_theme_file_uri('build/index.js'),'jQuery','1.0',true);
}
add_action('wp_enqueue_scripts','fictional_university_script');
?>