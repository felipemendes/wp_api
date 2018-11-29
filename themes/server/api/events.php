<?php

function api_get_events() {
    $posts = array();
    $args = array (
        'post_type' => 'events',
        'post_per_page' => -1
    );

    $loop = new WP_Query($args);
    
    while ($loop->have_posts()) : $loop->the_post();
        $id = get_the_ID();
        $slug = get_post_field('post_name', $id);
        $title = get_the_title();
        $image = get_the_post_thumbnail_url( $post_id, 'full' );
        $address = get_post_meta( get_the_ID(), 'address', TRUE );
        $city = get_post_meta( get_the_ID(), 'city', TRUE );
        $date = get_post_meta( get_the_ID(), 'date', TRUE );

        $post = array (
            'id' => $id,
            'title' => $title,
            'image' => $image,
            'address' => $address,
            'city' => $city,
            'date' => $date
        );

        $posts[$slug] = $post;
    endwhile;

    return rest_ensure_response( $posts );
}

function api_register_events_routes() {
    register_rest_route('purai', '/events', array(
        'methods' => 'GET',
        'callback' => 'api_get_events',
    ));
}
add_action('rest_api_init', 'api_register_events_routes');
