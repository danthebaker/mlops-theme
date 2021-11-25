<?php
acf_register_block_type(array(
	'name'              => 'feature-store-faq',
	'title'             => __('Feature Store FAQ'),
	'description'       => __('The FAQ content of the Feature Store page. FAQ items editable in Feature Store page.'),
	'render_template'   => 'template-parts/blocks/feature-store-faq/feature-store-faq.php',
	'category'          => 'formatting',
	'icon'              => 'admin-comments',
     'keywords'          => array( 'faq', 'feature store', 'feature store faq', 'feature', 'store' ),
     'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/feature-store-faq/feature-store-faq.css',
     'supports'          => array(
          'align' => true,
          'mode' => false,
          'jsx' => true,
          'anchor' => true,
      ),

));
