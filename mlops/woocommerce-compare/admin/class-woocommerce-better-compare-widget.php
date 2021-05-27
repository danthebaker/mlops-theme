<?php

class WooCommerce_Better_Compare_Widget extends WP_Widget
{
	/**
	 * Register WooCommerce Better Compare Widget
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    http://woocommerce.db-dzine.de
	 */
    public function __construct()
    {
        $options = array( 
			'classname' => 'woocommerce_better_compare',
			'description' => __('This will show a list of products, that are set to be compared with.', 'wooocommerce-better-compare'),
		);

        parent::__construct('woocommerce_better_compare', __('WooCommerce Better Compare', 'wooocommerce-better-compare'), $options);
    }

    /**
     * Widget output
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    http://woocommerce.db-dzine.de
     * @param   [type]                         $args     [description]
     * @param   [type]                         $instance [description]
     * @return  [type]                                   [description]
     */
    public function widget($args, $instance)
    {
        global $woocommerce_better_compare_options;

        $title = $instance['title'];
        $maxProducts = $woocommerce_better_compare_options['maxProducts'];
        $maxProductsMobile = $woocommerce_better_compare_options['maxProductsMobile'];
        if($maxProductsMobile > $maxProducts) {
            $maxProducts = $maxProductsMobile;
        }

        $compareBarPage = $woocommerce_better_compare_options['compareBarPage'];
        if(!empty($compareBarPage)) {
            $compareBarPage = get_permalink($compareBarPage);
        } else {
            $compareBarPage = '#';
        }

        $compare_now = __('Compare Now', 'woocommerce-better-compare');
        $clear_all = __('Clear All', 'woocommerce-better-compare');
        $compare_products = __('Compare Products', 'woocommerce-better-compare');

        $html = "";

        $html .= $args['before_widget'];

        if ( ! empty( $title ) ) {
            $html .= $args['before_title'] . apply_filters( 'widget_title', $title ). $args['after_title'];
        }

        $html .= '<div id="woocommerce-compare-sidebar" class="woocommerce-compare-sidebar">';

            $html .= '<div id="woocommerce-compare-sidebar-items" class="woocommerce-compare-sidebar-items">';

                for ($i=0; $i < $maxProducts; $i++) { 
                    $html .= $this->get_single_item();
                }

                // Compare sidebar Actions
                $html .= '<div id="woocommerce-compare-sidebar-actions" class="woocommerce-compare-sidebar-actions">';
                    $html .= '<a href="#" id="woocommerce-compare-sidebar-action-clear" class="woocommerce-compare-sidebar-action-clear clear-all-compared-products">' . $clear_all . ' <i class="fa fa-times"></i></a>';
                    $html .= '<a href="' . $compareBarPage . '" id="woocommerce-compare-sidebar-action-compare" class="woocommerce-compare-table-action-compare">' . $compare_now . ' <i class="fa fa-chevron-right"></i></a>';
                $html .= '</div>';

            $html .= '</div>';

        $html .= '</div>';
		
		$html .= $args['after_widget'];
        echo $html;
    }

    protected function get_single_item()
    {
        $html = "";
        $html .= '<div class="woocommerce-compare-sidebar-item-container woocommerce-compare-sidebar-item-placeholder">';
            $html .= '<div class="woocommerce-compare-sidebar-item">';

            $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    /**
     * Save widget options
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    http://woocommerce.db-dzine.de
     * @param   [type]                         $new_instance [description]
     * @param   [type]                         $old_instance [description]
     * @return  [type]                                       [description]
     */
    public function update($new_instance, $old_instance)
    {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
    }

    /**
     * Output admin widget options form
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    http://woocommerce.db-dzine.de
     * @param   [type]                         $instance [description]
     * @return  [type]                                   [description]
     */
    public function form($instance)
    {
        // Title
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Compare Products', 'wooocommerce-better-compare' );
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <?php 
    }
}