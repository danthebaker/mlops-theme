<?php
function mlops_register__empty() {

	/**
	 * Post Type: _empty. Use this only to bypass having to include a post type to migrate with WP Migrate DB Pro
	 */

	$labels = array(
		"name" => __( "_empty", "mlops" ),
		"singular_name" => __( "_empty", "mlops" ),
	);

	$args = array(
		"label" => __( "_empty", "mlops" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => false,
		"show_in_nav_menus" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => false,
		"query_var" => true
	);

	register_post_type( "_empty", $args );
}

add_action( 'init', 'mlops_register__empty' );
?>