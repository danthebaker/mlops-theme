<?php
function mlops_register_event() {

	/**
	 * Post Type: Events.
	 */

	$labels = array(
		"name" => __( "Events", "mlops" ),
		"singular_name" => __( "Event", "mlops" ),
	);

	$args = array(
		"label" => __( "Events", "mlops" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_menu" => true,
		"show_in_nav_menus" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"query_var" => true,
		"supports" => array( "title", "revisions", "thumbnail", "excerpt" ),
		"taxonomies" => array("event_category")
	);

	register_post_type( "event", $args );
}

add_action( 'init', 'mlops_register_event' );
?>