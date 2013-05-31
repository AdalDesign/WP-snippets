<?php

// add image_src meta link tag
function post_image_src() {
	$args = array( 'post_type' => 'attachment', 'numberposts' => 1, 'post_status' => null, 'post_parent' => $post->ID ); 
	$attachments = get_posts($args);
	$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'medium');
	if ( has_post_thumbnail() ) { $image_src = $thumbnail[0]; }
	elseif ($attachments) {
			foreach ( $attachments as $attachment ) {
				$attachmentURL = wp_get_attachment_image_src( $attachment->ID, $size='medium' );
				$image_src =  $attachmentURL[0];
			}
	} else { $image_src =  get_bloginfo('template_url') . '/images/topNavLogo.png'; }

	$image_src = '<link rel="image_src" href="' . $image_src . '" />';
	echo $image_src;
}
add_action('wp_head', 'post_image_src');

?>