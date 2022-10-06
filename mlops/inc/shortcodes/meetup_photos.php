<?php

function shortcode_meetup_photos($params){
ob_start();

$photos = get_field('photos');
if($photos){ ?>
    <div class="photo-slider">
    <?php foreach($photos as $photo){ ?>

        <div class="photo">
            <?php echo wp_get_attachment_image($photo, 'meetup-img');?>
        </div>
    <?php } ?>
    </div>
<?php
}

$content = ob_get_contents();
ob_end_clean();
return $content;

}
add_shortcode( 'meetup_photos' , 'shortcode_meetup_photos' );
?>
