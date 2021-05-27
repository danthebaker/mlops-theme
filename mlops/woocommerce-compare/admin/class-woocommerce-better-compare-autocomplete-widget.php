<?php

class WooCommerce_Better_Compare_Autocomplete_Widget extends WP_Widget
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
			'classname' => 'woocommerce_better_compare_autocomplete',
			'description' => __('This will show a input autocomplete field, where users can enter SKU or Product name to add to compare.', 'wooocommerce-better-compare'),
		);

        parent::__construct('woocommerce_better_compare_autocomplete', __('WooCommerce Better Compare Autocomplete', 'wooocommerce-better-compare'), $options);
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

        $html = "";

        $html .= $args['before_widget'];

        if ( ! empty( $title ) ) {
            $html .= $args['before_title'] . apply_filters( 'widget_title', $title ). $args['after_title'];
        }

        $html .= do_shortcode('[woocommerce_better_compare_autocomplete]');

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