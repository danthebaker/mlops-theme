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

$faq_header_content = get_field('feature_store_faq_header');
$faq_items = get_field('feature_store_faq');

$faq_header_content_page = get_field('feature_store_faq_header', $post_id);
$faq_items_page = get_field('feature_store_faq', $post_id);

echo '<div style="display: none;">';
output($faq_header_content_page);
output($faq_items_page);
echo '</div>';

if($faq_items){
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

?>
