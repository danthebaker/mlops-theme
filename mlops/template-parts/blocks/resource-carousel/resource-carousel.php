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
$id = 'resource-carousel-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'resource-carousel';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$resources = get_field('resource');

?>
<section id="<?php echo esc_attr($id); ?>" class="block-container <?php echo esc_attr($className); ?>" style="<?php echo esc_attr($styles); ?>"> 
    <?php
    if($resources){
        ?>
        <div class="resource-carousel-slider">
            <?php
            foreach($resources as $k => $resource){

                echo '<div class="item">';

                    if($resource['link']){
                        printf('<a href="%s" target="_blank">', $resource['link']);
                    }
                    else {
                        if($resource['youtube_video_id']){
                            printf('<button class="open-video-popup resource" data-video="%s">', $resource['youtube_video_id']);
                        }
                    }

                        
                        $img = "";
                        if($resource['image']){
                            $img = $resource['image']['sizes']['medium'];
                        }
                        else {
                            if($resource['youtube_video_id']){
                                $img = 'https://img.youtube.com/vi/'.$resource['youtube_video_id'].'/hqdefault.jpg';
                            }
                        }

                        if($img){
                            printf('<div class="embed-responsive embed-responsive-16by9"><img src="%s"></div>', $img);
                        }

                        if($resource['title']){
                            printf('<h3 class="title">%s</h3>', $resource['title']);
                        }

                        if($resource['category']){
                            printf('<p class="category">%s</p>', $resource['category']);
                        }

                        


                    if($resource['link']){
                        printf('</a>');
                    }
                    else {
                        if($resource['youtube_video_id']){
                            printf('</button>');
                        }
                    }
                echo '</div>';
                ?>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>


    <div class="resource-video-popup popup video-popup" id="resource-video-popup">
        <div class="content-wrapper clear">
            <div class="content">
                <button type="button" class="close">
                    <span class="sr-only">Close</span>
                </button>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="560" height="315" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>