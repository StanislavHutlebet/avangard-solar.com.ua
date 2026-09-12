<?php
    get_header();
    $fields = get_fields();
    $fields_option = get_fields('option');
    $fields_main = get_fields(PAGE_ID_HOME);
?>

    <div class="sic-home">
        <div class="wrapper">
            <div class="m-2-top">
                <h1 class="m-2-top-left"><?php the_title(); ?></h1>
            </div>
            <div class="sic-home-slider-wrapper">
                <div class="sic-home-slider-big">
                    <?php 
                    if(!empty($fields['case_gallery_image'])) {
                        foreach($fields['case_gallery_image'] as $key => $row) {
                            ?>
                    <div class="sic-home-slider-big-item">
                        <?php 
                        $big_slider_image_size = 'full';
                        if(wp_is_mobile()){
                            $big_slider_image_size = 'medium';
                        }
                        if ( !empty( $row['case_gallery_image_item'] ) ) {
                            if($key == 0){
                                echo wp_get_attachment_image( $row['case_gallery_image_item'], $big_slider_image_size, null, ['fetchpriority' => 'high'] );
                            }else {
                                echo wp_get_attachment_image( $row['case_gallery_image_item'], $big_slider_image_size, null, ['class' => ''] );
                            }
                        }
                        ?>
                    </div>
                    <?php
                        }
                    }
                    ?>
                </div>
                <div class="sic-home-slider-small">
                    <?php 
                    if(!empty($fields['case_gallery_image'])) {
                        foreach($fields['case_gallery_image'] as  $row) {
                            ?>
                    <div class="sic-home-slider-small-item">
                        <div class="sic-home-slider-small-item-wrap">
                            <?php 
                            $big_slider_image_size = 'thumbnail';
                            if ( !empty( $row['case_gallery_image_item'] ) ) {
                                echo wp_get_attachment_image( $row['case_gallery_image_item'], $big_slider_image_size, null, ['class' => ''] );
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
            <div class="sic-home-body">
                <div class="sic-home-left">
                    <div class="main-text">
                        <?php 
                            if ( !empty($fields['case_content']) ) {
                                echo $fields['case_content'];
                            }
                        ?>
                    </div>
                </div>
                <div class="sic-home-right">
                    <?php 
                        if ( !empty($fields_main['case_sing_1']) ) {
                    ?>
                    <div class="sic-home-right-title">
                        <?php echo $fields_main['case_sing_1']; ?>
                    </div>
                    <?php 
                        }
                    ?>
                    <div class="sic-home-right-table">
                        <?php 
                            if ( !empty($fields['case_system_type']) ) {
                        ?>
                        <div class="sic-home-right-table-row">
                            <?php 
                                if ( !empty($fields_main['case_sing_2']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields_main['case_sing_2']; ?>
                            </div>
                            <?php 
                                }
                                if ( !empty($fields['case_system_type']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields['case_system_type']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                        </div>
                        <?php 
                            }
                            if ( !empty($fields['case_system_power']) ) {
                        ?>
                        <div class="sic-home-right-table-row">
                            <?php 
                                if ( !empty($fields_main['case_sing_3']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields_main['case_sing_3']; ?>
                            </div>
                            <?php 
                                }
                                if ( !empty($fields['case_system_power']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields['case_system_power']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                        </div>
                        <?php 
                            }
                            if ( !empty($fields['case_system_count']) ) {
                        ?>
                        <div class="sic-home-right-table-row">
                            <?php 
                                if ( !empty($fields_main['case_sing_4']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields_main['case_sing_4']; ?>
                            </div>
                            <?php 
                                }
                                if ( !empty($fields['case_system_count']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields['case_system_count']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                        </div>
                        <?php 
                            }
                            if ( !empty($fields['case_system_money_saving']) ) {
                        ?>
                        <div class="sic-home-right-table-row">
                            <?php 
                                if ( !empty($fields_main['case_sing_5']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields_main['case_sing_5']; ?>
                            </div>
                            <?php 
                                }
                                if ( !empty($fields['case_system_money_saving']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields['case_system_money_saving']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                        </div>
                        <?php 
                            }
						
						
							if ( !empty($fields['case_system_inverter']) ) {
                        ?>
                        <div class="sic-home-right-table-row">
                            <?php 
                                if ( !empty($fields_main['case_sing_7']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields_main['case_sing_7']; ?>
                            </div>
                            <?php 
                                }
                                if ( !empty($fields['case_system_inverter']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields['case_system_inverter']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                        </div>
                        <?php 
                            }
							if ( !empty($fields['case_system_panels_brand']) ) {
                        ?>
                        <div class="sic-home-right-table-row">
                            <?php 
                                if ( !empty($fields_main['case_sing_8']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields_main['case_sing_8']; ?>
                            </div>
                            <?php 
                                }
                                if ( !empty($fields['case_system_panels_brand']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields['case_system_panels_brand']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                        </div>
                        <?php 
                            }
							if ( !empty($fields['case_system_battery']) ) {
                        ?>
                        <div class="sic-home-right-table-row">
                            <?php 
                                if ( !empty($fields_main['case_sing_9']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields_main['case_sing_9']; ?>
                            </div>
                            <?php 
                                }
                                if ( !empty($fields['case_system_battery']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields['case_system_battery']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                        </div>
                        <?php 
                            }
							if ( !empty($fields['case_system_battery_capacity']) ) {
                        ?>
                        <div class="sic-home-right-table-row">
                            <?php 
                                if ( !empty($fields_main['case_sing_10']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields_main['case_sing_10']; ?>
                            </div>
                            <?php 
                                }
                                if ( !empty($fields['case_system_battery_capacity']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields['case_system_battery_capacity']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                        </div>
                        <?php 
                            }
							if ( !empty($fields['case_system_mount_type']) ) {
                        ?>
                        <div class="sic-home-right-table-row">
                            <?php 
                                if ( !empty($fields_main['case_sing_11']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields_main['case_sing_11']; ?>
                            </div>
                            <?php 
                                }
                                if ( !empty($fields['case_system_mount_type']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields['case_system_mount_type']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                        </div>
                        <?php 
                            }
							if ( !empty($fields['case_system_autonomy']) ) {
                        ?>
                        <div class="sic-home-right-table-row">
                            <?php 
                                if ( !empty($fields_main['case_sing_12']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields_main['case_sing_12']; ?>
                            </div>
                            <?php 
                                }
                                if ( !empty($fields['case_system_autonomy']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields['case_system_autonomy']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                        </div>
                        <?php 
                            }
							if ( !empty($fields['case_system_generator']) ) {
                        ?>
                        <div class="sic-home-right-table-row">
                            <?php 
                                if ( !empty($fields_main['case_sing_13']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields_main['case_sing_13']; ?>
                            </div>
                            <?php 
                                }
                                if ( !empty($fields['case_system_generator']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields['case_system_generator']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                        </div>
                        <?php 
                            }
							if ( !empty($fields['case_system_install_time']) ) {
                        ?>
                        <div class="sic-home-right-table-row">
                            <?php 
                                if ( !empty($fields_main['case_sing_14']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields_main['case_sing_14']; ?>
                            </div>
                            <?php 
                                }
                                if ( !empty($fields['case_system_install_time']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields['case_system_install_time']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                        </div>
                        <?php 
                            }
							if ( !empty($fields['case_system_region']) ) {
                        ?>
                        <div class="sic-home-right-table-row">
                            <?php 
                                if ( !empty($fields_main['case_sing_15']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields_main['case_sing_15']; ?>
                            </div>
                            <?php 
                                }
                                if ( !empty($fields['case_system_region']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields['case_system_region']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                        </div>
                        <?php 
                            }
							if ( !empty($fields['case_system_payback']) ) {
                        ?>
                        <div class="sic-home-right-table-row">
                            <?php 
                                if ( !empty($fields_main['case_sing_16']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields_main['case_sing_16']; ?>
                            </div>
                            <?php 
                                }
                                if ( !empty($fields['case_system_payback']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields['case_system_payback']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                        </div>
                        <?php 
                            }
							if ( !empty($fields['case_system_connected']) ) {
                        ?>
                        <div class="sic-home-right-table-row">
                            <?php 
                                if ( !empty($fields_main['case_sing_17']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields_main['case_sing_17']; ?>
                            </div>
                            <?php 
                                }
                                if ( !empty($fields['case_system_connected']) ) {
                            ?>
                            <div class="sic-home-right-table-col">
                                <?php echo $fields['case_system_connected']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                        </div>
                        <?php 
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="sic-home-sub-title">
                <div class="m-2-top">
                    <?php 
                        if ( !empty($fields_main['case_sing_6']) ) {
                    ?>
                    <h2 class="m-2-top-left">
                        <?php echo $fields_main['case_sing_6']; ?>
                    </h2>
                    <?php 
                        }
                    ?>
                </div>
            </div>

            <div class="cases-list">
                <?php
                $current_id = get_the_ID();

                $args = [
                    'post_type'      => 'case',
                    'posts_per_page' => 2,
                    'post__not_in'   => [$current_id],
                    'orderby'        => 'rand',
                ];

                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        get_template_part('parts/cases-card');
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </div>




<?php 
echo get_footer();
?>