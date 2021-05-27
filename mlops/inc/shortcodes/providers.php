<?php
function shortcode_providers(){
ob_start();
?>
<div class="providers-list">
    <div class="sort">
        <span>Sort by <span></span></span>
        <select autocomplete="off">
            <option value="title-asc" selected="selected">name A-Z</option>
            <option value="title-desc">name Z-A</option>
        </select>
    </div>
    <ul class="ul-reset providers-list-ul">
        <?php
        $args = array(
            'post_type' => 'provider',
            'numberposts' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
        );
        $posts = get_posts($args);
        if($posts){
            foreach($posts as $p){
                $link = get_permalink($p->ID);
                $logo = get_the_post_thumbnail_url($p->ID, 'original');
                $video = get_field('video', $p->ID);

                ?>
                <li>
                    <div class="provider-overview-card" data-provider-id="<?php echo $p->ID; ?>">
                        <header>

                            <div class="logo-wrapper">
                                <?php

                                if($logo){

                                    $height_attr = "";
                                    if($height = get_field('logo_height', $p->ID)){
                                        $height_attr = 'style="max-height: '.$height.'px"';
                                    }
                                    printf('<img src="%s" class="provider-logo" %s>', $logo, $height_attr);
                                }
                                else {
                                    printf('<h4>%s</h4>', $p->post_title);
                                }
                                ?>
                            </div>
                            <?php

                            $added = "";
                            $added_text = "Add to compare";
                            if($_COOKIE['compare_providers']){
                                $cookie = explode(',', $_COOKIE['compare_providers']);
                                if(in_array($p->ID, $cookie)){
                                    $added = "added";
                                    $added_text = "Added to compare";
                                }
                            }
                            ?>
                            
                            <button class="add-to-compare <?php echo $added; ?>" data-provider-id="<?php echo $p->ID; ?>" data-name="<?php echo $p->post_title; ?>"><?php echo $added_text; ?></button>
                        </header>
                        <?php
                        $video = $video[0];
                        if($video['youtube_video_id']){
                            $video_image = 'https://img.youtube.com/vi/'.$video['youtube_video_id'].'/hqdefault.jpg';
                            if($video['video_image']){
                                $video_image = $video['video_image'];
                            }
                            
                            printf('<button type="button" class="open-video-popup" data-id="profile-video-%s"><span>short demo</span><div class="embed-responsive embed-responsive-16by9"><img src="%s"></div></button>', $p->ID, $video_image);
                            
                            printf('<div class="provider-video-popup popup" id="profile-video-%s"><div class="content-wrapper clear"><div class="content"><button type="button" class="close"><span class="sr-only">Close</span></button><div class="embed-responsive embed-responsive-16by9"><iframe width="560" height="315" src="https://www.youtube.com/embed/%s" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div></div></div></div>', $p->ID, $video['youtube_video_id']);
                        }else{
                            echo '<div class="placeholder"><span>short demo</span><p>Video Coming Soon</p></div>';
                        }
                        ?>
                        <ul class="provider-short-profile no-style">
                            <?php
                            // $overview = get_field('overview', $p->ID);
                            // $overview = $overview[0];
                            // foreach($overview as $overview_item){
                            //     if($overview_item != "" && strtolower($overview_item) != "n/a"){
                            //         printf('<li>%s</li>', $overview_item);
                            //     }
                                
                            // }

                            if( have_rows('overview', $p->ID) ):
                                $c_obj = get_field_object('overview', $p->ID);    
                                $sfk = array(); // sub field keys
                                foreach($c_obj['value'][0] as $key => $val){
                                    array_push($sfk, $key);
                                }
                                //output($sfk);
                                while( have_rows('overview', $p->ID) ): the_row();

                                    foreach($sfk as $k){
                                        $section_obj = get_sub_field_object($k);
                                        $section_label = $section_obj['label'];

                                        
                                        echo '<li data-mh="item-'.$k.'">';
                                            printf('<strong>%s: </strong> %s', $section_label, get_sub_field($k));
                                        echo '</li>';
                                        
                                    }
                                endwhile;
                            endif;
                            ?>
                        </ul>
                        <footer>
                            <div>
                                <?php
                                if($demo_link){
                                    printf('<a href="%s" class="button" target="_blank">Book a Demo</a>', $demo_link);
                                }
                                ?>
                                
                                <a href="<?php echo $link; ?>" class="button buttonSecondary">Full profile</a>
                            </div>
                            
                        </footer>
                    </div>
                </li>
                <?php
            }
        }
        ?>
    </ul>
</div>
<?php
$content = ob_get_contents();
ob_end_clean();
return $content;

}
add_shortcode( 'providers' , 'shortcode_providers' );
?>
