<?php

function create_post_events() {
	$singular = 'Event';
    $plural = 'Events';
    $description = 'List all events';
    
	$labels = array (
		'name' => $plural,
		'singular_name' => $singular,
		'view_item' => 'View ' . $singular,
		'edit_item' => 'Edit ' . $singular,
		'new_item' => 'New ' . $singular,
		'add_new_item' => 'Add New ' . $singular
    );
    
	$supports = array (
		'title',
		'thumbnail'
    );
    
	$args = array (
		'labels' => $labels,
		'description' => $description,
		'public' => true,
        'supports' => $supports,
        'show_ui' => true,
	);
	register_post_type( 'events', $args);	
}
add_action('init', 'create_post_events');

require_once TEMPLATEPATH . '/posts/create-taxonomy-category.php';
require_once TEMPLATEPATH . '/posts/create-taxonomy-sale-place.php';
require_once TEMPLATEPATH . '/posts/create-meta-box-info.php';
