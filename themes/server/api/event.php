<?php

function api_get_event($request) {
    $slug = sanitize_text_field($request->get_param('slug'));
    $page_object = get_page_by_path($slug, OBJECT, 'events');
    $id = $page_object->ID;
    $title = $page_object->ID;
    $image = get_the_post_thumbnail_url( $page_object->ID, 'full' );
    $address = get_post_meta( $page_object->ID, 'address', TRUE );
    $city = get_post_meta( $page_object->ID, 'city', TRUE );
    $date = get_post_meta( $page_object->ID, 'date', TRUE );

    $post = array (
        'id' => $id,
        'slug' => $slug,
        'title' => $title,
        'image' => $image,
        'address' => $address,
        'city' => $city,
        'date' => $date
    );

    return rest_ensure_response( $post );
}

function api_register_event_routes() {
    register_rest_route('purai', '/event/(?P<slug>[-\w]+)', array(
        'methods' => 'GET',
        'callback' => 'api_get_event',
    ));
}
add_action('rest_api_init', 'api_register_event_routes');
