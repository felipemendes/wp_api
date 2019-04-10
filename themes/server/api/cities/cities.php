<?php

function api_get_cities() {
    $result = array();
    $cities = get_terms( 'city', array(
        'hide_empty' => false
    ) );

    foreach( $cities as $city ) {
        $resultEvents = array();
        $args = array(
            'post_type'      => 'events',
            'orderby'        => 'date',
            'post_status'    => array('future', 'publish'),
            'tax_query' => array(
                array(
                    'taxonomy' => 'city',
                    'field' => 'id',
                    'terms' => $city,
                ),
            ),
        );
        
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();
        
            $id = get_the_ID();
            $status = get_post_status();
            $featured = get_post_meta( $id, 'featured', TRUE );
            $trending = get_post_meta( $id, 'trending', TRUE );
            $title = html_entity_decode(get_the_title());
            $image = get_the_post_thumbnail_url( $post_id, 'full' );
            $about = get_the_content_html();
            $price = get_post_meta( $id, 'price', TRUE );
            $date = get_post_meta( $id, 'date', TRUE );
            $contact = get_post_meta( $id, 'contact', TRUE );
            $address = get_post_meta( $id, 'address', TRUE );
            $where = get_post_meta( $id, 'where', TRUE );
            $city = get_the_terms( $post->ID, 'city' )[0];
            $category = get_the_terms( $post->ID, 'category' )[0];
            $where_to_buy = get_the_terms( $post->ID, 'where_to_buy' )[0];

            $taxonomy_city = array(
                'slug'  => $city->slug,
                'title' => $city->name,
            );
    
            $taxonomy_category = array(
                'slug'  => $category->slug,
                'title' => $category->name,
            );
    
            $taxonomy_where_to_buy = array(
                'title' => $where_to_buy->name,
                'url'   => $where_to_buy->description
            );
    
            $post = array(
                'id'            => $id,
                'status'        => $status,
                'featured'      => $featured,
                'trending'      => $trending,
                'title'         => $title,
                'image'         => $image,
                'about'         => $about,
                'price'         => $price,
                'date'          => $date,
                'contact'       => $contact,
                'address'       => $address,
                'where'         => $where,
                'city'          => $taxonomy_city,
                'category'      => $taxonomy_category,
                'where_to_buy'  => $taxonomy_where_to_buy,
            );

            $resultEvents[] = $post;
        endwhile;

        $item = array(
            'slug' => $city->slug,
            'title' => $city->name,
            'events' => $resultEvents
        );
        $result[] = $item;
    }

    return rest_ensure_response( $result );
}

function api_register_cities_routes() {
    register_rest_route( 'v1', '/cities', array(
        'methods' => 'GET',
        'callback' => 'api_get_cities',
    ) );
}
add_action( 'rest_api_init', 'api_register_cities_routes' );