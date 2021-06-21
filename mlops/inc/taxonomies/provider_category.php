<?php
function register_tax_provider_category() {

	$labels = array(
		"name" => __( 'Provider Categories', 'mlops' ),
		"singular_name" => __( 'Provider Category', 'mlops' ),
	);

	$args = array(
		"label" => __( 'Provider Categories', 'mlops' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => false,
		"label" => "Provider Categories",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => true,
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "provider_category", array( "provider" ), $args );
}

add_action( 'init', 'register_tax_provider_category' );
?>