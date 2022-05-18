<?php
function mlops_register_team() {

	/**
	 * Post Type: Team.
	 */

	$labels = array(
		"name" => __( "Team", "mlops" ),
		"singular_name" => __( "Team", "mlops" ),
	);

	$args = array(
		"label" => __( "Team", "mlops" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "team", "with_front" => true ),
		"query_var" => false,
		"supports" => array( "title", "revisions", "editor", "thumbnail" ),
	);

	register_post_type( "team", $args );
}

add_action( 'init', 'mlops_register_team' );
?>