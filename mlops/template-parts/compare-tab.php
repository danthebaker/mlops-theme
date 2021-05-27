<section class="compare-bar">
    <div class="section-content-wrapper">
        <button class="compare-tab-toggle">Compare providers</button>
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
</section>

<div class="compare-popup popup">
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
                    
                    <table class="comparison-table overview">
                        <thead>
                            <tr class="exc">
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-key="vendor_name" class="exc">
                                <td>Vendor</td>
                            </tr>
                            <tr data-key="video" class="exc">
                                <td>Demo link</td>
                            </tr>
                            <tr data-key="demo_link" class="exc">
                                <td></td>
                            </tr>
                            <?php
                            $post = get_posts(array('post_type' => 'provider', 'numberposts' => 1));
                            $id = $post[0]->ID; // any post id. we just need one to get the acf field objects

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
                            ?>
                        </tbody>
                    </table>

                    <section class="provider-profile">
                        <h2>Feature Store Capabilities</h2>
                        <?php

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
                        ?>
                    </section>

                    <?php 

                    // if( have_rows('capabilities', $id) ):
                    //     $c_obj = get_field_object('capabilities', $id);    
                    //     $sfk = array(); // sub field keys
                    //     foreach($c_obj['value'][0] as $key => $val){
                    //         array_push($sfk, $key);
                    //     }
                    //     while( have_rows('capabilities', $id) ): the_row();
                            
                    //         foreach($sfk as $k){
                    //             $section_obj = get_sub_field_object($k);
                    //             $section_label = $section_obj['label'];
                    //             ?>
                    <!-- //             <div class="compare-accordion <?php //echo $k; ?>">
                    //                 <button type="button" class="accordion-toggle"><?php //echo $section_label; ?></button>
                    //                 <div class="accordion-content">
                    //                     <table class="comparison-table <?php //echo $k; ?>"> -->
                                             <?php
                    //                         $items = array();
                    //                         foreach($section_obj['value'][0] as $kk => $section_val){
                    //                             array_push($items, $kk);
                    //                         }
                    //                         if( have_rows($k) ):
                    //                             while( have_rows($k) ): the_row();
                    //                                 foreach($items as $item_val){
                    //                                     $item_obj = get_sub_field_object($item_val);
                    //                                     $item_label = $item_obj['instructions'];
                    //                                     ?>
                    <!-- //                                     <tr data-key="<?php //echo $item_val; ?>">
                    //                                         <td><?php //echo $item_label; ?></td>
                    //                                     </tr> -->
                                                         <?php
                    //                                 }
                    //                             endwhile;
                    //                         endif; 
                    //                         ?>
                    <!-- //                     </table>
                    //                 </div>
                    //             </div> -->
                                 <?php
                    //         }
                    //     endwhile;
                    // endif; 
                    
                    ?>

                    <table class="comparison-table demo_links">
                        <tr data-key="demo_link">
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>