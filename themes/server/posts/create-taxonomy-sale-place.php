<?php

function create_taxonomy_sale_place() {
    $singular = 'Sale Place';
    $plural = 'Sale Places';
    
	$labels = array (
		'name' => $plural,
		'singular_name' => $singular,
		'view_item' => 'View ' . $singular,
		'edit_item' => 'Edit ' . $singular,
		'new_item' => 'New ' . $singular,
		'add_new_item' => 'Add New ' . $singular
    );
        
	$args = array (
		'labels' => $labels,
		'public' => true,
		'hierarchical' => true
    );
	register_taxonomy('sale_place', 'event', $args);
}
add_action( 'init' , 'create_taxonomy_sale_place' );
