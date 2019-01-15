<?php

function add_meta_about() {
	add_meta_box(
		'meta_about',
		'About',
		'meta_about_view',
		'events',
		'normal',
		'high'
	);
}
add_action('add_meta_boxes', 'add_meta_about');

function meta_about_view( $post ) {
	$meta_data = get_post_meta( $post->ID ); ?>
	
	<div class="meta-box">
		<div class="meta-box-item">
			<textarea name="about" cols="30" rows="10"><?= $meta_data['about'][0]; ?></textarea>
		</div>
	</div>
<?php
}

function save_meta_box_about( $post_id ) {
	if( isset($_POST['about']) ) {
		update_post_meta( $post_id, 'about', sanitize_text_field( $_POST['about'] ) );
	}
}
add_action('save_post', 'save_meta_box_about');
