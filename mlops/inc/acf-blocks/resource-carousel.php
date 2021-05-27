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
     'supports'          => array(
          'align' => true,
          'mode' => false,
          'jsx' => true,
          'anchor' => true,
      ),

));
