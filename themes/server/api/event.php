<?php

function api_get_event($request) {
    $slug = sanitize_text_field($request->get_param('slug'));
    $page_object = get_page_by_path($slug, OBJECT, 'events');

    $id = $page_object->ID;
    $guid = $page_object->guid;
    $status = $page_object->post_status;
    $featured = get_post_meta( $id, 'featured', true );
    $created_at = $page_object->post_date;
    $updated_at = $page_object->post_modified;
    $title = $page_object->post_title;
    $image = get_the_post_thumbnail_url( $page_object->ID, 'full' );
    $about = get_post_meta( $id, 'about', TRUE );
    $price = get_post_meta( $id, 'price', TRUE );;
    $date = get_post_meta( $page_object->ID, 'date', TRUE );
    $contact = get_post_meta( $id, 'contact', TRUE );
    $address = get_post_meta( $page_object->ID, 'address', TRUE );
    $city = get_post_meta( $page_object->ID, 'city', TRUE );
    $category = get_the_terms( $id, 'category' )[0];
    $where_to_buy = get_the_terms( $id, 'where_to_buy' )[0];

    $taxonomy_category = array (
        'title' => $category->name,
    );

    $taxonomy_where_to_buy = array (
        'title' => $where_to_buy->name,
    );
    
    $post = array (
        'id' => $id,
        'guid' => $guid,
        'slug' => $slug,
        'status' => $status,
        'featured' => $featured,
        'created_at' => $created_at,
        'updated_at' => $updated_at,
        'title' => $title,
        'image' => $image,
        'about' => $about,
        'price' => $price,
        'date' => $date,
        'contact' => $contact,
        'address' => $address,
        'city' => $city,
        'category' => $taxonomy_category,
        'where_to_buy' => $taxonomy_where_to_buy,
    );

    return rest_ensure_response( $post );
}

function api_register_event_routes() {
    register_rest_route('purai/v1', '/event/(?P<slug>[-\w]+)', array(
        'methods' => 'GET',
        'callback' => 'api_get_event',
    ));
}
add_action('rest_api_init', 'api_register_event_routes');
