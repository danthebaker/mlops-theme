<?php
acf_register_block_type(array(
	'name'              => 'resource-carousel',
	'title'             => __('Resource Carousel'),
	'description'       => __('A custom resource carousel block.'),
	'render_template'   => 'template-parts/blocks/resource-carousel/resource-carousel.php',
	'category'          => 'formatting',
	'icon'              => 'admin-comments',
     'keywords'          => array( 'resource', 'carousel', 'resource carousel', 'carousel resource' ),
     'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/resource-carousel/resource-carousel.css',
     'enqueue_assets' => function(){
          wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '1.18', true );
          wp_enqueue_script( 'resource-carousel', get_template_directory_uri() . '/template-parts/blocks/resource-carousel/resource-carousel.js', array('jquery'), '1.0', true );
     },
     'supports'          => array(
          'align' => true,
          'mode' => false,
          'jsx' => true,
          'anchor' => true,
      ),

));
