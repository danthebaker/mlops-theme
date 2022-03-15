<?php

global $provider_category;

if($provider_category){
?>
<div class="compare-bar" data-provider_category="<?php echo $provider_category; ?>">
    <div class="section-content-wrapper">
        <button class="compare-tab-toggle">Compare providers</button>
        <div class="gradient-radial-wrapper"><span class="gradient-radial"></span></div>
        <div class="compare-providers">
            <ul class="compare-list ul-reset">
                <?php
                $limit = 4;
                for($i = 1; $i <=4; $i++){
                ?>
                <li class="empty">
                    <button class="remove"><span class="sr-only">remove</span></button>
                    <div></div>
                </li>
                <?php
                }
                ?>
            </ul>
            <button class="compare button" disabled>Compare</button>
        </div>
    </div>
</div>

<div class="compare-popup popup" data-provider_category="<?php echo $provider_category; ?>"">
    <div class="section-content-wrapper">
        <div class="content-wrapper clear">
            <button type="button" class="close"><span class="sr-only">Close</span></button>
            <div class="content">
                <header>
                    <h2>Compare providers</h2>
                    <!-- <ul class="filters ul-reset">
                        <li>
                            <input type="radio" name="filter" value="hide-similar" id="hide-similar" autocomplete="off">
                            <label for="hide-similar">Hide similarities</label>
                        </li>
                        <li>
                            <input type="radio" name="filter" value="highlight-different" id="highlight-different" autocomplete="off">
                            <label for="highlight-different">Highlight differences</label>
                        </li>
                    </ul> -->
                </header>
                <div class="compare-content">

                    <section class="provider-profile">
            
                        <table class="comparison-table logos">
                            <tr class="exc">
                                <td></td>
                            </tr>
                        </table>

                    </section>

                    <section class="provider-profile">
                        <h2>Commercial Information</h2>
            
                        <table class="comparison-table overview">
                            <tr data-key="vendor_name" class="exc">
                                <td>Vendor</td>
                            </tr>
                            <tr data-key="video" class="exc">
                                <td>Demo link</td>
                            </tr>
                            <?php
                            switch($provider_category){
                                case 'feature-store':
                                case 'metadata-storage-and-management':
                                    $post = get_posts(array('post_type' => 'provider', 'numberposts' => 1,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'provider_category',
                                            'terms' => $provider_category,
                                            'field' => 'slug',
                                            'operator' => 'IN'
                                        )
                                    )));
                                    $id = $post[0]->ID; // any post id from category. we just need one to get the acf field objects
                                    
                                    if( have_rows('overview', $id) ):
                                        $c_obj = get_field_object('overview', $id);    
                                        $sfk = array(); // sub field keys
                                        foreach($c_obj['value'][0] as $key => $val){
                                            array_push($sfk, $key);
                                        }
                                        while( have_rows('overview', $id) ): the_row();
                                            foreach($sfk as $k){
                                                $section_obj = get_sub_field_object($k);
                                                $section_label = $section_obj['label'];
                                                printf('<tr data-key="%s"><td>%s</td></tr>', $k, $section_label);
                                            }
                                        endwhile;
                                    endif;
                                    break;
                                default:
                            }
                            
                            ?>
                        </table>

                    </section>

                    

                    <section class="provider-profile">
                        <?php
                        switch($provider_category){
                            case 'feature-store':
                                echo '<h2>Feature Store Capabilities</h2>';
                                if( have_rows('feature_store_capabilities', $id) ):
                                    $c_obj = get_field_object('feature_store_capabilities', $id);    
                                    $sfk = array(); // sub field keys
                                    foreach($c_obj['value'][0] as $key => $val){
                                        array_push($sfk, $key);
                                    }
                                    while( have_rows('feature_store_capabilities', $id) ): the_row();
                                        echo '<table class="comparison-table feature_store_capabilities">';
                                        foreach($sfk as $k){
                                            $section_obj = get_sub_field_object($k);
                                            $section_label = $section_obj['label'];
                                            
                                            echo '<tr data-key="'.$k.'">';
                                                printf('<td>%s</td>', $section_label);
                                            echo '</tr>';
                                            
                                        }
                                        echo '</table>';
                                    endwhile;
                                endif;
                                break;
                            case 'metadata-storage-and-management':
                                echo '<h2>Model Store Capabalities</h2>';
                                if( have_rows('model_store_capabalities', $id) ):
                                    $c_obj = get_field_object('model_store_capabalities', $id);    
                                    $sfk = array(); // sub field keys
                                    foreach($c_obj['value'][0] as $key => $val){
                                        array_push($sfk, $key);
                                    }
                                    while( have_rows('model_store_capabalities', $id) ): the_row();
                                        echo '<table class="comparison-table model_store_capabalities">';
                                        foreach($sfk as $k){
                                            $section_obj = get_sub_field_object($k);
                                            $section_label = $section_obj['label'];
                                            
                                            echo '<tr data-key="'.$k.'">';
                                                printf('<td>%s</td>', $section_label);
                                            echo '</tr>';
                                            
                                        }
                                        echo '</table>';
                                    endwhile;
                                endif;
                                break;
                            case 'monitoring':
                                $keys = array(
                                    "providers_short_bio" => "Summary",
                                    "cost" => "How much does it cost?",
                                    "video_tutorials" => "Video/Tutorials",
                                    "sample_use_case" => "What’s a sample use case? Where can I learn from?",
                                    "feature_list" => "Feature List"
                                );
                                echo '<table class="comparison-table">';
                                foreach($keys as $k => $title){
                                    
                                    echo '<tr data-key="'.$k.'">';
                                        printf('<td>%s</td>', $title);
                                    echo '</tr>';
                                    
                                }
                                echo '</table>';
                                break;
                            default:
                            }
                        ?>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
wp_reset_postdata();
global $post;
if(!is_singular('provider') && has_block('acf/resource-carousel') === false){
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
    <?php
}
?>
<?php } ?>