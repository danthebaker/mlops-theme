<?php
add_action( 'wp_ajax_mlops_add_to_compare', 'mlops_add_to_compare'  );
add_action( 'wp_ajax_nopriv_mlops_add_to_compare', 'mlops_add_to_compare' );


function mlops_add_to_compare(){
	$ids = $_POST['ids'];
    $category = $_POST['category'];
    $result = false;

    if($ids){
        $ids_arr = explode('%2C', $ids);
        $args = array(
            'post_type' => 'provider',
            'numberposts' => 4,
            'post__in' => $ids_arr,
            'orderby' => 'post__in'
        );
        $posts = get_posts($args);

        if($posts){
            $arr = array();
            
            foreach($posts as $p){
                $item_arr = array();
                $item_arr['ID'] = $p->ID;
                //$item_arr['logo'] = get_the_post_thumbnail_url('original', $p->ID);
                $item_arr['logo'] = get_the_post_thumbnail_url($p->ID, 'original');
                $item_arr['logo_height'] = get_field('logo_height', $p->ID);
                $item_arr['name'] = $p->post_title;
                $item_arr['video'] = get_field('video', $p->ID)[0]['youtube_video_id'];
                switch($category){
                    case "feature-store":
                        $item_arr['overview'] = get_field('overview', $p->ID)[0];
                        $item_arr['feature_store_capabilities'] = get_field('feature_store_capabilities', $p->ID)[0];
                        break;
                    case "monitoring":
                        $item_arr['info']['providers_short_bio'] = get_field('providers_short_bio', $p->ID);
                        $item_arr['info']['cost'] = get_field('cost', $p->ID);
                        $item_arr['info']['video_tutorials'] = get_field('video_tutorials', $p->ID);
                        $item_arr['info']['sample_use_case'] = get_field('sample_use_case', $p->ID);
                        $item_arr['info']['feature_list'] = get_field('feature_list', $p->ID);
                        break;
                    default:
                }
                

                array_push($arr, $item_arr);
            }

            $result = $arr;
        }
    }
    
	die( wp_json_encode( $result ) );
}
?>