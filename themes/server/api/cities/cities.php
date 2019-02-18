<?php

function api_get_cities() {
    $result = array();
    $cities = get_terms( 'city', 'hide_empty=0' );

    foreach( $cities as $city ) {
        $item = array(
            'slug' => $city->slug,
            'title' => $city->name,
            'about' => $city->description,
            'count' => $city->count
        );
        $result[] = $item;
    }

    return rest_ensure_response( $result );
}

function api_register_cities_routes() {
    register_rest_route( 'purai/v1', '/cities', array(
        'methods' => 'GET',
        'callback' => 'api_get_cities',
    ) );
}
add_action( 'rest_api_init', 'api_register_cities_routes' );
