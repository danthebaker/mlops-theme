<?php

    if ( ! class_exists( 'weLaunch' ) && ! class_exists( 'Redux' ) ) {
        return;
    }

    if( class_exists( 'weLaunch' ) ) {
        $framework = new weLaunch();
    } else {
        $framework = new Redux();
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "woocommerce_better_compare_options";

    $args = array(
        'opt_name' => 'woocommerce_better_compare_options',
        'use_cdn' => TRUE,
        'dev_mode' => FALSE,
        'display_name' => 'WooCommerce Better Compare',
        'display_version' => '1.5.7',
        'page_title' => 'WooCommerce Compare Products',
        'update_notice' => TRUE,
        'intro_text' => '',
        'footer_text' => '&copy; '.date('Y').' weLaunch',
        'admin_bar' => false,
        'menu_type' => 'submenu',
        'menu_title' => 'Compare Products',
        'allow_sub_menu' => TRUE,
        'page_parent' => 'woocommerce',
        // 'page_parent_post_type' => 'stores',
        'customizer' => FALSE,
        'default_mark' => '*',
        'hints' => array(
            'icon_position' => 'right',
            'icon_color' => 'lightgray',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'database' => 'options',
        'transient_time' => '3600',
        'network_sites' => TRUE,
    );

    global $weLaunchLicenses;
    if( (isset($weLaunchLicenses['woocommerce-better-compare']) && !empty($weLaunchLicenses['woocommerce-better-compare'])) || (isset($weLaunchLicenses['woocommerce-plugin-bundle']) && !empty($weLaunchLicenses['woocommerce-plugin-bundle'])) ) {
        $args['display_name'] = '<span class="dashicons dashicons-yes-alt" style="color: #9CCC65 !important;"></span> ' . $args['display_name'];
    } else {
        $args['display_name'] = '<span class="dashicons dashicons-dismiss" style="color: #EF5350 !important;"></span> ' . $args['display_name'];
    }

    $framework::setArgs( $opt_name, $args );

    $atts = wc_get_attribute_taxonomies();

    $enabled = array(
            'im' => __('Image', 'woocommerce-better-compare'),
            'ti' => __('Title', 'woocommerce-better-compare'),
            're' => __('Reviews', 'woocommerce-better-compare'),
            'pr' => __('Price', 'woocommerce-better-compare'),
            'sk' => __('Sku', 'woocommerce-better-compare'),
            'ex' => __('Excerpt', 'woocommerce-better-compare'),
            'di' => __('Dimensions', 'woocommerce-better-compare'),
            'we' => __('Weight', 'woocommerce-better-compare'),
            'rm' => __('Read More', 'woocommerce-better-compare'),
    );

    $temp = array();
    if(!empty($atts)) {
        foreach ($atts as $value) {
            $temp['attr-' . $value->attribute_name] = $value->attribute_label;
        }
    }

    $enabled = array_merge($enabled, $temp);

    // Attribute Groups
    $args = array( 'posts_per_page' => -1, 'post_type' => 'attribute_group', 'post_status' => 'publish', 'orderby' => 'menu_order', 'suppress_filters' => 0);
    $attribute_groups = get_posts( $args );

    $temp = array();
    if(!empty($attribute_groups)) {
        foreach ($attribute_groups as $attribute_group) {
            $temp['group-' . $attribute_group->ID] = __('Group:', 'woocommerce-better-compare') . ' ' . $attribute_group->post_title;
        }
    }
    $enabled = array_merge($enabled, $temp);

    $dataToShow = array(
        'enabled' => $enabled,
        'disabled' => array(
            'ac' => __('Search Autocomplete', 'woocommerce-better-compare'),
            'de' => __('Description', 'woocommerce-better-compare'),
            'st' => __('Stock', 'woocommerce-better-compare'),
            'va' => __('Variations', 'woocommerce-better-compare'),
            'ta' => __('Tags', 'woocommerce-better-compare'),
            'ct' => __('Categories', 'woocommerce-better-compare'),
            'ca' => __('Add to Cart', 'woocommerce-better-compare'),
            'tx1' => __('Taxonomy 1', 'woocommerce-better-compare'),
            'tx2' => __('Taxonomy 2', 'woocommerce-better-compare'),
            'tx3' => __('Taxonomy 3', 'woocommerce-better-compare'),
            'tx4' => __('Taxonomy 4', 'woocommerce-better-compare'),
            'mt1' => __('Meta Field 1', 'woocommerce-better-compare'),
            'mt2' => __('Meta Field 2', 'woocommerce-better-compare'),
            'mt3' => __('Meta Field 3', 'woocommerce-better-compare'),
            'mt4' => __('Meta Field 4', 'woocommerce-better-compare'),
        )
    );

    /*
     *
     * ---> START SECTIONS
     *
     */

    $framework::setSection( $opt_name, array(
        'title'  => __('Compare Products', 'woocommerce-better-compare' ),
        'id'     => 'general',
        'desc'   => __('Need support? Please use the comment function on codecanyon.', 'woocommerce-better-compare' ),
        'icon'   => 'el el-home',
    ) );

    $framework::setSection( $opt_name, array(
        'title'      => __('General', 'woocommerce-better-compare' ),
        'desc'       => __( 'To get auto updates please <a href="' . admin_url('tools.php?page=welaunch-framework') . '">register your License here</a>.', 'woocommerce-better-compare' ),
        'id'         => 'general-settings',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'enable',
                'type'     => 'checkbox',
                'title'    => __('Enable', 'woocommerce-better-compare' ),
                'subtitle' => __('Enable Compare Products.', 'woocommerce-better-compare' ),
                'default'  => '1',
            ),
            array(
                'id'       => 'addToCompareText',
                'type'     => 'text',
                'title'    => __('Add to Compare Text', 'woocommerce-better-compare'),
                'subtitle' => __('The text for the add to compare button.'),
                'default'  => __('Add to Compare', 'woocommerce-better-compare'),
            ), 
            array(
                'id'       => 'removeFromCompareText',
                'type'     => 'text',
                'title'    => __('Remove from Compare Text', 'woocommerce-better-compare'),
                'subtitle' => __('The text for the remove from compare button'),
                'default'  => __('Remove from Compare', 'woocommerce-better-compare'),
            ), 
            array(
                'id'       => 'enableGroupedAttributes',
                'type'     => 'checkbox',
                'title'    => __('Enable Attribute Group Compatibility', 'woocommerce-better-compare' ),
                'subtitle' => __('You need our <a href="https://welaunch.io/plugins/woocommerce-group-attributes/" target="_blank">Group Attributes Plugin</a>.', 'woocommerce-better-compare' ),
                'default'  => '0',
            ),
                array(
                    'id'       => 'enableGroupedAttributesGetAttributeAutomatically',
                    'type'     => 'checkbox',
                    'title'    => __('Get Attributes automatically from a Group', 'woocommerce-better-compare' ),
                    'subtitle' => __('When you drag an attribute group into enabled, it automatically gets all attributes.', 'woocommerce-better-compare' ),
                    'default'  => '0',
                ),
                array(
                    'id'       => 'enableGroupedAttributesResetCounts',
                    'type'     => 'checkbox',
                    'title'    => __('Reset Counts after Group', 'woocommerce-better-compare' ),
                    'subtitle' => __('This will display odd rows for all attribute groups.', 'woocommerce-better-compare' ),
                    'default'  => '0',
                ),
            array(
                'id'       => 'enableCategoryRestriction',
                'type'     => 'checkbox',
                'title'    => __('Enable Category Restriction', 'woocommerce-better-compare' ),
                'subtitle' => __('Product can only be compared if they are in the same category.', 'woocommerce-better-compare' ),
                'default'  => '0',
            ),
                 array(
                    'id'       => 'enableCategoryRestrictionText',
                    'type'     => 'text',
                    'title'    => __('Category Restriction', 'woocommerce-better-compare'),
                    'subtitle' => __('Text that will appear if a product is not in one of the same categories of the other to compare products.'),
                    'default'  => 'The product you want to compare is not in the same category as your current to compare products. Do you want to remove existing products?',
                    'required' => array('enable', 'equals', '1'),
                ),
                array(
                    'id'       => 'enableCategoryRestrictionYoast',
                    'type'     => 'checkbox',
                    'title'    => __('Category Restriction Yoast Primary', 'woocommerce-better-compare' ),
                    'subtitle' => __('Product can only be compared when they have the same Yoast Primary category. When disabled it will be subcategory based.', 'woocommerce-better-compare' ),
                    'default'  => '0',
                ),
            
            // array(
            //     'id'       => 'enableDraggable',
            //     'type'     => 'checkbox',
            //     'title'    => __('Enable Draggable', 'woocommerce-better-compare' ),
            //     'subtitle' => __('Users can drag and drop products to the compare bar.', 'woocommerce-better-compare' ),
            //     'default'  => '0',
            // ),
            array(
                'id'       => 'maxProducts',
                'type'     => 'spinner', 
                'title'    => __('Max products to Compare (Desktop)', 'woocommerce-better-compare'),
                'default'  => '4',
                'min'      => '1',
                'step'     => '1',
                'max'      => '20',
            ),
            array(
                'id'       => 'maxProductsMobile',
                'type'     => 'spinner', 
                'title'    => __('Max products to Compare (Mobile)', 'woocommerce-better-compare'),
                'default'  => '3',
                'min'      => '1',
                'step'     => '1',
                'max'      => '20',
            ),
            array(
                'id'       => 'notAvailableText',
                'type'     => 'text',
                'title'    => __('Not Available Text', 'woocommerce-better-compare'),
                'subtitle' => __('The text for an attribute, if no value was found for a product.'),
                'default'  => '-',
            ), 
            array(
                'id'       => 'shopLoopCompareButtonPosition',
                'type'     => 'select',
                'title'    => __('Shop Loop Position', 'woocommerce-better-compare'),
                'subtitle' => __('Specify the positon of the compare button in shop loop.', 'woocommerce-better-compare'),
                'default'  => 'woocommerce_after_shop_loop_item',
                'options'  => array( 
                    'none' => __('None (Custom Integration)', 'woocommerce-better-compare'),
                    'woocommerce_before_shop_loop_item' => __('before_shop_loop_item', 'woocommerce-better-compare'),
                    'woocommerce_before_shop_loop_item_title' => __('before_shop_loop_item_title', 'woocommerce-better-compare'),
                    'woocommerce_shop_loop_item_title' => __('shop_loop_item_title', 'woocommerce-better-compare'),
                    'woocommerce_after_shop_loop_item_title' => __('after_shop_loop_item_title', 'woocommerce-better-compare'),
                    'woocommerce_after_shop_loop_item' => __('after_shop_loop_item', 'woocommerce-better-compare'),
                ),
                'required' => array('enable', 'equals', '1'),
            ),
            array(
                'id'       => 'shopLoopCompareButtonPriority',
                'type'     => 'spinner',
                'title'    => __( 'Hook Priority', 'woocommerce-better-compare' ),
                'min'      => '1',
                'step'     => '1',
                'max'      => '999',
                'default'  => '10',
                'required' => array('enable', 'equals', '1'),
            ),
        )
    ) );

    $framework::setSection( $opt_name, array(
        'title'      => __('Compare Bar & Table', 'woocommerce-better-compare' ),
        // 'desc'       => __('', 'woocommerce-better-compare' ),
        'id'         => 'compareBarSettings',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'compareBar',
                'type'     => 'checkbox',
                'title'    => __('Show Compare Bar', 'woocommerce-better-compare' ),
                'subtitle' => __('As an alternative you can hide the compare bar and just use the sidebar widget.', 'woocommerce-better-compare'),
                'default'  => '1',
            ),
            array(
                'id'       => 'compareBarOnlyProductCategory',
                'type'     => 'checkbox',
                'title'    => __('Show Compare Bar Only on product / category pages', 'woocommerce-better-compare' ),
                'subtitle' => __('Compare bar will only show on product / category pages..', 'woocommerce-better-compare'),
                'default'  => '1',
            ),
            array(
                'id'       => 'compareBarLayout',
                'type'     => 'select',
                'title'    => __('Compare Bar Layout', 'woocommerce-better-compare'), 
                'subtitle' => __('Layout of the compare bar', 'woocommerce-better-compare'),
                'options'  => array(
                    '1' => __('Layout 1', 'woocommerce-better-compare' ),
                    '2' => __('Layout 2', 'woocommerce-better-compare' ),
                ),
                'default'  => '1',
                'required' => array('compareBar', 'equals', '1'),
            ),
          array(
                'id'       => 'compareBarHidePlaceholder',
                'type'     => 'checkbox',
                'title'    => __('Hide Placeholder Images', 'woocommerce-better-compare' ),
                'subtitle' => __('Gives more Space in the compare bar.', 'woocommerce-better-compare'),
                'default'  => '0',
            ),
            array(
                'id'       => 'compareBarPosition',
                'type'     => 'select',
                'title'    => __('Compare Bar Position', 'woocommerce-better-compare'), 
                'subtitle' => __('Position of the compare bar', 'woocommerce-better-compare'),
                'options'  => array(
                    'bottom' => __('Bottom', 'woocommerce-better-compare' ),
                    'top' => __('Top', 'woocommerce-better-compare' ),
                    // 'left' => __('Left', 'woocommerce-better-compare' ),
                    // 'right' => __('Right', 'woocommerce-better-compare' ),
                ),
                'default'  => 'bottom',
                'required' => array('compareBar', 'equals', '1'),
            ),
            array(
                'id'       => 'compareBarImageSize',
                'type'     => 'text',
                'title'    => __('Image Size', 'woocommerce-better-compare'),
                'subtitle' => __('You can use e.g. full, large, woocommerce_thumbnail, woocommerce_single, shop_single, shop_catalog...', 'woocommerce-better-compare'),
                'default'  => 'woocommerce_thumbnail',
            ),
            array(
                'id'       => 'hideSimilarities',
                'type'     => 'checkbox',
                'title'    => __('Hide Similarities', 'woocommerce-better-compare' ),
                'subtitle' => __('Show a checkbox to Hide Similarities.', 'woocommerce-better-compare' ),
                'default'  => '1',
                'required' => array('compareBar', 'equals', '1'),
            ),
            array(
                'id'       => 'highlightDifferences',
                'type'     => 'checkbox',
                'title'    => __('Highlight Differences', 'woocommerce-better-compare' ),
                'subtitle' => __('Show a checkbox to Highlight Differences.', 'woocommerce-better-compare' ),
                'default'  => '0',
                'required' => array('compareBar', 'equals', '1'),
            ),
            array(
                'id'       => 'compareBarHeight',
                'type'     => 'spinner', 
                'title'    => __('Compare Bar Height', 'woocommerce-better-compare'),
                'default'  => '280',
                'min'      => '1',
                'step'     => '10',
                'max'      => '700',
                'required' => array('compareBar', 'equals', '1'),
            ),
            array(
                'id'       => 'compareBarItemWidth',
                'type'     => 'spinner', 
                'title'    => __('Compare Bar Item Width', 'woocommerce-better-compare'),
                'default'  => '150',
                'min'      => '1',
                'step'     => '10',
                'max'      => '800',
                'required' => array('compareBar', 'equals', '1'),
            ),
            array(
                'id'       => 'compareBarItemHeight',
                'type'     => 'spinner', 
                'title'    => __('Compare Bar Item Height', 'woocommerce-better-compare'),
                'default'  => '170',
                'min'      => '1',
                'step'     => '10',
                'max'      => '800',
                'required' => array('compareBar', 'equals', '1'),
            ),
            array(
                'id'       => 'compareBarPage',
                'type'     => 'select',
                'title'    => __('Set a custom Page', 'woocommerce-better-compare'),
                'subtitle' => __('If you do not want to use the fly out compare table, you can set a link to your compare page here. Make sure you place the [woocommerce_better_compare] shortcode on this page (without any parameters).', 'woocommerce-better-compare'),
                'data'     => 'pages',
                'ajax'     => true,
                'required' => array('compareBar', 'equals', '1'),
            ), 
        )
    ) );

    $framework::setSection( $opt_name, array(
        'title'      => __('Data to Compare', 'woocommerce-better-compare' ),
        'id'         => 'data',
        'subsection' => true,
        'fields'     =>  array(
            array(
                'id'      => 'dataToCompare',
                'type'    => 'sorter',
                'title'   => 'Data fields to compare (Live Compare)',
                'subtitle'    => 'Reorder, enable or disable data fields.',
                'options' => $dataToShow
            ),

            array(
                'id'      => 'displayProductPageDataToCompare',
                'type'    => 'sorter',
                'title'   => 'Data fields to compare (Single Product & Shortcode)',
                'subtitle'    => 'Reorder, enable or disable data fields.',
                'options' => $dataToShow
            ),

            array(
                'id'       => 'dataToCompareImageSize',
                'type'     => 'text',
                'title'    => __('Image Size (Compare Table)', 'woocommerce-better-compare'),
                'subtitle' => __('You can use e.g. full, large, woocommerce_thumbnail, woocommerce_single, shop_single, shop_catalog...', 'woocommerce-better-compare'),
                'default'  => 'full',
            ),
            array(
                'id'       => 'titleShowRemove',
                'type'     => 'checkbox',
                'title'    => __( 'Show a remove icon next to title (ONLY shortcode)', 'woocommerce-pdf-catalog' ),
                'subtitle' => __('Show a remove from compare icon next to product title.', 'woocommerce-better-compare'),
                'default'   => 0,
            ),
            array(
                'id'       => 'titleLinkToProduct',
                'type'     => 'checkbox',
                'title'    => __( 'Link Title to Product Page', 'woocommerce-pdf-catalog' ),
                'subtitle' => __('Each product title is linked to the product page.', 'woocommerce-better-compare'),
                'default'   => 0,
            ),
            array(
                'id'       => 'excerptStripShortcodes',
                'type'     => 'checkbox',
                'title'    => __( 'Strip Shortcodes of Excerpt (Short Description)', 'woocommerce-pdf-catalog' ),
                'subtitle' => __('If not enabled they will be executed.', 'woocommerce-better-compare'),
                'default'   => 0,
            ),
            array(
                'id'       => 'descriptionStripShortcodes',
                'type'     => 'checkbox',
                'title'    => __( 'Strip Shortcodes of Description', 'woocommerce-pdf-catalog' ),
                'subtitle' => __('If not enabled they will be executed.', 'woocommerce-better-compare'),
                'default'   => 0,
            ),
            array(
               'id' => 'section-data-taxonomies',
               'type' => 'section',
               'title' => __('Custom Taxonomies', 'woocommerce-better-compare'),
               'subtitle' => __('If you have dragged taxonomies into the enabled data above you need to set its data here.', 'woocommerce-better-compare'),
               'indent' => false 
            ),
            array(
                'id'       => 'dataToCompareTaxonomyName1',
                'type'     => 'text',
                'title'    => __('Custom Taxonomy 1 Name', 'woocommerce-better-compare'),
                'subtitle' => __('The Name that will be used for Taxonomy 1. For example "Product Categories".', 'woocommerce-better-compare'),
                'default'  => '',
            ),
            array(
                'id'       => 'dataToCompareTaxonomy1',
                'type'     => 'text',
                'title'    => __('Custom Taxonomy 1', 'woocommerce-better-compare'),
                'subtitle' => __('You need to specify the custom taxonmy field name here. For example "product_cat".', 'woocommerce-better-compare'),
                'default'  => '',
            ),
            array(
                'id'       => 'dataToCompareTaxonomyNoLinks1',
                'type'     => 'checkbox',
                'title'    => __('Remove Links 1', 'woocommerce-better-compare' ),
                'default'  => '0',
            ),
            array(
                'id'       => 'dataToCompareTaxonomyName2',
                'type'     => 'text',
                'title'    => __('Custom Taxonomy 2 Name', 'woocommerce-better-compare'),
                'subtitle' => __('The Name that will be used for Taxonomy 1. For example "Product Categories".', 'woocommerce-better-compare'),
                'default'  => '',
            ),
            array(
                'id'       => 'dataToCompareTaxonomy2',
                'type'     => 'text',
                'title'    => __('Custom Taxonomy 2', 'woocommerce-better-compare'),
                'subtitle' => __('You need to specify the custom taxonmy field name here. For example "product_cat".', 'woocommerce-better-compare'),
                'default'  => '',
            ),
            array(
                'id'       => 'dataToCompareTaxonomyNoLinks2',
                'type'     => 'checkbox',
                'title'    => __('Remove Links 2', 'woocommerce-better-compare' ),
                'default'  => '0',
            ),
            array(
                'id'       => 'dataToCompareTaxonomyName3',
                'type'     => 'text',
                'title'    => __('Custom Taxonomy 3 Name', 'woocommerce-better-compare'),
                'subtitle' => __('The Name that will be used for Taxonomy 1. For example "Product Categories".', 'woocommerce-better-compare'),
                'default'  => '',
            ),
            array(
                'id'       => 'dataToCompareTaxonomy3',
                'type'     => 'text',
                'title'    => __('Custom Taxonomy 3', 'woocommerce-better-compare'),
                'subtitle' => __('You need to specify the custom taxonmy field name here. For example "product_cat".', 'woocommerce-better-compare'),
                'default'  => '',
            ),
            array(
                'id'       => 'dataToCompareTaxonomyNoLinks3',
                'type'     => 'checkbox',
                'title'    => __('Remove Links 3', 'woocommerce-better-compare' ),
                'default'  => '0',
            ),
            array(
                'id'       => 'dataToCompareTaxonomyName4',
                'type'     => 'text',
                'title'    => __('Custom Taxonomy 4 Name', 'woocommerce-better-compare'),
                'subtitle' => __('The Name that will be used for Taxonomy 1. For example "Product Categories".', 'woocommerce-better-compare'),
                'default'  => '',
            ),
            array(
                'id'       => 'dataToCompareTaxonomy4',
                'type'     => 'text',
                'title'    => __('Custom Taxonomy 4', 'woocommerce-better-compare'),
                'subtitle' => __('You need to specify the custom taxonmy field name here. For example "product_cat".', 'woocommerce-better-compare'),
                'default'  => '',
            ),
            array(
                'id'       => 'dataToCompareTaxonomyNoLinks4',
                'type'     => 'checkbox',
                'title'    => __('Remove Links 4', 'woocommerce-better-compare' ),
                'default'  => '0',
            ),
            array(
               'id' => 'section-data-post-meta',
               'type' => 'section',
               'title' => __('Custom Post Metas', 'woocommerce-better-compare'),
               'subtitle' => __('If you have dragged custom post metas into the enabled data above you need to set its data here.', 'woocommerce-better-compare'),
               'indent' => false 
            ),
            array(
                'id'       => 'dataToCompareMetaName1',
                'type'     => 'text',
                'title'    => __('Custom Meta 1 Name', 'woocommerce-better-compare'),
                'subtitle' => __('The Name that will be used for Meta 1. For example "SKU".', 'woocommerce-better-compare'),
                'default'  => '',
            ),
            array(
                'id'       => 'dataToCompareMeta1',
                'type'     => 'text',
                'title'    => __('Custom Meta 1', 'woocommerce-better-compare'),
                'subtitle' => __('You need to specify the custom meta field name here. For example "_sku".', 'woocommerce-better-compare'),
                'default'  => '',
            ),
            array(
                'id'       => 'dataToCompareMetaName2',
                'type'     => 'text',
                'title'    => __('Custom Meta 2 Name', 'woocommerce-better-compare'),
                'subtitle' => __('The Name that will be used for Meta 2. For example "SKU".', 'woocommerce-better-compare'),
                'default'  => '',
            ),
            array(
                'id'       => 'dataToCompareMeta2',
                'type'     => 'text',
                'title'    => __('Custom Meta 2', 'woocommerce-better-compare'),
                'subtitle' => __('You need to specify the custom meta field name here. For example "_sku".', 'woocommerce-better-compare'),
                'default'  => '',
            ),
            array(
                'id'       => 'dataToCompareMetaName3',
                'type'     => 'text',
                'title'    => __('Custom Meta 3 Name', 'woocommerce-better-compare'),
                'subtitle' => __('The Name that will be used for Meta 3. For example "SKU".', 'woocommerce-better-compare'),
                'default'  => '',
            ),
            array(
                'id'       => 'dataToCompareMeta3',
                'type'     => 'text',
                'title'    => __('Custom Meta 3', 'woocommerce-better-compare'),
                'subtitle' => __('You need to specify the custom meta field name here. For example "_sku".', 'woocommerce-better-compare'),
                'default'  => '',
            ),
            array(
                'id'       => 'dataToCompareMetaName4',
                'type'     => 'text',
                'title'    => __('Custom Meta 4 Name', 'woocommerce-better-compare'),
                'subtitle' => __('The Name that will be used for Meta 4. For example "SKU".', 'woocommerce-better-compare'),
                'default'  => '',
            ),
            array(
                'id'       => 'dataToCompareMeta4',
                'type'     => 'text',
                'title'    => __('Custom Meta 4', 'woocommerce-better-compare'),
                'subtitle' => __('You need to specify the custom meta field name here. For example "_sku".', 'woocommerce-better-compare'),
                'default'  => '',
            ),
        )
    ) );

    $framework::setSection( $opt_name, array(
        'title'      => __('Single Compare Table', 'woocommerce-better-compare' ),
        'desc'       => __('Settings for the [woocommerce_better_compare products="380,377"]. If no IDs were set it takes the users products based on cookie.', 'woocommerce-better-compare' ),
        'id'         => 'singleCompareTable',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'singleCompareTableShowAttrNameInColumn',
                'type'     => 'checkbox',
                'title'    => __('Show Attr Name in first Column', 'woocommerce-better-compare' ),
                'subtitle' => __('Instead of showing the attr name above the value it will be shown in first column.', 'woocommerce-better-compare' ),
                'default'  => '0',
            ),
            array(
                'id'       => 'singleCompareTableHideSimilarities',
                'type'     => 'checkbox',
                'title'    => __('Hide Similarities', 'woocommerce-better-compare' ),
                'subtitle' => __('Show a checkbox to Hide Similarities.', 'woocommerce-better-compare' ),
                'default'  => '1',
            ),
            array(
                'id'       => 'singleCompareTableHighlightDifferences',
                'type'     => 'checkbox',
                'title'    => __('Highlight Differences', 'woocommerce-better-compare' ),
                'subtitle' => __('Show a checkbox to Highlight Differences.', 'woocommerce-better-compare' ),
                'default'  => '1',
            ),
            array(
                'id'       => 'singleCompareTableSliderSlidesToShow',
                'type'     => 'spinner',
                'title'    => __( 'Slides to Show', 'woocommerce-better-compare' ),
                'min'      => '1',
                'step'     => '1',
                'max'      => '99',
                'default'  => '3',
            ),
            array(
                'id'       => 'singleCompareTableAlwaysShowAllColumns',
                'type'     => 'checkbox',
                'title'    => __('Always show all Slides', 'woocommerce-better-compare' ),
                'subtitle' => __('Show all slides even if they are empty.', 'woocommerce-better-compare' ),
                'default'  => '0',
            ),
            array(
                'id'       => 'singleCompareTableSliderSlidesToScroll',
                'type'     => 'spinner',
                'title'    => __( 'Slides to Scroll', 'woocommerce-better-compare' ),
                'min'      => '1',
                'step'     => '1',
                'max'      => '99',
                'default'  => '3',
            ),
            array(
                'id'       => 'singleCompareTableSliderDots',
                'type'     => 'checkbox',
                'title'    => __('Show Dots', 'woocommerce-better-compare' ),
                'default'  => '1',
            ),
            array(
                'id'       => 'singleCompareTableSliderArrows',
                'type'     => 'checkbox',
                'title'    => __('Show Arrows', 'woocommerce-better-compare' ),
                'default'  => '1',
            ),
            array(
                'id'       => 'singleCompareTableSliderInfinite',
                'type'     => 'checkbox',
                'title'    => __('Make it Infinite', 'woocommerce-better-compare' ),
                'default'  => '1',
            ),
        )
    ) );


    $framework::setSection( $opt_name, array(
        'title'      => __('Single Product', 'woocommerce-better-compare' ),
        'desc'       => __('Show compared products based on a products categories on the product page.', 'woocommerce-better-compare' ),
        'id'         => 'display',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'displayButtonOnProductPage',
                'type'     => 'checkbox',
                'title'    => __('Display Compare Button on Product Page', 'woocommerce-better-compare' ),
                'subtitle' => __('Show the add to compare button on product page', 'woocommerce-better-compare' ),
                'default'  => '1',
            ),
            array(
                'id'       => 'displayButtonOnProductPagePosition',
                'type'     => 'select',
                'title'    => __('Single Product Button Position', 'woocommerce-better-compare'),
                'subtitle' => __('Specify the positon of the Button.', 'woocommerce-better-compare'),
                'default'  => 'woocommerce_single_product_summary',
                'options'  => array( 
                    'woocommerce_before_single_product' => __('Before Single Product', 'woocommerce-better-compare'),
                    'woocommerce_before_single_product_summary' => __('Before Single Product Summary', 'woocommerce-better-compare'),
                    'woocommerce_single_product_summary' => __('In Single Product Summary', 'woocommerce-better-compare'),
                    'woocommerce_product_meta_start' => __('Before Meta Information', 'woocommerce-better-compare'),
                    'woocommerce_product_meta_end' => __('After Meta Information', 'woocommerce-better-compare'),
                    'woocommerce_after_single_product_summary' => __('After Single Product Summary', 'woocommerce-better-compare'),
                    'woocommerce_after_single_product' => __('After Single Product', 'woocommerce-better-compare'),
                    'woocommerce_after_main_content' => __('After Main Product', 'woocommerce-better-compare'),
                    'woodmart_after_product_tabs' => 'woodmart_after_product_tabs',
                ),
                'required' => array('displayButtonOnProductPage', 'equals', '1'),
            ),
            array(
                'id'       => 'displayButtonPage',
                'type'     => 'select',
                'title'    => __('Set a custom Page', 'woocommerce-better-compare'),
                'subtitle' => __('If you do not want to use the compare bar / fly out table, you can set a link to your compare page here. Make sure you place the [woocommerce_better_compare] shortcode on this page (without any parameters).', 'woocommerce-better-compare'),
                'data'     => 'pages',
                'ajax'     => true,
                'required' => array('compareBar', 'equals', '1'),
            ), 
            array(
                'id'       => 'displayButtonOnProductPagePriority',
                'type'     => 'spinner',
                'title'    => __( 'Hook Priority', 'woocommerce-better-compare' ),
                'min'      => '1',
                'step'     => '1',
                'max'      => '999',
                'default'  => '30',
                'required' => array('displayButtonOnProductPage', 'equals', '1'),
            ),
            array(
                'id'       => 'displayProductPage',
                'type'     => 'checkbox',
                'title'    => __('Display Compare Table on Product Page', 'woocommerce-better-compare' ),
                'subtitle' => __('Show bought together products on product page', 'woocommerce-better-compare' ),
                'default'  => '1',
            ),
            array(
                'id'       => 'displayProductPageTitle',
                'type'     => 'text',
                'title'    => __('Title', 'woocommerce-better-compare'),
                'subtitle' => __('e.g. Also bought together'),
                'default'  => 'Compare with similar products',
                'required' => array('displayProductPage', 'equals', '1'),
            ), 
            array(
                'id'       => 'displayProductPageText',
                'type'     => 'text',
                'title'    => __('Description', 'woocommerce-better-compare'),
                'subtitle' => __('e.g. this items could be interested.'),
                'default'  => 'compare this product with similar products from this category',
                'required' => array('displayProductPage', 'equals', '1'),
            ),
            array(
                'id'       => 'displayProductPagePosition',
                'type'     => 'select',
                'title'    => __('Position', 'woocommerce-better-compare'),
                'subtitle' => __('Specify the positon of the compare table.', 'woocommerce-better-compare'),
                'default'  => 'woocommerce_after_single_product_summary',
                'options'  => array( 
                    'woocommerce_before_single_product' => __('Before Single Product', 'woocommerce-better-compare'),
                    'woocommerce_before_single_product_summary' => __('Before Single Product Summary', 'woocommerce-better-compare'),
                    'woocommerce_single_product_summary' => __('In Single Product Summary', 'woocommerce-better-compare'),
                    'woocommerce_product_meta_start' => __('Before Meta Information', 'woocommerce-better-compare'),
                    'woocommerce_product_meta_end' => __('After Meta Information', 'woocommerce-better-compare'),
                    'woocommerce_after_single_product_summary' => __('After Single Product Summary', 'woocommerce-better-compare'),
                    'woocommerce_after_single_product' => __('After Single Product', 'woocommerce-better-compare'),
                    'woocommerce_after_main_content' => __('After Main Product', 'woocommerce-better-compare'),
                    'flatsome_custom_single_product_1' => __('flatsome_custom_single_product_1', 'woocommerce-better-compare'),
                    'woodmart_after_product_tabs' => 'woodmart_after_product_tabs',
                ),
                'required' => array('displayProductPage', 'equals', '1'),
            ),
            array(
                'id'       => 'displayProductPagePriority',
                'type'     => 'spinner',
                'title'    => __( 'Hook Priority', 'woocommerce-better-compare' ),
                'min'      => '1',
                'step'     => '1',
                'max'      => '999',
                'default'  => '15',
                'required' => array('displayProductPage', 'equals', '1'),
            ),
            array(
                'id'       => 'displayProductPageShowAttrNameInColumn',
                'type'     => 'checkbox',
                'title'    => __('Show Attr Name in first Column', 'woocommerce-better-compare' ),
                'subtitle' => __('Instead of showing the attr name above the value it will be shown in first column.', 'woocommerce-better-compare' ),
                'default'  => '0',
                'required' => array('displayProductPage', 'equals', '1'),
            ),
            array(
                'id'       => 'displayProductPageMaxProducts',
                'type'     => 'spinner',
                'title'    => __( 'Max Products to show', 'woocommerce-better-compare' ),
                'min'      => '1',
                'step'     => '1',
                'max'      => '99',
                'default'  => '4',
                'required' => array('displayProductPage', 'equals', '1'),
            ),
            array(
                'id'       => 'displayProductPageSliderSlidesToShow',
                'type'     => 'spinner',
                'title'    => __( 'Slides to Show', 'woocommerce-better-compare' ),
                'min'      => '1',
                'step'     => '1',
                'max'      => '99',
                'default'  => '4',
                'required' => array('displayProductPage', 'equals', '1'),
            ),
            array(
                'id'       => 'displayProductPageSliderSlidesToScroll',
                'type'     => 'spinner',
                'title'    => __( 'Slides to Scroll', 'woocommerce-better-compare' ),
                'min'      => '1',
                'step'     => '1',
                'max'      => '99',
                'default'  => '4',
                'required' => array('displayProductPage', 'equals', '1'),
            ),
            array(
                'id'       => 'displayProductPageSliderDots',
                'type'     => 'checkbox',
                'title'    => __('Show Dots', 'woocommerce-better-compare' ),
                'default'  => '1',
                'required' => array('displayProductPage', 'equals', '1'),
            ),
            array(
                'id'       => 'displayProductPageSliderArrows',
                'type'     => 'checkbox',
                'title'    => __('Show Arrows', 'woocommerce-better-compare' ),
                'default'  => '1',
                'required' => array('displayProductPage', 'equals', '1'),
            ),
            array(
                'id'       => 'displayProductPageSliderInfinite',
                'type'     => 'checkbox',
                'title'    => __('Make it Infinite', 'woocommerce-better-compare' ),
                'default'  => '1',
                'required' => array('displayProductPage', 'equals', '1'),
            ),
        )
    ) );

   $framework::setSection( $opt_name, array(
        'title'      => __('Styling', 'woocommerce-better-compare' ),
        // 'desc'       => __('Custom stylesheet / javascript.', 'woocommerce-better-compare' ),
        'id'         => 'styling',
        'subsection' => true,
        'fields'     =>  array(
           array(
               'id' => 'section-compare-bar',
               'type' => 'section',
               'title' => __('Compare Bar Styles', 'woocommerce-better-compare'),
               'subtitle' => __('Styles for the compare bar.', 'woocommerce-better-compare'),
               'indent' => false,
               'required' => array('compareBar', 'equals', '1'),
            ),
            array(
                'id'        => 'compareBarTextColor',
                'type'      => 'color',
                'title'    => __('Compare Bar Text Color', 'woocommerce-better-compare'), 
                'subtitle' => __('Text Color of the compare bar', 'woocommerce-better-compare'),            
                'default'   => '#333',  
                'required' => array('compareBar', 'equals', '1'),          
            ),
            array(
                'id'        => 'compareBarBackgroundColor',
                'type'      => 'color_rgba',
                'title'    => __('Compare Bar Background Color', 'woocommerce-better-compare'), 
                'subtitle' => __('Background Color of the compare bar', 'woocommerce-better-compare'),            
                'default'   => array(
                    'color'     => '#FFFFFF',
                    'alpha'     => 0.98
                ),
                'options'       => array(
                    'show_input'                => true,
                    'show_initial'              => true,
                    'show_alpha'                => true,
                    'show_palette'              => true,
                    'show_palette_only'         => false,
                    'show_selection_palette'    => true,
                    'max_palette_size'          => 10,
                    'allow_empty'               => true,
                    'clickout_fires_change'     => false,
                    'choose_text'               => 'Choose',
                    'cancel_text'               => 'Cancel',
                    'show_buttons'              => true,
                    'use_extended_classes'      => true,
                    'palette'                   => null,  // show default
                    'input_text'                => 'Select Color'
                ),     
                'required' => array('compareBar', 'equals', '1'),                   
            ),
            array(
               'id' => 'section-compare-table',
               'type' => 'section',
               'title' => __('Compare Table Styles', 'woocommerce-better-compare'),
               'subtitle' => __('Styles for the flyout compare table.', 'woocommerce-better-compare'),
               'indent' => false,
               'required' => array('compareBar', 'equals', '1'),
            ),
            array(
                'id'        => 'compareTableTextColor',
                'type'      => 'color',
                'title'    => __('Compare Table Text Color', 'woocommerce-better-compare'), 
                'subtitle' => __('Text Color of the compare Table', 'woocommerce-better-compare'),            
                'default'   => '#333',  
                'required' => array('compareBar', 'equals', '1'),          
            ),
            array(
                'id'        => 'compareTableBackgroundColor',
                'type'      => 'color_rgba',
                'title'    => __('Compare Table Background Color', 'woocommerce-better-compare'), 
                'subtitle' => __('Background Color of the compare Table', 'woocommerce-better-compare'),            
                'default'   => array(
                    'color'     => '#ffffff',
                ),
                'options'       => array(
                    'show_input'                => true,
                    'show_initial'              => true,
                    'show_alpha'                => true,
                    'show_palette'              => true,
                    'show_palette_only'         => false,
                    'show_selection_palette'    => true,
                    'max_palette_size'          => 10,
                    'allow_empty'               => true,
                    'clickout_fires_change'     => false,
                    'choose_text'               => 'Choose',
                    'cancel_text'               => 'Cancel',
                    'show_buttons'              => true,
                    'use_extended_classes'      => true,
                    'palette'                   => null,  // show default
                    'input_text'                => 'Select Color'
                ),
                'required' => array('compareBar', 'equals', '1'),
            ),
            array(
                'id'        => 'compareTableOddBackgroundColor',
                'type'      => 'color_rgba',
                'title'    => __('Compare Table Odd Background Color', 'woocommerce-better-compare'),        
                'default'   => array(
                    'color'     => '#f3f3f3',
                ),
                'options'       => array(
                    'show_input'                => true,
                    'show_initial'              => true,
                    'show_alpha'                => true,
                    'show_palette'              => true,
                    'show_palette_only'         => false,
                    'show_selection_palette'    => true,
                    'max_palette_size'          => 10,
                    'allow_empty'               => true,
                    'clickout_fires_change'     => false,
                    'choose_text'               => 'Choose',
                    'cancel_text'               => 'Cancel',
                    'show_buttons'              => true,
                    'use_extended_classes'      => true,
                    'palette'                   => null,  // show default
                    'input_text'                => 'Select Color'
                ), 
                'required' => array('compareBar', 'equals', '1'),        
            ),
            array(
                'id'        => 'compareTableEvenBackgroundColor',
                'type'      => 'color_rgba',
                'title'    => __('Compare Table Even Background Color', 'woocommerce-better-compare'),        
                'default'   => array(
                    'color'     => '#ffffff',
                    'alpha'     => 0.9
                ),
                'options'       => array(
                    'show_input'                => true,
                    'show_initial'              => true,
                    'show_alpha'                => true,
                    'show_palette'              => true,
                    'show_palette_only'         => false,
                    'show_selection_palette'    => true,
                    'max_palette_size'          => 10,
                    'allow_empty'               => true,
                    'clickout_fires_change'     => false,
                    'choose_text'               => 'Choose',
                    'cancel_text'               => 'Cancel',
                    'show_buttons'              => true,
                    'use_extended_classes'      => true,
                    'palette'                   => null,  // show default
                    'input_text'                => 'Select Color'
                ),  
                'required' => array('compareBar', 'equals', '1'),
            ),
            array(
                'id'        => 'compareTableHighlightBackgroundColor',
                'type'      => 'color_rgba',
                'title'    => __('Compare Table Highlight Background Color', 'woocommerce-better-compare'),
                'default'   => array(
                    'color'     => '#d30000',
                    'alpha'     => 0.9
                ),
                'options'       => array(
                    'show_input'                => true,
                    'show_initial'              => true,
                    'show_alpha'                => true,
                    'show_palette'              => true,
                    'show_palette_only'         => false,
                    'show_selection_palette'    => true,
                    'max_palette_size'          => 10,
                    'allow_empty'               => true,
                    'clickout_fires_change'     => false,
                    'choose_text'               => 'Choose',
                    'cancel_text'               => 'Cancel',
                    'show_buttons'              => true,
                    'use_extended_classes'      => true,
                    'palette'                   => null,  // show default
                    'input_text'                => 'Select Color'
                ), 
                'required' => array('compareBar', 'equals', '1'),
            ),
           array(
               'id' => 'section-single-table',
               'type' => 'section',
               'title' => __('Shortcode Compare Table Styles', 'woocommerce-better-compare'),
               'subtitle' => __('Styles when you use the [woocommerce_better_compare products="X,X,X"] shortcode.', 'woocommerce-better-compare'),
               'indent' => false 
            ),
            array(
                'id'        => 'compareSingleTableTextColor',
                'type'      => 'color',
                'title'    => __('Compare Table Text Color', 'woocommerce-better-compare'), 
                'subtitle' => __('Text Color of the compare Table', 'woocommerce-better-compare'),            
                'default'   => '#000000',            
            ),
            array(
                'id'        => 'compareSingleTableOddBackgroundColor',
                'type'      => 'color_rgba',
                'title'    => __('Compare Table Odd Background Color', 'woocommerce-better-compare'),        
                'default'   => array(
                    'color'     => '#f7f7f7',
                    'alpha'     => 1
                ),
                'options'       => array(
                    'show_input'                => true,
                    'show_initial'              => true,
                    'show_alpha'                => true,
                    'show_palette'              => true,
                    'show_palette_only'         => false,
                    'show_selection_palette'    => true,
                    'max_palette_size'          => 10,
                    'allow_empty'               => true,
                    'clickout_fires_change'     => false,
                    'choose_text'               => 'Choose',
                    'cancel_text'               => 'Cancel',
                    'show_buttons'              => true,
                    'use_extended_classes'      => true,
                    'palette'                   => null,  // show default
                    'input_text'                => 'Select Color'
                ),         
            ),
            array(
                'id'        => 'compareSingleTableEvenBackgroundColor',
                'type'      => 'color_rgba',
                'title'    => __('Compare Table Even Background Color', 'woocommerce-better-compare'),        
                'default'   => array(
                    'color'     => '#FFFFFF',
                    'alpha'     => 1
                ),
                'options'       => array(
                    'show_input'                => true,
                    'show_initial'              => true,
                    'show_alpha'                => true,
                    'show_palette'              => true,
                    'show_palette_only'         => false,
                    'show_selection_palette'    => true,
                    'max_palette_size'          => 10,
                    'allow_empty'               => true,
                    'clickout_fires_change'     => false,
                    'choose_text'               => 'Choose',
                    'cancel_text'               => 'Cancel',
                    'show_buttons'              => true,
                    'use_extended_classes'      => true,
                    'palette'                   => null,  // show default
                    'input_text'                => 'Select Color'
                ),  
            ),
            array(
                'id'        => 'compareSingleTableHighlightBackgroundColor',
                'type'      => 'color_rgba',
                'title'    => __('Compare Table Highlight Background Color', 'woocommerce-better-compare'),
                'default'   => array(
                    'color'     => '#fff77b',
                    'alpha'     => 1.0
                ),
                'options'       => array(
                    'show_input'                => true,
                    'show_initial'              => true,
                    'show_alpha'                => true,
                    'show_palette'              => true,
                    'show_palette_only'         => false,
                    'show_selection_palette'    => true,
                    'max_palette_size'          => 10,
                    'allow_empty'               => true,
                    'clickout_fires_change'     => false,
                    'choose_text'               => 'Choose',
                    'cancel_text'               => 'Cancel',
                    'show_buttons'              => true,
                    'use_extended_classes'      => true,
                    'palette'                   => null,  // show default
                    'input_text'                => 'Select Color'
                ), 
            ),
        )
    ) );


    $framework::setSection( $opt_name, array(
        'title'      => __('Advanced settings', 'woocommerce-better-compare' ),
        'desc'       => __('Custom stylesheet / javascript.', 'woocommerce-better-compare' ),
        'id'         => 'advanced',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'disableReplaceState',
                'type'     => 'checkbox',
                'title'    => __( 'Disable Replace State', 'woocommerce-better-compare' ),
                'subtitle' => __( 'Check this to stop adding query parameters to URLs.', 'woocommerce-better-compare' ),
                'default'  => '0',
            ),
            array(
                'id'       => 'customCSS',
                'type'     => 'ace_editor',
                'mode'     => 'css',
                'title'    => __('Custom CSS', 'woocommerce-better-compare' ),
                'subtitle' => __('Add some stylesheet if you want.', 'woocommerce-better-compare' ),
            ),
            array(
                'id'       => 'customJS',
                'type'     => 'ace_editor',
                'mode'     => 'javascript',
                'title'    => __('Custom JS', 'woocommerce-better-compare' ),
                'subtitle' => __('Add some javascript if you want.', 'woocommerce-better-compare' ),
            ),           
        )
    ));


    /*
     * <--- END SECTIONS
     */
