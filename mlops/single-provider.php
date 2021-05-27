<?php get_header(); ?>

<?php
$logo = get_the_post_thumbnail_url($post, 'original');
$video = get_field('video');
?>
<header class="feature-store-header">
    <?php
    if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb( '<div class="breadcrumb">','</div>' );
    }
    ?>
    <div class="provider-title">
        <h1><?php the_title(); ?></h1>

        <?php
        $added = "";
        $added_text = "Add to compare";
        if($_COOKIE['compare_providers']){
            $cookie = explode(',', $_COOKIE['compare_providers']);
            if(in_array(get_the_ID(), $cookie)){
                $added = "added";
                $added_text = "Added to compare";
            }
        }
        ?>
        <button class="add-to-compare <?php echo $added; ?>" data-provider-id="<?php echo the_ID(); ?>" data-name="<?php echo $post->post_title; ?>"><?php echo $added_text; ?></button>
    </div>
    
</header>

<div class="provider-body">
    
    <section class="provider-logo-vid">
        <?php

        if($logo){

            $height_attr = "";
            if($height = get_field('logo_height')){
                $height_attr = 'style="height: '.$height.'px"';
            }
            printf('<img src="%s" class="provider-logo" %s>', $logo, $height_attr);
        }

        $video = $video[0];
        if($video['youtube_video_id']){
            echo '<div class="vid-wrapper">';
            $video_image = 'https://img.youtube.com/vi/'.$video['youtube_video_id'].'/hqdefault.jpg';
            if($video['video_image']){
                $video_image = $video['video_image'];
            }
            
            printf('<button type="button" class="open-video-popup" data-id="profile-video-%s"><div class="embed-responsive embed-responsive-16by9"><img src="%s"></div></button>', get_the_ID(), $video_image);
            
            printf('<div class="provider-video-popup popup video-popup" id="profile-video-%s"><div class="content-wrapper clear"><div class="content"><button type="button" class="close"><span class="sr-only">Close</span></button><div class="embed-responsive embed-responsive-16by9"><iframe width="560" height="315" src="https://www.youtube.com/embed/%s" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div></div></div></div>', get_the_ID(), $video['youtube_video_id']);
            echo '</div>';
        }else{
            echo '<div class="placeholder"><p>Video coming soon</p></div>';
        }
        ?>
    </section>

	<section class="provider-profile">
        <h2>Commercial Information</h2>
        <?php
        if( have_rows('overview') ):
            $c_obj = get_field_object('overview');    
            $sfk = array(); // sub field keys
            foreach($c_obj['value'][0] as $key => $val){
                array_push($sfk, $key);
            }
            //output($sfk);
            while( have_rows('overview') ): the_row();
                echo '<table>';

                echo '<tr>';
                printf('<td>%s</td>',"Vendor Name");
                printf('<td><p>%s</p></td>',get_the_title());
                echo '</tr>';

                foreach($sfk as $k){
                    $section_obj = get_sub_field_object($k);
                    $section_label = $section_obj['label'];

                    
                    echo '<tr>';
                        printf('<td>%s</td>', $section_label);
                        printf('<td>%s</td>', get_sub_field($k));
                    echo '</tr>';
                    
                }
                echo '</table>';
            endwhile;
        endif;
        ?>
    </section>
    
    <section class="provider-profile">
        <h2>Feature Store Capabilities</h2>
        <?php
        if( have_rows('feature_store_capabilities') ):
            $c_obj = get_field_object('feature_store_capabilities');    
            $sfk = array(); // sub field keys
            foreach($c_obj['value'][0] as $key => $val){
                array_push($sfk, $key);
            }
            //output($sfk);
            while( have_rows('feature_store_capabilities') ): the_row();
                echo '<table>';
                foreach($sfk as $k){
                    $section_obj = get_sub_field_object($k);
                    $section_label = $section_obj['label'];

                    
                    echo '<tr>';
                        printf('<td>%s</td>', $section_label);
                        printf('<td>%s</td>', get_sub_field($k));
                    echo '</tr>';
                    
                }
                echo '</table>';
            endwhile;
        endif;
        ?>
    </section>
    <?php 

    // if( have_rows('capabilities') ):
    //     $c_obj = get_field_object('capabilities');    
    //     $sfk = array(); // sub field keys
    //     foreach($c_obj['value'][0] as $key => $val){
    //         array_push($sfk, $key);
    //     }
    //     while( have_rows('capabilities') ): the_row();
            
    //         foreach($sfk as $k){
    //             $section_obj = get_sub_field_object($k);
    //             $section_label = $section_obj['label'];
    //             ?>
    <!-- //             <section class="provider-profile">
    //                 <h2><?php echo $section_label; ?></h2>
    //                 <table> -->

                         <?php
    //                     $items = array();
    //                     foreach($section_obj['value'][0] as $kk => $section_val){
    //                         array_push($items, $kk);
    //                     }
    //                     if( have_rows($k) ):
    //                         while( have_rows($k) ): the_row();
    //                             foreach($items as $item_val){
    //                                 $item_obj = get_sub_field_object($item_val);
    //                                 $item_label = $item_obj['instructions'];
    //                                 ?>
    <!-- //                                 <tr>
    //                                     <td><?php //echo $item_label; ?></td>
    //                                     <td> -->
                                             <?php
    //                                         $val = get_sub_field($item_val);
    //                                         $val = $val[0];
    //                                         if($val['value'] == 'y'){
    //                                             echo '<span class="checkmark-round-pink"><span class="sr-only">Yes</span></span>';
    //                                         }
    //                                         else if($val['value'] == 'n'){
    //                                             echo '<span class="x-round-grey"><span class="sr-only">No</span></span>';
    //                                         }
    //                                         else {
    //                                             echo $val['other_value'];
    //                                         }
    //                                         ?>
                                            
    <!-- //                                     </td>
    //                                 </tr> -->
                                     <?php
    //                             }
    //                         endwhile;
    //                     endif; 
    //                     ?>
    <!-- //                 </table>
    //             </section> -->
                 <?php
    //         }
    //     endwhile;
    // endif; 
    
    ?>


</div>

<?php get_template_part('template-parts/newsletter');?>
<?php get_template_part('template-parts/compare-tab');?>
		
</div>
<?php get_footer(); ?>
