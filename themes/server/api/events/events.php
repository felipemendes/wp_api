<?php

function api_get_events( $data ) {

    $category_param = $data->get_param( 'category' );
    $city_param = $data->get_param( 'city' );
    $today_param = $data->get_param( 'today' );
    $featured_param = $data->get_param( 'featured' );
    $trending_param = $data->get_param( 'trending' );
    $slug_param = $data->get_param( 'slug' );
    $per_page_param = $data->get_param( 'per-page' );

    if(!empty($city_param) || isset($city_param) ) {
		$taxArrayCategory = array(
            array(
                'taxonomy' => 'city',
                'field'    => 'slug',
                'terms'    => $city_param,
            ),
        );
    };

    if(!empty($category_param) || isset($category_param) ) {
		$taxArrayCategory = array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $category_param,
            ),
        );
    };

    if(!empty($today_param) || isset($today_param) ) {
        $today = getdate();
		$dateQuery = array(
            array(
              'year'  => $today['year'],
              'month' => $today['mon'],
              'day'   => $today['mday'],
            ),
        );
    };

    if( (!empty($featured_param) || isset($featured_param)) || (!empty($trending_param) || isset($trending_param)) ) {
        $meta_query = array(
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key'     => 'featured',
                    'value'   => $featured_param
                ),
                array(
                    'key'     => 'trending',
                    'value'   => $trending_param
                )
            ),
        );
    }
    
    $result = array();
    $args = array(
        'post_type'         => 'events',
        'orderby'           => 'date',
        'post_status'       => array('publish', 'future'),
        'limit'             => -1,
        'tax_query'         => $city_param,
        'tax_query'         => $taxArrayCategory,
        'date_query'        => $dateQuery,
        'name'              => $slug_param,
        'posts_per_page'    => $per_page_param,
        'meta_query'        => $meta_query
    );
    
    $loop = new WP_Query( $args );
    
    while ( $loop->have_posts() ) : $loop->the_post();
    
        $id = get_the_ID();
        $guid = get_the_guid();
        $slug = get_post_field( 'post_name', $id );
        $status = get_post_status();
        $featured = get_post_meta( get_the_ID(), 'featured', TRUE );
        $thumbnail = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'thumbnail-image', NULL, 'medium');
        $trending = get_post_meta( get_the_ID(), 'trending', TRUE );
        $created_at = get_the_date( 'Y-m-d H:i:s' );
        $title = get_the_title();
        $image = get_the_post_thumbnail_url( $post_id, 'full' );
        $about = get_post_meta( get_the_ID(), 'about', TRUE );
        $price = get_post_meta( get_the_ID(), 'price', TRUE );
        $date = get_post_meta( get_the_ID(), 'date', TRUE );
        $contact = get_post_meta( get_the_ID(), 'contact', TRUE );
        $address = get_post_meta( get_the_ID(), 'address', TRUE );
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
            'slug'  => $where_to_buy->slug,
            'title' => $where_to_buy->name,
        );

        $post = array(
            'id'            => $id,
            'guid'          => $guid,
            'slug'          => $slug,
            'status'        => $status,
            'featured'      => $featured,
            'trending'      => $trending,
            'title'         => $title,
            'image'         => $image,
            'thumbnail'     => $thumbnail,
            'about'         => $about,
            'price'         => $price,
            'date_raw'      => $created_at,
            'date'          => $date,
            'contact'       => $contact,
            'address'       => $address,
            'city'          => $taxonomy_city,
            'category'      => $taxonomy_category,
            'where_to_buy'  => $taxonomy_where_to_buy,
        );

        $result[] = $post;
    endwhile;

    return rest_ensure_response( $result );
}

function api_register_events_routes() {
    register_rest_route('purai/v1', '/events', array(
        'methods'   => 'GET',
        'callback'  => 'api_get_events',
    ));
}
add_action('rest_api_init', 'api_register_events_routes');
