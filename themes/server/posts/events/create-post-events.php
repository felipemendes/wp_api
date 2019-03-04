<?php

function create_post_events() {
	$singular = 'Event';
    $plural = 'Events';
    $description = 'List all events';
    
	$labels = array(
		'name' 			=> $plural,
		'singular_name' => $singular,
		'view_item' 	=> 'View ' . $singular,
		'edit_item' 	=> 'Edit ' . $singular,
		'new_item' 		=> 'New ' . $singular,
		'add_new_item' 	=> 'Add New ' . $singular
    );
    
	$supports = array(
        'title',
        'editor',
		'thumbnail'
    );
    
	$args = array(
		'labels' => $labels,
		'about' => $description,
		'public' => true,
        'supports' => $supports,
		'show_ui' => true,
		'show_in_graphql' => true,
		'graphql_single_name' => 'event',
		'graphql_plural_name' => 'events',
	);
    register_post_type( 'events', $args );	
    
    if (class_exists('MultiPostThumbnails')) {
		new MultiPostThumbnails(array(
            'label'     => 'Thumbnail Image',
            'id'        => 'thumbnail-image',
            'post_type' => 'events'
		));
	}
}
add_action( 'init', 'create_post_events' );

require_once TEMPLATEPATH . '/lib/multi-post-thumbnails/multi-post-thumbnails.php';
require_once TEMPLATEPATH . '/posts/events/create-taxonomy-cities.php';
require_once TEMPLATEPATH . '/posts/events/create-taxonomy-categories.php';
require_once TEMPLATEPATH . '/posts/events/create-taxonomy-where-to-buy.php';
require_once TEMPLATEPATH . '/posts/events/create-meta-box-info.php';
