<?php

function shortcode_meetup_cities($params){
ob_start();

$cities = get_field('cities');
if($cities){  ?>
    <div class="meetup-cities">
        <div>
        <h2>Cities</h2>
        <div class="cities-grid">
            <?php foreach($cities as $city){ 
                    $image = $city['city_image'];
                    $name = $city['city_name'];
                    $url = $city['meetup_url'];
                    $type = $city['meetup_type'];  
                    ?>
            <div class="city">
                <a href="<?php echo $url; ?>" target="_blank">
                    <?php  
                            echo wp_get_attachment_image($image, 'meetup-img');
                            ?>
                    <h3><?php echo $name; ?></h3>
                    <p><?php echo $type; ?></p>
                </a>
            </div>
        </div>
        <?php }//end while ?>
        </div>
    </div>
<?php }

$content = ob_get_contents();
ob_end_clean();
return $content;

}
add_shortcode( 'meetup_cities' , 'shortcode_meetup_cities' );
?>
