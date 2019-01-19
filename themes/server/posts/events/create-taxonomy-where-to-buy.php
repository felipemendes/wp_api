<?php

function create_taxonomy_where_to_buy() {
    $singular = 'Where to Buy';
    $plural = 'Where to Buy';
    
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
	register_taxonomy( 'where_to_buy', 'events', $args );
}
add_action( 'init' , 'create_taxonomy_where_to_buy' );
