<?php
function university_post_type() {
	register_post_type('event',
		array(
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'events'),
            'labels' => array(
                'name' => 'Events',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Event',
                'add_new' => 'Add New Event',
            ),
            'menu_icon' => 'dashicons-calendar-alt',
            'show_in_rest' => true,
            'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt'),
        )
    );
    register_post_type( 'program',
        array(
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'programs'),
            'labels' => array(
                'name' => 'Programs',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Program',
                'edit_item' => 'Edit Program',
                'all_items' => 'All Program',
                'singular_name' => 'Program'
                
            ),
            'menu_icon' => 'dashicons-groups',
            'show_in_rest' => true,
            'supports' => array('title','editor','thumbnail','excerpt'),
        )
    );
    register_post_type( 'professor',
        array(
            'public' => true,
            'labels' => array(
                'name' => 'Professors',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Professor',
                'edit_item' => 'Edit Professor',
                'all_items' => 'All Professor',
                'singular_name' => 'Professor'
                
            ),
            'menu_icon' => 'dashicons-groups',
            'show_in_rest' => true,
            'supports' => array('title','editor','thumbnail','excerpt'),
        )
    );
}
add_action('init', 'university_post_type');
