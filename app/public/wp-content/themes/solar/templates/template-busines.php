<?php
    /*
    Template Name: СЕС для бізнесу
    */
get_header();
$fields = get_fields();
$fields_option = get_fields('option');
$fields_main = get_fields(PAGE_ID_HOME);
$lang = pll_current_language();
?>

<div class="seb-hero first-display">
    <!-- <div class="wrapper-big">
        <div class="breadcrumbs">
            <?php 
                if ( !empty($fields_main['breadcrumbs_home']) ) {
            ?>
            <a href="#"><?php echo $fields_main['breadcrumbs_home']; ?></a>
            <?php 
                }
            ?>
            <div class="sep"></div>
            <p>
                <?php 
                    if ( !empty($fields['hero_title']) ) {
                        echo $fields['hero_title'];
                    }
                ?>
            </p>
        </div>
    </div> -->
    <div class="wrapper">
        <?php 
            if ( !empty($fields['hero_title']) ) {
        ?>
        <h1 class="seb-hero-title">
            <?php echo $fields['hero_title']; ?>
        </h1>
        <?php 
            }
            if ( !empty($fields['hero_text']) ) {
        ?>
        <div class="seb-hero-text">
            <?php echo $fields['hero_text']; ?>
        </div>
        <?php 
            }
        ?>
        <div class="seb-hero-image">
            <?php 
            $hero_image_size = 'full';
            if(wp_is_mobile()){
                $hero_image_size = 'medium';
            }
            if ( !empty( $fields['hero_image'] ) ) {
                echo wp_get_attachment_image( $fields['hero_image'], $hero_image_size, null, ['fetchpriority' => 'high'] );
            }
            ?>
        </div>
    </div>
</div>
<div class="seb-2 section">
    <div class="wrapper">
        <?php 
            if ( !empty($fields['how_work_title']) ) {
        ?>
        <h2 class="seb-2-title">
            <?php echo $fields['how_work_title']; ?>
        </h2>
        <?php 
            }
        ?>
    </div>
    <div class="seb-2-list-wrapper">
        <div class="wrapper">
            <div class="seb-2-list">
                <?php 
                if(!empty($fields['how_work_add'])) {
                    foreach($fields['how_work_add'] as $row) {
                        ?>
                <div class="seb-2-item-wrapper">
                    <div class="seb-2-item ">
                        <div class="seb-2-item-deg"></div>
                        <?php 
                            if ( !empty($row['how_work_add_title']) ) {
                        ?>
                        <h3 class="seb-2-item-title">
                            <?php echo $row['how_work_add_title']; ?>
                        </h3>
                        <?php 
                            }
                            if ( !empty($row['how_work_add_text']) ) {
                        ?>
                        <div class="seb-2-item-text">
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
    <div class="seb-2-image">
        <?php 
        $image_size_seb_2 = 'full';
        if(wp_is_mobile()){
            $image_size_seb_2 = 'medium';
        }

        if ( !empty( $fields['how_work_image'] ) ) {
            echo wp_get_attachment_image( $fields['how_work_image'], $image_size_seb_2);
        }
        ?>
    </div>
</div>

<?php 
    get_template_part('parts/seb-3-offer');
?>

<div class="seb-4 section">
    <div class="wrapper">
        <div class="m-2-top">
            <?php 
                if ( !empty($fields['work_scripts_title']) ) {
            ?>
            <div class="m-2-top-left">
                <?php echo $fields['work_scripts_title']; ?>
            </div>
            <?php 
                }
            ?>
        </div>
        <div class="seb-4-list">
            <?php 
            if(!empty($fields['work_scripts_add'])) {
                foreach($fields['work_scripts_add'] as $key => $row) {
                    ?>
            <div class="seb-4-item seb-4-item--<?php echo $key + 1; ?>">
                <div class="seb-4-item-header">
                    <?php 
                        if ( !empty($row['work_scripts_add_top']) ) {
                    ?>
                    <div class="seb-4-item-tag">
                        <?php echo $row['work_scripts_add_top']; ?>
                    </div>
                    <?php 
                        }
                    ?>
                    <div class="seb-4-item-icon">
                        <?php 
                        if ( !empty( $row['work_scripts_add_icon'] ) ) {
                            echo wp_get_attachment_image( $row['work_scripts_add_icon'], 'medium' );
                        }
                        ?>
                    </div>
                    <?php 
                        if ( !empty($row['work_scripts_add_title']) ) {
                    ?>
                    <h3 class="seb-4-item-title">
                        <?php echo $row['work_scripts_add_title']; ?>
                    </h3>
                    <?php 
                        }
                    ?>
                </div>
                <?php 
                    if ( !empty($row['work_scripts_add_sub_title']) ) {
                ?>
                <div class="seb-4-item-sub-title">
                    <?php echo $row['work_scripts_add_sub_title']; ?>
                </div>
                <?php 
                    }
                    if ( !empty($fields['work_scripts_sub_title_description']) ) {
                ?>
                <div class="seb-4-item-small-title">
                    <?php echo $fields['work_scripts_sub_title_description']; ?>
                </div>
                <?php 
                    }
                    if ( !empty($row['work_scripts_add_description']) ) {
                ?>
                    <div class="seb-4-item-text">
                        <?php echo $row['work_scripts_add_description']; ?>
                    </div>
                <?php 
                    }
                    if ( !empty($fields['work_scripts_sub_title_for_what']) ) {
                ?>
                <div class="seb-4-item-small-title">
                    <?php echo $fields['work_scripts_sub_title_for_what']; ?>
                </div>
                <?php 
                    }
                    if ( !empty($row['work_scripts_add_for_what']) ) {
                ?>
                    <div class="seb-4-item-text">
                        <?php echo $row['work_scripts_add_for_what']; ?>
                    </div>
                <?php 
                    }
                    if ( !empty($fields['work_scripts_btn_text']) ) {
                ?>
                <a href="#call-back" class="main-btn" data-action="Блок - сценарії роботи: <?php if(!empty($row['work_scripts_add_title'])){ echo $row['work_scripts_add_title']; } ?>">
                    <?php echo $fields['work_scripts_btn_text']; ?>
                </a>
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
	?>
<div class="seb-5 section">
    <div class="wrapper">
        <div class="m-2-top">
            <?php 
                if ( !empty($fields['steps_title']) ) {
            ?>
            <div class="m-2-top-left">
                <?php echo $fields['steps_title']; ?>
            </div>
            <?php 
                }
                if ( !empty($fields['steps_text']) ) {
            ?>
            <div class="m-2-top-right">
                <?php echo $fields['steps_text']; ?>
            </div>
            <?php 
                }
            ?>
        </div>
        <div class="seb-5-body">
            <?php 
            if(!empty($fields['steps_add'])) {
                foreach($fields['steps_add'] as $key => $row) {
                    ?>
            <div class="seb-5-item <?php if($key == 0){echo 'active'; } ?>">
                <div class="seb-5-item-title">
                    <?php 
                        if ( !empty($row['steps_add_title']) ) {
                    ?>
                    <h3 class="seb-5-item-title-text">
                        <?php echo $row['steps_add_title']; ?>
                    </h3>
                    <?php 
                        }
                    ?>
                    <div class="seb-5-item-title-icon"></div>
                </div>
                <?php 
                    if ( !empty($row['steps_add_text']) ) {
                ?>
                    <div class="seb-5-item-text">
                        <?php echo $row['steps_add_text']; ?>
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

<div class="seb-6 section">
    <div class="seb-6-bg">
        <?php 
        $bank_image_size = "full";
        if(wp_is_mobile()){
            $bank_image_size = "medium";
        }

        if ( !empty( $fields['bank_bg'] ) ) {
            echo wp_get_attachment_image( $fields['bank_bg'], $bank_image_size, null, ['class' => ''] );
        }
        ?>
    </div>
    <div class="wrapper">
        <div class="m-2-top">
            <?php 
                if ( !empty($fields['bank_title']) ) {
            ?>
            <div class="m-2-top-left">
                <?php echo $fields['bank_title']; ?>
            </div>
            <?php 
                }
                if ( !empty($fields['bank_text']) ) {
            ?>
            <div class="m-2-top-right">
                <?php echo $fields['bank_text']; ?>
            </div>
            <?php 
                }
            ?>
        </div>
        <div class="seb-6-body">
            <div class="seb-6-body-left">
                <?php 
                    if ( !empty($fields['bank_title_left']) ) {
                ?>
                <h2 class="seb-6-body-left-title">
                    <?php echo $fields['bank_title_left']; ?>
                </h2>
                <?php 
                    }
                    if ( !empty($fields['bank_sub_title_left']) ) {
                ?>
                <div class="seb-6-body-left-sub-text">
                    <?php echo $fields['bank_sub_title_left']; ?>
                </div>
                <?php 
                    }
                ?>
                <?php 
                    if ( !empty($fields['bank_text_left']) ) {
                ?>
                <div class="seb-6-body-left-list">
                    <?php echo $fields['bank_text_left']; ?>
                </div>
                <?php 
                    }
                    if ( !empty($fields['bank_btn_text']) ) {
                ?>
                <a href="#call-back" class="main-btn" data-action="<?php echo $fields['bank_btn_text']; ?>">
                    <?php echo $fields['bank_btn_text']; ?>
                </a>
                <?php 
                    }
                ?>
            </div>
            <div class="seb-6-body-right">
                <?php 
                    if ( !empty($fields['bank_title_right']) ) {
                ?>
                <div class="seb-6-right-sub-title">
                    <?php echo $fields['bank_title_right']; ?>
                </div>
                <?php 
                    }
                ?>
                <div class="seb-6-right-list">
                    <?php 
                    if ( !empty( $fields['bank_logo_1'] ) ) {
                        echo wp_get_attachment_image( $fields['bank_logo_1'], 'medium', null, ['class' => ''] );
                    }
                    if ( !empty( $fields['bank_logo_2'] ) ) {
                        echo wp_get_attachment_image( $fields['bank_logo_2'], 'medium', null, ['class' => ''] );
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="seb-7 section">
    <div class="wrapper">
        <div class="seb-7-flex">
            <div class="seb-7-left">
                <?php 
                    if ( !empty($fields['why_we_title']) ) {
                ?>
                <h2 class="seb-7-left-title">
                    <?php echo $fields['why_we_title']; ?>
                </h2>
                <?php 
                    }
                    if ( !empty($fields['why_we_text']) ) {
                ?>
                    <div class="seb-7-left-text">
                        <?php echo $fields['why_we_text']; ?>
                    </div>
                <?php 
                    }
                ?>
            </div>
            <div class="seb-7-right">
                <?php 
                if(!empty($fields['why_we_add'])) {
                    foreach($fields['why_we_add'] as $row) {
                        ?>
                <div class="seb-7-right-item">
                    <div class="seb-7-right-item-icon">
                        <?php 
                        if ( !empty( $row['why_we_add_icon'] ) ) {
                            echo wp_get_attachment_image( $row['why_we_add_icon'], 'full', null, ['class' => ''] );
                        }
                        ?>
                    </div>
                    <?php 
                        if ( !empty($row['why_we_add_title']) ) {
                    ?>
                    <h3 class="seb-7-right-item-title">
                        <?php echo $row['why_we_add_title']; ?>
                    </h3>
                    <?php 
                        }
                        if ( !empty($row['why_we_add_text']) ) {
                    ?>
                    <div class="seb-7-right-item-text">
                        <?php echo $row['why_we_add_text']; ?>
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
    get_template_part('parts/faq');
    get_template_part('parts/seo');
?>

<?php
echo get_footer();
?>