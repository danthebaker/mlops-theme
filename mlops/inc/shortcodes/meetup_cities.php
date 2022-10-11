<?php

function shortcode_meetup_cities($params){
ob_start();

$cities = get_field('cities');
if($cities){  ?>
    <div class="meetup-cities">
        <div>
            <h2>Cities</h2>
            <div class="cities-grid">
                <?php foreach($cities as $index => $city){ 

                        if($index >= 8){
                            break;
                        }
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
                <?php }//end while ?>
            </div> <!-- eo .cities-grid -->

            <?php if(count($cities) > 8){ ?>
                <div class="more">
                    <div class="cities-grid">
                        <?php
                        foreach ($cities as $index => $city) {
                            if ($index >= 8){
                                $image = $city['city_image'];
                                $name = $city['city_name'];
                                $url = $city['meetup_url'];
                                $type = $city['meetup_type'];  
                                ?>
                                <div class="city" data-index="<?php echo $index; ?>">
                                    <a href="<?php echo $url; ?>" target="_blank">
                                        <?php  
                                                echo wp_get_attachment_image($image, 'meetup-img');
                                                ?>
                                        <h3><?php echo $name; ?></h3>
                                        <p><?php echo $type; ?></p>
                                    </a>
                                </div>
                        <?php } 
                        }?>
                    </div> <!-- eo .cities-grid -->
                </div> <!-- eo .more -->

                <button type="button" class="view-toggle" id="view-cities-toggle"><span class="view-more">View more cities +</span><span class="view-less">View less cities -</span></button>

            <?php } ?>
        </div>
    </div>
<?php }

$content = ob_get_contents();
ob_end_clean();
return $content;

}
add_shortcode( 'meetup_cities' , 'shortcode_meetup_cities' );
?>