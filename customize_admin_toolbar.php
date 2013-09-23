<?php

/**  --- --- --- --- --- --- --- --- --- --- --- ---
 *  Display all current toolbar nodes with their respective handles (for targetting)
 **  --- --- --- --- --- --- --- --- --- --- ---  */
 
add_action( 'wp_before_admin_bar_render', 'add_all_node_ids_to_toolbar' );

function add_all_node_ids_to_toolbar() {

	global $wp_admin_bar;
	$all_toolbar_nodes = $wp_admin_bar->get_nodes();

	if ( $all_toolbar_nodes ) {

		// add a top-level Toolbar item called "Node Id's" to the Toolbar
		$args = array(
			'id'    => 'node_ids',
			'title' => 'Node ID\'s'
		);
		$wp_admin_bar->add_node( $args );

		// add all current parent node id's to the top-level node.
		foreach ( $all_toolbar_nodes as $node  ) {
			if ( isset($node->parent) && $node->parent ) {

				$args = array(
					'id'     => 'node_id_'.$node->id, // prefix id with "node_id_" to make it a unique id
					'title'  => $node->id,
					'parent' => 'node_ids'
					// 'href' => $node->href,
				);
				// add parent node to node "node_ids"
				$wp_admin_bar->add_node($args);
			}
		}

		// add all current Toolbar items to their parent node or to the top-level node
		foreach ( $all_toolbar_nodes as $node ) {

			$args = array(
				'id'      => 'node_id_'.$node->id, // prefix id with "node_id_" to make it a unique id
				'title'   => $node->id,
				// 'href' => $node->href,
			);

			if ( isset($node->parent) && $node->parent ) {
				$args['parent'] = 'node_id_'.$node->parent;
			} else {
				$args['parent'] = 'node_ids';
			}

			$wp_admin_bar->add_node($args);
		}
	}
}

/**  --- --- --- --- --- --- --- --- --- --- --- ---
 *  Remove existing nodes and add new ones
 **  --- --- --- --- --- --- --- --- --- --- ---  */

/**  --- --- --- --- --- --- --- --- --- --- --- ---
 *  Customize Toolbar for navigation
 **  --- --- --- --- --- --- --- --- --- --- ---  */

add_action( 'admin_bar_menu', 'edit_nodes', 999 );

function edit_nodes( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
	$wp_admin_bar->remove_node( 'site-name' );
	$wp_admin_bar->remove_node( 'updates' );
	$wp_admin_bar->remove_node( 'comments' );
	$wp_admin_bar->remove_node( 'new-media' );
	$wp_admin_bar->remove_node( 'new-page' );
	
	$wp_admin_bar->add_node( array( 'id' => 'home', 'title' => 'Home', 'href'  => home_url() ) );
	
	$wp_admin_bar->add_node( array( 'id' => 'bookshelves', 'title' => 'Bookshelves' ) );
	$categories = get_categories(); 
    foreach ($categories as $cat) {		
		$wp_admin_bar->add_node( array( 'id' => $cat->slug, 'title' => $cat->name, 'href'  => home_url() .'/category/'. $cat->slug, 'parent' => 'bookshelves' ) );
    }
}
?>