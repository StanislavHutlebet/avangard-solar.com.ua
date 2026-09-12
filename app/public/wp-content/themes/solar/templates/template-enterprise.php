<?php
    /*
    Template Name: СЕС для Підприємство
    */
get_header();
$fields = get_fields();
$fields_option = get_fields('option');
$fields_main = get_fields(PAGE_ID_HOME);
?>

    <div class="ses-hero first-display">
        <div class="wrapper-big">
            <div class="ses-hero-flex">
                <div class="ses-hero-left">
                    <div class="breadcrumbs">
                        <?php 
                            if ( !empty($fields_main['breadcrumbs_home']) ) {
                        ?>
                        <a href="#"><?php echo $fields_main['breadcrumbs_home']; ?></a>
                        <?php 
                            }
                        ?>
                        <div class="sep"></div>
                        <?php 
                            if ( !empty($fields['hero_title']) ) {
                        ?>
                        <p><?php echo $fields['hero_title']; ?></p>
                        <?php 
                            }
                        ?>
                    </div>
                    <?php 
                        if ( !empty($fields['hero_title']) ) {
                    ?>
                    <h1 class="ses-hero-title">
                        <?php echo $fields['hero_title']; ?>
                    </h1>
                    <?php 
                        }
                        if ( !empty($fields['hero_sub_title']) ) {
                    ?>
                    <div class="ses-sub-title-after-hero">
                        <?php echo $fields['hero_sub_title']; ?>
                    </div>
                    <?php 
                        }
                    ?>
                    <div class="ses-hero-bottom">
                        <?php 
                            if ( !empty($fields['hero_text']) ) {
                        ?>
                        <div class="ses-hero-bottom-left">
                            <?php echo $fields['hero_text']; ?>
                        </div>
                        <?php 
                            }
                            if ( !empty($fields['hero_btn_text']) ) {
                        ?>
                            <div class="ses-hero-bottom-right">
                                <a href="#call-back" class="main-btn">
                                    <?php echo $fields['hero_btn_text']; ?>
                                </a>
                            </div>
                        <?php 
                            }
                        ?>
                    </div>
                </div>
                <div class="ses-hero-right">
                    <div class="ses-hero-right-bg">
                        <?php 
                            $hero_image_size = 'large';
                            if(wp_is_mobile()){
                                $hero_image_size = 'medium';
                            }
                            if ( !empty( $fields['hero_image_right'] ) ) {
                                echo wp_get_attachment_image( $fields['hero_image_right'], $hero_image_size, null, ['fetchpriority' => 'hight'] );
                            }
                        ?>
                    </div>
                    <div class="ses-hero-right-list">
                        <div class="ses-hero-right-list-flex">
                            <?php 
                            if(!empty($fields['hero_add'])) {
                                foreach($fields['hero_add'] as $key => $row) {
                                    ?>
                            <div class="ses-hero-right-item">
                                <?php 
                                    if ( !empty($row['hero_add_title']) ) {
                                ?>
                                <h3 class="ses-hero-right-item-title">
                                    <?php echo $row['hero_add_title']; ?>
                                </h3>
                                <?php 
                                    }
                                    if ( !empty($row['hero_add_text']) ) {
                                ?>
                                <div class="ses-hero-right-item-text">
                                    <?php echo $row['hero_add_text']; ?>
                                </div>
                                <?php 
                                    }
                                ?>
                            </div>
                            <?php 
                                    if($key != 2){ 
                            ?>
                                <div class="ses-hero-right-item-sep"></div>
                            <?php
                                    } 
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ses-2 section">
        <div class="ses-2-image">
            <?php 
            $image_size_ses_2 = 'full';
            if(wp_is_mobile()){
                $image_size_ses_2 = 'medium';
            }

            if ( !empty( $fields['need_image'] ) ) {
                echo wp_get_attachment_image( $fields['need_image'], $image_size_ses_2, null, ['class' => ''] );
            }
            ?>
        </div>
        <div class="wrapper">
            <div class="ses-2-flex">
                <div class="ses-2-left">
                    <?php 
                        if ( !empty($fields['need_title']) ) {
                    ?>
                    <h2 class="ses-2-title">
                        <?php echo $fields['need_title']; ?>
                    </h2>
                    <?php 
                        }
                    ?>
                </div>
                <div class="ses-2-right">
                    <?php 
                    if(!empty($fields['need_add'])) {
                        foreach($fields['need_add'] as $row) {
                            ?>
                    <div class="ses-2-item">
                        <div class="ses-2-item-icon">
                            <?php 
                            if ( !empty( $row['need_add_icon'] ) ) {
                                echo wp_get_attachment_image( $row['need_add_icon'], 'medium' );
                            }
                            ?>
                        </div>
                        <?php 
                            if ( !empty($row['need_add_title']) ) {
                        ?>
                        <h3 class="ses-2-item-title">
                            <?php echo $row['need_add_title']; ?>
                        </h3>
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

    <div class="ses-3 section">
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
            <div class="ses-3-body">
                <div class="ses-3-body-left">
                    <div class="ses-3-body-left-image">
                        <img src="<?php echo get_template_directory_uri();?>/assets/images/ses-3-image-main.png" alt="">
                    </div>
                    <?php 
                        if ( !empty($fields['how_work_info_title_1']) ) {
                    ?>
                    <div class="ses-3-body-text ses-3-body-text-1">
                        <?php echo $fields['how_work_info_title_1']; ?>
                    </div>
                    <?php 
                        }
                        if ( !empty($fields['how_work_info_title_2']) ) {
                    ?>
                    <div class="ses-3-body-text ses-3-body-text-2">
                        <?php echo $fields['how_work_info_title_2']; ?>
                    </div>
                    <?php 
                        }
                        if ( !empty($fields['how_work_info_title_3']) ) {
                    ?>
                    <div class="ses-3-body-text ses-3-body-text-3">
                        <?php echo $fields['how_work_info_title_3']; ?>
                    </div>
                    <?php 
                        }
                    ?>
                    <div class="ses-3-body-item ses-3-body-item-1">
                        <div class="ses-3-body-item-col">
                            <div class="ses-3-body-item-col-active"></div>
                        </div>
                        <div class="ses-3-body-item-box">
                            <div class="ses-3-body-item-value"><strong>19.95</strong>кВт</div>
                            <?php 
                                if ( !empty($fields['how_work_info_text_1']) ) {
                            ?>
                            <div class="ses-3-body-item-text">
                                <?php echo $fields['how_work_info_text_1']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                        </div>
                    </div>
                    <div class="ses-3-body-item ses-3-body-item-2">
                        <div class="ses-3-body-item-col">
                            <div class="ses-3-body-item-col-active"></div>
                        </div>
                        <div class="ses-3-body-item-box">
                            <div class="ses-3-body-item-value"><strong>100</strong>кВт</div>
                            <?php 
                                if ( !empty($fields['how_work_info_text_2']) ) {
                            ?>
                            <div class="ses-3-body-item-text">
                                <?php echo $fields['how_work_info_text_2']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                        </div>
                    </div>
                    <div class="ses-3-body-item ses-3-body-item-3">
                        <div class="ses-3-body-item-col">
                            <div class="ses-3-body-item-col-active"></div>
                        </div>
                        <div class="ses-3-body-item-box">
                            <div class="ses-3-body-item-value"><strong>81.05</strong>кВт</div>
                            <?php 
                                if ( !empty($fields['how_work_info_text_3']) ) {
                            ?>
                            <div class="ses-3-body-item-text">
                                <?php echo $fields['how_work_info_text_3']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="ses-3-body-right">
                    <div class="ses-3-body-right-box">
                        <div class="ses-3-body-right-top">
                            <?php 
                                if ( !empty($fields['how_work_sub_title_right']) ) {
                            ?>
                            <h3 class="ses-3-body-right-top-title">
                                <?php echo $fields['how_work_sub_title_right']; ?>
                            </h3>
                            <?php 
                                }
                            ?>
                            <div class="ses-3-body-right-top-weather">11 °С</div>
                        </div>
                        <div class="ses-3-body-right-body">
                            <div class="ses-3-body-right-body-item">
                                <div class="ses-3-body-right-body-item-icon ses-3-body-right-body-item-icon-1"></div>
                                <div class="ses-3-body-right-body-value">19.95</div>
                               <div class="ses-3-body-right-body-param">кВт</div>
                            </div>
                            <div class="ses-3-body-right-body-item">
                                <div class="ses-3-body-right-body-item-icon ses-3-body-right-body-item-icon-2"></div>
                                <div class="ses-3-body-right-body-value">100</div>
                               <div class="ses-3-body-right-body-param">кВт</div>
                            </div>
                            <div class="ses-3-body-right-body-item">
                                <div class="ses-3-body-right-body-item-icon ses-3-body-right-body-item-icon-3"></div>
                                <div class="ses-3-body-right-body-value">81.05</div>
                               <div class="ses-3-body-right-body-param">кВт</div>
                            </div>
                        </div>
                        <div class="ses-3-body-bottom">
                            <div class="ses-3-body-bottom-left">
                                <?php 
                                    if ( !empty($fields['how_work_right_text_bottom_1']) ) {
                                ?>
                                <h3 class="ses-3-body-bottom-title">
                                    <?php echo $fields['how_work_right_text_bottom_1']; ?>
                                </h3>
                                <?php 
                                    }
                                ?>
                                <div class="ses-3-body-bottom-value"><strong>3.25</strong> кВт</div>
                            </div>
                            <div class="ses-3-body-bottom-right">
                                <?php 
                                    if ( !empty($fields['how_work_right_text_bottom_2']) ) {
                                ?>
                                    <div class="ses-3-body-bottom-title">
                                        <?php echo $fields['how_work_right_text_bottom_2']; ?>
                                    </div>
                                <?php 
                                    }
                                ?>
                                <div class="ses-3-body-bottom-value"><strong>3.25</strong> кВт</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    get_template_part('parts/ses-4-calc');
    get_template_part('parts/portfolio', '', ['last' => true]);
    get_template_part('parts/seo');

echo get_footer();
?>