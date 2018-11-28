<?php

function add_meta_info() {
	add_meta_box(
		'meta_info',
		'Extra Info',
		'meta_info_view',
		'event',
		'normal',
		'high'
	);
}
add_action('add_meta_boxes', 'add_meta_info');

function meta_info_view( $post ) {
	$meta_data = get_post_meta( $post->ID ); ?>

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
	</style>

	<div class="meta-box">
		<div class="meta-box-item">
			<label for="address-input">Address</label>
			<input id="address-input" class="meta-box-input" type="text" name="address"
			value="<?= $meta_data['address'][0]; ?>">
		</div>

		<div class="meta-box-item">
			<label for="city-input">City</label>
			<input id="city-input" class="meta-box-input" type="text" name="city"
			value="<?= $meta_data['city'][0]; ?>">
		</div>

		<div class="meta-box-item">
			<label for="date-input">Date</label>
			<input id="date-input" class="meta-box-input" type="date" name="date"
			value="<?= $meta_data['date'][0]; ?>">
		</div>

	</div>
<?php
}

function save_meta_box( $post_id ) {
	if( isset($_POST['address']) ) {
		update_post_meta( $post_id, 'address', sanitize_text_field( $_POST['address'] ) );
	}
	
	if( isset($_POST['city']) ) {
		update_post_meta( $post_id, 'city', sanitize_text_field( $_POST['city'] ) );
	}
	
	if( isset($_POST['date']) ) {
		update_post_meta( $post_id, 'date', sanitize_text_field( $_POST['date'] ) );
	}
}
add_action('save_post', 'save_meta_box');