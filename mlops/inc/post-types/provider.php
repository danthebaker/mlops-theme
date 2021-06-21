<?php
function mlops_register_provider() {

	/**
	 * Post Type: Providers.
	 */

	$labels = array(
		"name" => __( "Providers", "mlops" ),
		"singular_name" => __( "Provider", "mlops" ),
	);

	$args = array(
		"label" => __( "Providers", "mlops" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "learn", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "revisions", "thumbnail" ),
		"taxonomies" => array("provider_category")
	);

	register_post_type( "provider", $args );
}

add_action( 'init', 'mlops_register_provider' );
?>