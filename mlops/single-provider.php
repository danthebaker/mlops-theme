<?php get_header(); ?>

<?php
$logo = get_the_post_thumbnail_url($post, 'original');
$video = get_field('video');

global $provider_category;
$terms = get_the_terms($post->ID, "provider_category");
if($terms){
   $provider_category = $terms[0]->slug;
   
}
$cookiename = "compare_providers_".$provider_category;
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
        if(isset($_COOKIE[$cookiename])){
            $cookie = explode(',', $_COOKIE[$cookiename]);
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
            
            printf('<button type="button" class="open-video-popup" data-id="profile-video-%s" data-video="%s"><div class="embed-responsive embed-responsive-16by9"><img src="%s"></div></button>', get_the_ID(), $video['youtube_video_id'], $video_image);
            
            //printf('<div class="provider-video-popup popup video-popup" id="profile-video-%s"><div class="content-wrapper clear"><div class="content"><button type="button" class="close"><span class="sr-only">Close</span></button><div class="embed-responsive embed-responsive-16by9"><iframe width="560" height="315" src="https://www.youtube.com/embed/%s" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div></div></div></div>', get_the_ID(), $video['youtube_video_id']);
            echo '</div>';
        }else{
            echo '<div class="placeholder"><p>Video coming soon</p></div>';
        }
        ?>
        <div class="resource-video-popup popup video-popup">
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

    <?php
    switch($provider_category){
        case "feature-store":
        case "metadata-storage-and-management":
            ?>
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
            break;
        case "monitoring":
            
            if($bio = get_field('what_do_you_do')){
                ?>
                <section class="provider-profile full-bio full-bio-2up">
                    <h2 class="h3">What do you do?</h2>
                    <div class="bio"><?php echo $bio; ?></div>
                </section>
                <?php
            }

            $cost = get_field('cost');
            $video_tutorials = get_field('video_tutorials');

            if($cost || $video_tutorials){
                ?>
                <section class="provider-profile profile-cards profile-cards-2up">
                    <?php
                    if($cost){
                        printf('<div class="profile-card"><h2 class="h3">How much does it cost?</h2><div class="card-content">%s</div></div>', $cost);
                    }
                    if($video_tutorials){
                        printf('<div class="profile-card"><h2 class="h3">Video/Tutorials</h2><div class="card-content">%s</div></div>', $video_tutorials);
                    }
                    ?>
                </section>
                <?php
            }

            if($sample_use_case = get_field('sample_use_case')){
                ?>
                <section class="provider-profile profile-list">
                    <h2 class="h3">What’s a sample use case? Where can I learn from?</h2>
                    <div class="bio"><?php echo $sample_use_case; ?></div>
                </section>
                <?php
            }

            if($feature_list = get_field('feature_list')){
                ?>
                <section class="provider-profile profile-list">
                    <h2 class="h3">Feature List</h2>
                    <div class="bio"><?php echo $feature_list; ?></div>
                </section>
                <?php
            }
        default:
    }
    ?>
</div>

<?php
$faq_header_content = get_field('feature_store_faq_header');
$faq_items = get_field('feature_store_faq');
if($faq_items){
    ?>
    <section class="block-container wp-block-group feature-store-faq"> 
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

<?php
if((current_user_can('administrator') && get_field('enable_reviews_for_admins', 'option') === true) || get_field('enable_reviews_for_users', 'option') === true){ ?>
    
    <section class="block-container wp-block-group feature-store-reviews"> 
        <div class="wp-block-group__inner-container">
            
            <div class="section-header"><h2>Reviews</h2></div>
            
            <div class="reviews-summary"><?php echo do_shortcode('[site_reviews_summary assigned_posts="post_id" hide="if_empty"]'); ?></div>
            
            <div class="reviews"><?php echo do_shortcode('[site_reviews assigned_posts="post_id"]'); ?></div>
            
            <div class="reviews-form">
                <?php
                $ratingInfo = glsr_get_ratings([
                    'assigned_posts' => $post->ID,
                ]);
                
                if(is_user_logged_in() || (! is_user_logged_in() && $ratingInfo->reviews > 0)){
                    printf('<h3>Review %s</h3>', get_the_title());
                }
                ?>
                
                <?php

                

                if(is_user_logged_in()){

                    $current_user = wp_get_current_user();
                    echo '<div class="reviewer-wrapper">';
                        echo '<p>You are reviewing as:';
                            echo reviewer($current_user->ID);
                        echo '</p>';
                        printf('<p><a href="%s">Log out</a></p>', wp_logout_url(get_permalink()));
                    echo '</div>';
                    echo do_shortcode('[site_reviews_form assigned_posts="post_id" hide="email,name,terms"]');
                }
                else {
                    do_action('oa_social_login');
                }
                ?>
            </div>

        </div>
        
    </section>

<?php } ?>
<?php get_template_part('template-parts/newsletter');?>
<?php get_template_part('template-parts/compare-tab');?>
		
</div>
<?php get_footer(); ?>