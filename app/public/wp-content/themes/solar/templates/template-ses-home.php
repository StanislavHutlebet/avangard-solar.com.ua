<?php
    /*
    Template Name: СЕС для дому
    */
get_header();
$fields = get_fields();
$fields_option = get_fields('option');
$fields_main = get_fields(PAGE_ID_HOME);
?>

    <div class="seh-home">
        <div class="seh-home-bg-wrapper">
            <div class="seh-home-bg-black">
                <?php 
                $hero_image_size = 'full';
                if(wp_is_mobile()){
                    $hero_image_size = 'medium';
                }

                if ( !empty( $fields['hero_bg_black'] ) ) {
                    echo wp_get_attachment_image( $fields['hero_bg_black'], $hero_image_size, null, ['fetchpriority' => 'high'] );
                }
                ?>
            </div>
            <div class="seh-home-bg-white">
                <?php 
                if ( !empty( $fields['hero_bg_white'] ) ) {
                    echo wp_get_attachment_image( $fields['hero_bg_white'], $hero_image_size, null, ['class' => ''] );
                }
                ?>
            </div>
        </div>
        <div class="wrapper">
            <div class="seh-home-flex">
                <div class="seh-home-left">
                    <?php 
                        if ( !empty($fields['hero_title']) ) {
                    ?>
                    <h1 class="seh-home-title">
                        <?php echo $fields['hero_title']; ?>
                    </h1>
                    <?php 
                        }
                    ?>
                </div>
                <div class="seh-home-right">
                    <?php 
                        if ( !empty($fields['hero_text']) ) {
                    ?>
                    <div class="seh-home-right-text">
                        <?php echo $fields['hero_text']; ?>
                    </div>
                    <?php 
                        }
                        if ( !empty($fields['hero_btn_tet']) ) {
                    ?>
                    <a href="#call-back" class="main-btn">
                        <?php echo $fields['hero_btn_tet']; ?>
                    </a>
                    <?php 
                        }
                    ?>
                </div>
            </div>

            <div class="seh-statis-line-wrapper">
                <div class="seh-statis-line">
                    <div class="seh-statis-line-item"></div>
                </div>
                <div class="seh-statis-line-tap-list">
                    <?php 
                        if ( !empty($fields['hero_text_1']) ) {
                    ?>
                    <div class="seh-statis-line-tap seh-statis-line-tap-1">
                        <?php echo $fields['hero_text_1']; ?>
                    </div>
                    <?php 
                        }
                        if ( !empty($fields['hero_text_2']) ) {
                    ?>
                    <div class="seh-statis-line-tap seh-statis-line-tap-2">
                        <?php echo $fields['hero_text_2']; ?>
                    </div>
                    <?php 
                        }
                        if ( !empty($fields['hero_text_3']) ) {
                    ?>
                    <div class="seh-statis-line-tap seh-statis-line-tap-3">
                        <?php echo $fields['hero_text_3']; ?>
                    </div>
                    <?php 
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php 
        get_template_part('parts/seh-2-calc-with-grafic');
    ?>

    <div class="seh-3 section">
        <div class="wrapper">
            <div class="m-2-top">
                <?php 
                    if ( !empty($fields['how_work_title']) ) {
                ?>
                <div class="m-2-top-left">
                    <?php echo $fields['how_work_title']; ?>
                </div>
                <?php 
                    }
                    if ( !empty($fields['how_work_text']) ) {
                ?>
                    <div class="m-2-top-right">
                        <?php echo $fields['how_work_text']; ?>
                    </div>
                <?php 
                    }
                ?>
            </div>
            <div class="seh-3-tab-list">
                <?php 
                    if ( !empty($fields['how_work_tab_text_1']) ) {
                ?>
                <div class="seh-3-tab seh-3-tab-1 active" data-tab="1">
                    <?php echo $fields['how_work_tab_text_1']; ?>
                </div>
                <?php 
                    }
                    if ( !empty($fields['how_work_tab_text_2']) ) {
                ?>
                <div class="seh-3-tab seh-3-tab-2" data-tab="2">
                    <?php echo $fields['how_work_tab_text_2']; ?>
                </div>
                <?php 
                    }
                    if ( !empty($fields['how_work_tab_text_3']) ) {
                ?>
                <div class="seh-3-tab seh-3-tab-3" data-tab="3">
                    <?php echo $fields['how_work_tab_text_3']; ?>
                </div>
                <?php 
                    }
                ?>
            </div>
            <div class="seh-body-wrapper">
                <div class="seh-body-image-box">
                    <div class="seh-body-image active" data-image="1">
                        <?php 
                        $seh_image_size = 'full';
                        if(wp_is_mobile()){
                            $seh_image_size = 'medium';
                        }

                        if ( !empty( $fields['how_work_image_1'] ) ) {
                            echo wp_get_attachment_image( $fields['how_work_image_1'], $seh_image_size, null, ['class' => ''] );
                        }
                        ?>
                    </div>
                    <div class="seh-body-image" data-image="2">
                        <?php 
                        if ( !empty( $fields['how_work_image_2'] ) ) {
                            echo wp_get_attachment_image( $fields['how_work_image_2'], $seh_image_size, null, ['class' => ''] );
                        }
                        ?>
                    </div>
                    <div class="seh-body-image" data-image="3">
                        <?php 
                        if ( !empty( $fields['how_work_image_3'] ) ) {
                            echo wp_get_attachment_image( $fields['how_work_image_3'], $seh_image_size, null, ['class' => ''] );
                        }
                        ?>
                    </div>
                </div>

                <?php 
                if(!empty($fields['how_work_add'])) {
                    foreach($fields['how_work_add'] as $key => $row) {
                        ?>
                <div class="seh-3-body <?php if($key == 0){echo 'active'; } ?>" data-block="<?php echo $key + 1; ?>">
                    <div class="seh-3-content">
                        <?php 
                            if ( !empty($row['how_work_add_pre_title']) ) {
                        ?>
                        <div class="seh-3-right-pre-title">
                            <?php echo $row['how_work_add_pre_title']; ?>
                        </div>
                        <?php 
                            }
                            if ( !empty($row['how_work_add_title']) ) {
                        ?>
                        <h3 class="seh-3-right-title">
                            <?php echo $row['how_work_add_title']; ?>
                        </h3>
                        <?php 
                            }
                            if ( !empty($row['how_work_add_text']) ) {
                        ?>
                        <div class="seh-3-right-text">
                            <?php echo $row['how_work_add_text']; ?>
                        </div>
                        <?php 
                            }
                        ?>
                        
                    </div>
                </div>
                <?php
                    }
                }
                ?>
            </div>
            
        </div>
    </div>

    <div class="seh-4 section">
        <div class="wrapper">
            <div class="m-2-top">
                <?php 
                    if ( !empty($fields['types_title']) ) {
                ?>
                <div class="m-2-top-left">
                    <?php echo $fields['types_title']; ?>
                </div>
                <?php 
                    }
                    if ( !empty($fields['types_text']) ) {
                ?>
                <div class="m-2-top-right">
                    <?php echo $fields['types_text']; ?>
                </div>
                <?php 
                    }
                ?>
            </div>

            <div class="seh-4-table-wrap">
                <div class="seh-4-table">
                    <div class="seh-4-row seh-4-row-header">
                        <div class="seh-4-col seh-4-col-1"></div>
                        <?php 
                            if ( !empty($fields['types_table_header_col_2']) ) {
                        ?>
                        <div class="seh-4-col seh-4-col-2">
                            <?php echo $fields['types_table_header_col_2']; ?>
                        </div>
                        <?php 
                            }
                            if ( !empty($fields['types_table_header_col_3']) ) {
                        ?>
                        <div class="seh-4-col seh-4-col-3">
                            <?php echo $fields['types_table_header_col_3']; ?>
                        </div>
                        <?php 
                            }
                            if ( !empty($fields['types_table_header_col_4']) ) {
                        ?>
                        <div class="seh-4-col seh-4-col-4">
                            <?php echo $fields['types_table_header_col_4']; ?>
                        </div>
                        <?php 
                            }
                        ?>
                    </div>
                    
                    <?php 
                    if(!empty($fields['types_table_add'])) {
                        foreach($fields['types_table_add'] as $row) {
                            ?>
                    <div class="seh-4-row">
                        <?php 
                            if ( !empty($row['types_table_add_col_1']) ) {
                        ?>
                        <div class="seh-4-col seh-4-col-1">
                            <?php echo $row['types_table_add_col_1']; ?>
                        </div>
                        <?php 
                            }
                            if ( !empty($row['types_table_add_col_2']) ) {
                        ?>
                        <div class="seh-4-col seh-4-col-2">
                            <?php echo $row['types_table_add_col_2']; ?>
                        </div>
                        <?php 
                            }
                            if ( !empty($row['types_table_add_col_3']) ) {
                        ?>
                        <div class="seh-4-col seh-4-col-3">
                            <?php echo $row['types_table_add_col_3']; ?>
                        </div>
                        <?php 
                            }
                        ?>
                        <?php 
                            if ( !empty($row['types_table_add_col_4']) ) {
                        ?>
                        <div class="seh-4-col seh-4-col-4">
                            <?php echo $row['types_table_add_col_4']; ?>
                        </div>
                        <?php 
                            }
                        ?>
                    </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
	<?php 
		if(!empty(get_field('sets_product_items'))){
	?>
	<div class="m-4 section">
        <div class="wrapper">
            <div class="m-2-top">
                <?php 
                    if ( !empty($fields['sets_product_title']) ) {
                ?>
                <div class="m-2-top-left">
                    <?php echo $fields['sets_product_title']; ?>
                </div>
                <?php 
                    }
                    if ( !empty($fields['sets_product_text']) ) {
                ?>
                <div class="m-2-top-right">
                    <?php echo $fields['sets_product_text']; ?>
                </div>
                <?php 
                    }
                ?>
            </div>
            <div class="m-4-body">
                <?php 
                    $products = get_field('sets_product_items');

                    if (!empty($products)) :
                        foreach ($products as $product_obj) :

                            $product = wc_get_product($product_obj->ID);
                            if (!$product) continue;

                            $product_id = $product->get_id();
                            $product_name = $product->get_name();
                            $product_price = $product->get_price();
                            $product_permalink = get_permalink($product_id);
                            $product_image = $product->get_image('medium');
                    ?>

                    <div class="m-4-item">
                        <div class="m-4-item-image">
                            <a href="<?php echo esc_url($product_permalink); ?>">
                                <?php echo $product_image; ?>
                            </a>
                        </div>

                        <div class="m-4-item-bottom">
							<h3 class="m-4-item-title">
								<a href="<?php echo esc_url($product_permalink); ?>" >
                                    <?php echo esc_html($product_name); ?>
                                </a>
							</h3>
                                

                            <div class="m-4-item-price">
                                <?php echo wc_price($product_price); ?>
                            </div>

                            <div class="m-4-item-btns">
                                    <a href="<?php echo esc_url($product_permalink); ?>" 
                                    class="pr-btn-add-basket m-4-item-btn-1">
                                    	<?php 
											if($lang == 'ru'){
												echo 'Подробнее';
											}else {
												echo 'Детальніше';
											}
										?>
                                    </a>

                                <?php if (!empty($fields_main['btn_text_buy_1_click'])) : ?>
                                    <a href="#call-back" 
                                    class="m-4-item-btn-2"
                                    data-product-id="<?php echo esc_attr($product_id); ?>"
                                    data-product-name="<?php echo esc_attr($product_name); ?>">
                                    <?php echo esc_html($fields_main['btn_text_buy_1_click']); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <?php 
                        endforeach;
                    endif;
                    ?>


            </div>
        </div>
    </div>

    <?php 
		}
        get_template_part('parts/faq');
        get_template_part('parts/portfolio', '', ['last' => false]);
        get_template_part('parts/seo');
echo get_footer();
?>