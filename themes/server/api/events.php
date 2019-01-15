<?php

function api_get_events() {
    $posts = array();
    $args = array(
        'post_type' => 'events',
        'orderby' => 'date',
        'status' => 'publish',
        'limit' => -1,
        'posts_per_page' => -1,
    );

    $loop = new WP_Query($args);
    
    while ($loop->have_posts()) : $loop->the_post();
    
        $id = get_the_ID();
        $guid = get_the_guid();
        $slug = get_post_field('post_name', $id);
        $status = get_post_status();
        $featured = get_post_meta( get_the_ID(), 'featured', true );
        $created_at = get_the_date('Y-m-d H:i:s');
        $updated_at = get_the_modified_date('Y-m-d H:i:s');
        $title = get_the_title();
        $image = get_the_post_thumbnail_url( $post_id, 'full' );
        $about = get_post_meta( get_the_ID(), 'about', TRUE );
        $price = get_post_meta( get_the_ID(), 'price', TRUE );;
        $date = get_post_meta( get_the_ID(), 'date', TRUE );
        $contact = get_post_meta( get_the_ID(), 'contact', TRUE );
        $address = get_post_meta( get_the_ID(), 'address', TRUE );
        $city = get_post_meta( get_the_ID(), 'city', TRUE );
        $category = get_the_terms( $post->ID, 'category' )[0];
        $where_to_buy = get_the_terms( $post->ID, 'where_to_buy' )[0];
        
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

        $posts[] = $post;
    endwhile;

    return rest_ensure_response( $posts );
}

function api_register_events_routes() {
    register_rest_route('purai/v1', '/events', array(
        'methods' => 'GET',
        'callback' => 'api_get_events',
    ));
}
add_action('rest_api_init', 'api_register_events_routes');
