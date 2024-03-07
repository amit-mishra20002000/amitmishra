<?php
function university_post_type() {
	register_post_type('event',
		array(
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'events'),
            'labels' => array(
                'name' => 'Events',
                'add_new_item' => __( 'Add New Event' ),
                'add_new' => _x( 'Add New', 'book' ),
            ),
            'menu_icon' => 'dashicons-calendar-alt',
            'show_in_rest' => true,
            'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt'),
        ));
}
add_action('init', 'university_post_type');
