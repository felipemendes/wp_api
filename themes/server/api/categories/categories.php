<?php

function api_get_categories() {
    $result = array();
    $categories = get_terms(
        array(
            'taxonomy' => 'category',
            'hide_empty' => false,
        )
    );

    foreach( $categories as $category ) {
        $item = array(
            'slug' => $category->slug,
            'title' => $category->name,
            'about' => $category->description,
            'count' => $category->count
        );
        $result[] = $item;
    }

    return rest_ensure_response( $result );
}

function api_register_categories_routes() {
    register_rest_route( 'purai/v1', '/categories', array(
        'methods' => 'GET',
        'callback' => 'api_get_categories',
    ) );
}
add_action( 'rest_api_init', 'api_register_categories_routes' );
