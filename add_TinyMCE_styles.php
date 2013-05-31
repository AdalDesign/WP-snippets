<?php

// Add TinyMCE Styles Option 

function my_mce_buttons_2( $buttons ) {
  array_unshift( $buttons, 'styleselect' );
  return $buttons;
}
add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );


function my_mce_before_init( $settings ) {
  $style_formats = array(
	  array(
		  'title' => 'Spoiler',
		  'block' => 'p',
		  'classes' => 'spoiler'
	  )
  );
  $settings['style_formats'] = json_encode( $style_formats );
  return $settings;
}
add_filter( 'tiny_mce_before_init', 'my_mce_before_init' );


?>