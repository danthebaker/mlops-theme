<?php

/**
 * Resource Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'feature-store-faq-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'feature-store-faq';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$args = [
    'post_type' => 'page',
    'fields' => 'ids',
    'nopaging' => true,
    'meta_key' => '_wp_page_template',
    'meta_value' => 'template-feature-store.php'
];
$pages = get_posts( $args );
if(count($pages) > 0){
    $feature_store_page_id = $pages[0];
    $faq_header_content = get_field('feature_store_faq_header', $feature_store_page_id);
    $faq_items = get_field('feature_store_faq', $feature_store_page_id);

    $display = true;

    if(is_singular('provider')){
        if(get_field('add_to_provider_single', $feature_store_page_id) === false){
            $display = false;
        }
    }

    if($faq_items && $display === true){
        ?>
        <section id="<?php echo esc_attr($id); ?>" class="block-container wp-block-group <?php echo esc_attr($className); ?>" style="<?php echo esc_attr($styles); ?>"> 
            <div class="wp-block-group__inner-container">
                <div class="section-header"><?php echo $faq_header_content; ?></div>

                <ul class="accordion-ul">
                    <?php
                    foreach($faq_items as $faq_item){
                        printf('<li><h3>%s <button class="toggle"><span class="sr-only">toggle</span></button></h3><div>%s</div></li>', $faq_item['question'], $faq_item['answer']);
                    }
                    ?>
                </ul>
            </div>
            
        </section>
        <?php
    }
}

?>
