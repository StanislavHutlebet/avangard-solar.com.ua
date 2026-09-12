<?php
    /*
    Template Name: Зелений тариф
    */
    get_header();
    $fields = get_fields();
    $fields_option = get_fields('option');
    $fields_main = get_fields(PAGE_ID_HOME);
?>

    <div class="gr-home">
        <div class="gr-home-bg">
            <div class="gr-home-bg-wrap active" data-bg="1">
                <?php 
                $hero_bg_size = 'full';
                if(wp_is_mobile()){
                    $hero_bg_size = 'medium';
                }
                if ( !empty( $fields['hero_bg_summer'] ) ) {
                    echo wp_get_attachment_image( $fields['hero_bg_summer'], $hero_bg_size, null, ['fetchpriority' => 'high'] );
                }
                ?>
            </div>
            <div class="gr-home-bg-wrap" data-bg="2">
                <?php 
                if ( !empty( $fields['hero_bg_winter'] ) ) {
                    echo wp_get_attachment_image( $fields['hero_bg_winter'], $hero_bg_size, null, ['class' => ''] );
                }
                ?>
            </div>
        </div>
        <div class="wrapper">
            <div class="gr-home-top">
                <div class="gr-home-left">
                    <?php 
                        if ( !empty($fields['hero_title']) ) {
                    ?>
                        <h1 class="gr-home-title">
                            <?php echo $fields['hero_title']; ?>
                        </h1>
                    <?php 
                        }
                    ?>
                </div>
                <?php 
                    if ( !empty($fields['hero_text']) ) {
                ?>
                <div class="gr-home-right">
                    <?php echo $fields['hero_text']; ?>
                </div>
                <?php 
                    }
                ?>
            </div>
            <div class="gr-home-body">
                <?php 
                    if ( !empty($fields['hero_sub_title']) ) {
                ?>
                <h2 class="gr-home-body-title">
                    <?php echo $fields['hero_sub_title']; ?>
                </h2>
                <?php 
                    }
                ?>
                <div class="gr-home-body-tabs-wrap">
                    <div class="gr-home-body-tab">
                        <div class="gr-home-body-tab-icon">
                            <div class="gr-home-body-tab-icon-item active gr-home-body-tab-icon--1" data-item="1"></div>
                            <div class="gr-home-body-tab-icon-item gr-home-body-tab-icon--3" data-item="2"></div>
                        </div>
                        <div class="gr-home-body-tab-title">
                            <?php 
                                if ( !empty($fields['hero_text_summer']) ) {
                            ?>
                            <div class="gr-home-body-tab-title-item active" data-item="1">
                                <?php echo $fields['hero_text_summer']; ?>
                            </div>
                            <?php 
                                }
                                if ( !empty($fields['hero_text_winter']) ) {
                            ?>
                            <div class="gr-home-body-tab-title-item" data-item="2">
                                <?php echo $fields['hero_text_winter']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                        </div>
                        <?php 
                            if ( !empty($fields['hero_text_sesson']) ) {
                        ?>
                        <div class="gr-home-body-tab-text">
                            <?php echo $fields['hero_text_sesson']; ?>
                        </div>
                        <?php 
                            }
                        ?>
                    </div>
                    <div class="gr-home-body-tab">
                        <div class="gr-home-body-tab-icon gr-home-body-tab-icon--2"></div>
                        <div class="gr-home-body-tab-title">
                            <?php 
                                if ( !empty($fields['hero_summer_value']) ) {
                            ?>
                            <div class="gr-home-body-tab-title-item active" data-item="1">
                                <?php echo $fields['hero_summer_value']; ?>
                            </div>
                            <?php 
                                }
                                if ( !empty($fields['hero_winter_value']) ) {
                            ?>
                            <div class="gr-home-body-tab-title-item" data-item="2">
                                <?php echo $fields['hero_winter_value']; ?>
                            </div>    
                            <?php 
                                }
                            ?>
                        </div>
                        <?php 
                            if ( !empty($fields['hero_text_value_text']) ) {
                        ?>
                        <div class="gr-home-body-tab-text">
                            <?php echo $fields['hero_text_value_text']; ?>
                        </div>
                        <?php 
                            }
                        ?>
                    </div>
                </div>
                <div class="gr-home-tabs-triger">
                    <?php 
                        if ( !empty($fields['hero_text_summer']) ) {
                    ?>
                    <div class="gh-home-tabs-triger-item active" data-item="1">
                        <?php echo $fields['hero_text_summer']; ?>
                    </div>
                    <?php 
                        }
                        if ( !empty($fields['hero_text_winter']) ) {
                    ?>
                    <div class="gh-home-tabs-triger-item" data-item="2">
                        <?php echo $fields['hero_text_winter']; ?>
                    </div>
                    <?php 
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="gr-2 section">
        <div class="wrapper">
            <div class="m-2-top">
                <?php 
                    if ( !empty($fields['what_is_it_title']) ) {
                ?>
                <div class="m-2-top-left">
                    <?php echo $fields['what_is_it_title']; ?>
                </div>
                <?php 
                    }
                    if ( !empty($fields['what_is_it_text']) ) {
                ?>
                <div class="m-2-top-right">
                    <?php echo $fields['what_is_it_text']; ?>
                </div>
                <?php 
                    }
                ?>
            </div>
            <div class="gr-2-body">
                <div class="gr-2-body-item">
                    <?php 
                        if ( !empty($fields['what_is_it_item_1_title']) ) {
                    ?>
                    <h3 class="gr-2-body-item-title">
                        <?php echo $fields['what_is_it_item_1_title']; ?>
                    </h3>
                    <?php 
                        }
                        if ( !empty($fields['what_is_it_item_1_text']) ) {
                    ?>
                    <div class="gr-2-body-item-text">
                        <?php echo $fields['what_is_it_item_1_text']; ?>
                    </div>
                    <?php 
                        }
                    ?>
                </div>
                <div class="gr-2-body-item">
                    <?php 
                        if ( !empty($fields['what_is_it_item_2_title']) ) {
                    ?>
                    <h3 class="gr-2-body-item-title">
                        <?php echo $fields['what_is_it_item_2_title']; ?>
                    </h3>
                    <?php 
                        }
                        if ( !empty($fields['what_is_it_item_2_text']) ) {
                    ?>
                    <div class="gr-2-body-item-text">
                        <?php echo $fields['what_is_it_item_2_text']; ?>
                    </div>
                    <?php 
                        }
                    ?>
                </div>
            </div>
            <div class="gr-2-bottom">
                <div class="gr-2-bottom-line-1">
                    <?php 
                        if ( !empty($fields['what_is_it_top_left_text']) ) {
                    ?>
                    <div class="gr-2-bottom-line-1-left">
                        <?php echo $fields['what_is_it_top_left_text']; ?>
                    </div>
                    <?php 
                        }
                    ?>
                    <div class="gr-2-bottom-line-1-right">
                        <?php 
                        if(!empty($fields['what_is_it_top_right'])) {
                            foreach($fields['what_is_it_top_right'] as $row) {
                                ?>
                        <div class="gr-2-bottom-line-1-right-item">
                            <?php 
                                if ( !empty($row['what_is_it_top_right_text']) ) {
                                    echo $row['what_is_it_top_right_text'];
                                }
                            ?>
                        </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php 
                    if ( !empty($fields['what_is_it_bot_text']) ) {
                ?>
                <div class="gr-2-bottom-line-2">
                    <?php echo $fields['what_is_it_bot_text']; ?>
                </div>
                <?php 
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="gr-3 section">
        <div class="wrapper">
            <div class="m-2-top">
                <?php 
                    if ( !empty($fields['adv_title']) ) {
                ?>
                <div class="m-2-top-left">
                    <?php echo $fields['adv_title']; ?>
                </div>
                <?php 
                    }
                    if ( !empty($fields['adv_text']) ) {
                ?>
                <div class="m-2-top-right">
                    <?php echo $fields['adv_text']; ?>
                </div>
                <?php 
                    }
                ?>
            </div>
            <div class="gr-3-body">
                
                <?php 
                if(!empty($fields['adv_add'])) {
                    foreach($fields['adv_add'] as $row) {
                        ?>
                <div class="gr-3-body-col">
                    <?php 
                        if ( !empty($row['adv_add_title']) ) {
                    ?>
                    <h3 class="gr-3-body-title">
                        <?php echo $row['adv_add_title']; ?>
                    </h3>
                    <?php 
                        }
                        if ( !empty($row['adv_add_text']) ) {
                    ?>
                    <div class="gr-3-body-text">
                        <?php echo $row['adv_add_text']; ?>    
                    </div>
                    <?php 
                        }
                    if(!empty($row['adv_add_rows'])) {
                        foreach($row['adv_add_rows'] as $col) {
                            ?>
                    <div class="gr-3-body-item">
                        <div class="gr-3-body-item-icon">
                            <?php 
                            if ( !empty( $col['adv_add_rows_icon'] ) ) {
                                echo wp_get_attachment_image( $col['adv_add_rows_icon'], 'medium');
                            }
                            ?>
                        </div>
                        <?php 
                            if ( !empty($col['adv_add_rows_title']) ) {
                        ?>
                        <div class="gr-3-body-item-text">
                            <?php echo $col['adv_add_rows_title']; ?>
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
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div class="gr-4 section">
        <div class="wrapper">
            <div class="m-2-top">
                <?php 
                    if ( !empty($fields['payback_title']) ) {
                ?>
                <div class="m-2-top-left">
                    <?php echo $fields['payback_title']; ?>
                </div>
                <?php 
                    }
                    if ( !empty($fields['payback_text']) ) {
                ?>
                <div class="m-2-top-right">
                    <?php echo $fields['payback_text']; ?>
                </div>
                <?php 
                    }
                ?>
            </div>
            <div class="gr-4-table-wrap">
               <div class="gr-4-table">
                   <?php 
                    if(!empty($fields['payback_add'])) {
                        foreach($fields['payback_add'] as $row) {
                            ?>
                    <div class="gr-4-row">
                        <div class="gr-4-col">
                            <?php 
                            if ( !empty($row['payback_add_col_1']) ) {
                                echo $row['payback_add_col_1']; 
                            }
                            ?>
                        </div>
                        <div class="gr-4-col">
                            <?php 
                            if ( !empty($row['payback_add_col_2']) ) {
                                echo $row['payback_add_col_2']; 
                            }
                            ?>
                        </div>
                        <div class="gr-4-col">
                            <?php 
                            if ( !empty($row['payback_add_col_3']) ) {
                                echo $row['payback_add_col_3']; 
                            }
                            ?>
                        </div>
                        <div class="gr-4-col">
                            <?php 
                            if ( !empty($row['payback_add_col_4']) ) {
                                echo $row['payback_add_col_4']; 
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
    </div>

    <div class="gr-5 section">
        <div class="wrapper">
            <div class="m-2-top">
                <?php 
                    if ( !empty($fields['sets_title']) ) {
                ?>
                <div class="m-2-top-left">
                    <?php echo $fields['sets_title']; ?>
                </div>
                <?php 
                    }
                ?>
                <?php 
                    if ( !empty($fields['sets_text']) ) {
                ?>
                    <div class="m-2-top-right">
                        <?php echo $fields['sets_text']; ?>
                    </div>
                <?php 
                    }
                ?>
            </div>
            <div class="gr-5-list">
                <?php 
                if(!empty($fields['sets_add'])) {
                    foreach($fields['sets_add'] as $key => $row) {
                        ?>
                <div class="gr-5-item gr-5-item--<?php echo $key + 1; ?>">
                    <?php 
                        if ( !empty($row['sets_add_title']) ) {
                    ?>
                    <h3 class="gr-5-item-title">
                        <?php echo $row['sets_add_title']; ?>
                    </h3>
                    <?php 
                        }
                        if ( !empty($row['sets_add_text']) ) {
                    ?>
                    <div class="gr-5-item-text">
                        <?php echo $row['sets_add_text']; ?>
                    </div>
                    <?php 
                        }
                    ?>
                    <?php 
                        if ( !empty($fields['sets_btn_text']) ) {
                    ?>
                    <a href="#call-back" class="gr-5-btn" data-action="Станція - <?php if(!empty($row['sets_add_title'])){ echo $row['sets_add_title']; } ?>">
                        <?php echo $fields['sets_btn_text']; ?>
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
        get_template_part('parts/seh-2-calc-with-grafic');
        get_template_part('parts/seb-3-offer');
    ?>

    <div class="gr-6 section">
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
            <div class="gr-6-body">
                <div class="gr-6-left">
                    <?php 
                        if ( !empty($fields['how_work_sub_title']) ) {
                    ?>
                        <h2 class="gr-6-left-title">
                            <?php echo $fields['how_work_sub_title']; ?>
                        </h2>
                    <?php 
                        }
                        if ( !empty($fields['how_work_main_text']) ) {
                    ?>
                        <div class="gr-6-left-text">
                            <?php echo $fields['how_work_main_text']; ?>
                        </div>    
                    <?php 
                        }
                    ?>
                </div>
                <div class="gr-6-right">
                    <?php 
                    $gr_6_size = 'large';
                    if(wp_is_mobile()){
                        $gr_6_size = 'medium';
                    }
                    if ( !empty( $fields['how_work_image'] ) ) {
                        echo wp_get_attachment_image( $fields['how_work_image'], $gr_6_size, null, ['class' => ''] );
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="gr-7 section">
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
                ?>
            </div>
            <div class="gr-7-flex">
                <?php 
                if(!empty($fields['steps_add'])) {
                    foreach($fields['steps_add'] as $key => $row) {
                        ?>
                <div class="gr-7-item">
                    <div class="gr-7-item-title">
                        <div class="gr-7-item-title-count">
                            <?php echo $key + 1; ?>
                        </div>
                        <?php 
                            if ( !empty($row['steps_add_title']) ) {
                        ?>
                            <h3 class="gr-7-item-title-text">
                                <?php echo $row['steps_add_title']; ?>
                            </h3>
                        <?php 
                            }
                        ?>
                    </div>
                    <?php 
                        if ( !empty($row['steps_add_text']) ) {
                    ?>
                    <div class="gr-7-item-text">
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

<?php
    get_template_part('parts/portfolio', '', ['last' => true]);
    get_template_part('parts/seo');


echo get_footer();
?>