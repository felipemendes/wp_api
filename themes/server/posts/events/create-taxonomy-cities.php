<?php

function create_taxonomy_city() {
    $singular = 'City';
    $plural = 'Cities';
    
	$labels = array(
		'name' 			=> $plural,
		'singular_name' => $singular,
		'view_item' 	=> 'View ' . $singular,
		'edit_item' 	=> 'Edit ' . $singular,
		'new_item' 		=> 'New ' . $singular,
		'add_new_item' 	=> 'Add New ' . $singular
    );
        
	$args = array(
		'labels' 			=> $labels,
		'public' 			=> true,
		'hierarchical' 		=> true,
		'show_admin_column' => true
    );
	register_taxonomy( 'city', 'events', $args );
}
add_action( 'init' , 'create_taxonomy_city' );
