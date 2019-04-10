<?php

function api_get_event( $request ) {
    $slug = sanitize_text_field( $request->get_param('slug') );
    $page_object = get_page_by_path( $slug, OBJECT, 'events' );

    $id = $page_object->ID;
    $status = $page_object->post_status;
    $featured = get_post_meta( $id, 'featured', TRUE );
    $trending = get_post_meta( $id, 'trending', TRUE );
    $title = $page_object->post_title;
    $image = get_the_post_thumbnail_url( $page_object->ID, 'full' );
    $about = get_the_content_html();
    $price = get_post_meta( $id, 'price', TRUE );
    $date = get_post_meta( $page_object->ID, 'date', TRUE );
    $contact = get_post_meta( $id, 'contact', TRUE );
    $address = get_post_meta( $page_object->ID, 'address', TRUE );
    $where = get_post_meta( get_the_ID(), 'where', TRUE );
    $city = get_post_meta( $page_object->ID, 'city', TRUE );
    $category = get_the_terms( $id, 'category' )[0];
    $where_to_buy = get_the_terms( $id, 'where_to_buy' )[0];
    
    $taxonomy_city = array(
        'slug'  => $city->slug,
        'title' => $city->name,
    );

    $taxonomy_category = array(
        'slug'  => $category->slug,
        'title' => $category->name,
    );

    $taxonomy_where_to_buy = array(
        'slug'  => $where_to_buy->slug,
        'title' => $where_to_buy->name,
        'url'   => $where_to_buy->description
    );
    
    $post = array (
        'id'            => $id,
        'status'        => $status,
        'featured'      => $featured,
        'trending'      => $trending,
        'title'         => $title,
        'image'         => $image,
        'about'         => $about,
        'price'         => $price,
        'date_raw'      => $created_at,
        'date'          => $date,
        'contact'       => $contact,
        'address'       => $address,
        'where'         => $where,
        'city'          => $taxonomy_city,
        'category'      => $taxonomy_category,
        'where_to_buy'  => $taxonomy_where_to_buy,
    );

    return rest_ensure_response( $post );
}

function api_register_event_routes() {
    register_rest_route('v1', '/event/(?P<slug>[-\w]+)', array(
        'methods' => 'GET',
        'callback' => 'api_get_event',
    ));
}
add_action( 'rest_api_init', 'api_register_event_routes' );