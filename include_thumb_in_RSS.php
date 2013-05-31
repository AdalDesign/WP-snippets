<?php

// THIS INCLUDES THE THUMBNAIL IN OUR RSS FEED
function insertThumbnailRSS($content) { global $post;
  if ( has_post_thumbnail( $post->ID ) ){ $content = '' . get_the_post_thumbnail( $post->ID, 'thumbnail' ) . '' . $content; }
  return $content; 
}
add_filter('the_excerpt_rss', 'insertThumbnailRSS');
add_filter('the_content_feed', 'insertThumbnailRSS');

?>