<?php

function add_meta_info() {
	add_meta_box(
		'meta_info',
		'Info',
		'meta_info_view',
		'events',
		'normal',
		'high'
	);
}
add_action('add_meta_boxes', 'add_meta_info');

function meta_info_view( $post ) {
	$meta_data = get_post_meta( $post->ID ); 
	$featured = ( isset( $meta_data['featured'][0] ) && '1' === $meta_data['featured'][0] ) ? 1 : 0; ?>

	<style>
		.meta-box {	
			justify-content: space-between;
		}
		.meta-box-item {
			flex-basis: 30%;
		}
		.meta-box-item label {
			font-weight: 700;
			display: block;
			margin: .5rem 0;
		}
		.input-addon-wrapper {
			height: 30px;
			display: flex;
			align-items: center;
		}
		.input-addon {
			display: block;
			border: 1px solid #CCC;
			border-bottom-left-radius: 5px;
			border-top-left-radius: 5px;
			height: 100%;
			width: 30px;
			text-align: center;
			line-height: 30px;
			box-sizing: border-box;
			background-color: #888;
			color: #FFF;
		}
		.meta-box-input {
			height: 100%;
			width: 100%;
			border: 1px solid #CCC;
			border-left: none;
			margin: 0;
		}
		textarea {
			width: 100%;
		}
	</style>
	
	<div class="meta-box">
		<div class="meta-box-item">
			<label>
				<input type="checkbox" name="featured" value="1" <?php checked( $featured, 1 ); ?> /> Featured
			</label>
		</div>

		<div class="meta-box-item">
			<label>Price</label>
			<input class="meta-box-input" type="text" name="price" value="<?= $meta_data['price'][0]; ?>">
		</div>

		<div class="meta-box-item">
			<label>Date</label>
			<input class="meta-box-input" type="text" name="date" value="<?= $meta_data['date'][0]; ?>">
		</div>

		<div class="meta-box-item">
			<label>Contact</label>
			<input class="meta-box-input" type="text" name="contact" value="<?= $meta_data['contact'][0]; ?>">
		</div>

		<div class="meta-box-item">
			<label>Address</label>
			<input class="meta-box-input" type="text" name="address" value="<?= $meta_data['address'][0]; ?>">
		</div>

		<div class="meta-box-item">
			<label>City</label>
			<input class="meta-box-input" type="text" name="city" value="<?= $meta_data['city'][0]; ?>">
		</div>
	</div>
<?php
}

function save_meta_box( $post_id ) {
	$featured = ( isset( $_POST['featured'] ) && '1' === $_POST['featured'] ) ? 1 : 0; // Input var okay.
		update_post_meta( $post_id, 'featured', esc_attr( $featured ) );

	if ( isset($_POST['price']) ) {
		update_post_meta( $post_id, 'price', sanitize_text_field( $_POST['price'] ) );
	}
	if ( isset($_POST['date']) ) {
		update_post_meta( $post_id, 'date', sanitize_text_field( $_POST['date'] ) );
	}
	if ( isset($_POST['contact']) ) {
		update_post_meta( $post_id, 'contact', sanitize_text_field( $_POST['contact'] ) );
	}
	if ( isset($_POST['address']) ) {
		update_post_meta( $post_id, 'address', sanitize_text_field( $_POST['address'] ) );
	}
	if ( isset($_POST['city']) ) {
		update_post_meta( $post_id, 'city', sanitize_text_field( $_POST['city'] ) );
	}
}
add_action('save_post', 'save_meta_box');
