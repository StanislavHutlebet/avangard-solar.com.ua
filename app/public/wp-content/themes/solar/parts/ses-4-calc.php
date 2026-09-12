<?php 
    $fields = get_fields(PAGE_ID_HOME);
?>
<div class="ses-4 section">
    <div class="wrapper">
        <div class="m-2-top">
            <?php 
                if ( !empty($fields['calc_panel_title']) ) {
            ?>
            <div class="m-2-top-left">
                <?php echo $fields['calc_panel_title']; ?>
            </div>
            <?php 
                }
                if ( !empty($fields['calc_panel_text']) ) {
            ?>
            <div class="m-2-top-right">
                <?php echo $fields['calc_panel_text']; ?>
            </div>
            <?php 
                }
            ?>
        </div>
        <div class="ses-4-flex">
            <div class="ses-4-left">
                <?php 
                    if ( !empty($fields['calc_panel_sub_title_left']) ) {
                ?>
                    <h2 class="ses-4-left-title">
                        <?php echo $fields['calc_panel_sub_title_left']; ?>
                    </h2>
                <?php 
                    }
                ?>
                <div class="ses-4-item-calc">
                    <div class="ses-4-item-row">
                        <?php 
                            if ( !empty($fields['calc_panel_label_1']) ) {
                        ?>
                        <div class="ses-4-item-row-title">
                            <?php echo $fields['calc_panel_label_1']; ?>
                        </div>
                        <?php 
                            }
                        ?>
                        <input type="text" class="ses-4-potreblenie" placeholder="3000">
                    </div>
                    <div class="ses-4-item-row">
                        <?php 
                            if ( !empty($fields['calc_panel_label_2']) ) {
                        ?>
                        <div class="ses-4-item-row-title">
                            <?php echo $fields['calc_panel_label_2']; ?>
                        </div>
                        <?php 
                            }
                        ?>
                        <input type="text" class="ses-4-tarif" placeholder="10">
                    </div>
                    <div class="ses-4-item-row">
                        
                        <div class="ses-4-item-row-title"> 
                            <?php 
                                if ( !empty($fields['calc_panel_label_3']) ) {
                                     echo $fields['calc_panel_label_3']; 
                                }
                            ?>    
                        <div class="main-info">
                            <div class="main-info-icon"></div>
                            <?php 
                                if ( !empty($fields['calc_panel_label_4_more_info_text']) ) {
                            ?>
                            <div class="main-info-box">
                                <?php echo $fields['calc_panel_label_4_more_info_text']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                        </div></div>
                        <div class="ses-4-item-radio">
                            <div class="ses-item-4-radio-item" data-type="a">
                                <div class="ses-item-4-radio-item-value"></div>
                                <?php 
                                    if ( !empty($fields['calc_panel_group_a']) ) {
                                ?>
                                <div class="ses-item-4-radio-item-text">
                                    <?php echo $fields['calc_panel_group_a']; ?>
                                </div>
                                <?php 
                                    }
                                ?>
                            </div>
                            <div class="ses-item-4-radio-item active" data-type="b">
                                <div class="ses-item-4-radio-item-value"></div>
                                <?php 
                                    if ( !empty($fields['calc_panel_group_b']) ) {
                                ?>
                                <div class="ses-item-4-radio-item-text">
                                    <?php echo $fields['calc_panel_group_b']; ?>
                                </div>
                                <?php 
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="ses-4-info-resalt">
                        <div class="ses-4-info-resalt-row">
                            <?php 
                                if ( !empty($fields['calc_panel_result_param_1']) ) {
                            ?>
                            <div class="ses-4-info-resalt-row-title">
                                <?php echo $fields['calc_panel_result_param_1']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                            <div class="ses-4-info-resalt-row-value ses-4-info-resalt-row-value--1" data-unit="кВт">0 кВт</div>
                        </div>
                        <div class="ses-4-info-resalt-row">
                            <?php 
                                if ( !empty($fields['calc_panel_result_param_2']) ) {
                            ?>
                            <div class="ses-4-info-resalt-row-title">
                                <?php echo $fields['calc_panel_result_param_2']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                            <div class="ses-4-info-resalt-row-value ses-4-info-resalt-row-value--2"  data-unit="грн">0 грн</div>
                        </div>
                        <div class="ses-4-info-resalt-row">
                            <?php 
                                if ( !empty($fields['calc_panel_result_param_3']) ) {
                            ?>
                            <div class="ses-4-info-resalt-row-title">
                                <?php echo $fields['calc_panel_result_param_3']; ?>
                            </div>
                            <?php 
                                }
                            ?>
                            <div class="ses-4-info-resalt-row-value ses-4-info-resalt-row-value--3 ses-4-info-resalt-row-value--payback" data-payback-a="<?php 
                                    if ( !empty($fields['calc_panel_result_param_3_result_version_1']) ) {
                                 echo $fields['calc_panel_result_param_3_result_version_1'];
                                    }
                                ?>" data-payback-b="<?php 
                                    if ( !empty($fields['calc_panel_result_param_3_result_version_2']) ) {
                                 echo $fields['calc_panel_result_param_3_result_version_2'];
                                    }
                                ?>">--</div>
                        </div>
                    </div>
                    <?php 
                        if ( !empty($fields['calc_panel_button']) ) {
                    ?>
                    <button class="ses-4-btn-submit">
                        <?php echo $fields['calc_panel_button']; ?>
                    </button>
                    <?php 
                        }
                    ?>
                </div>
            </div>
            <div class="ses-4-right">
                <?php 
                    if ( !empty($fields['main_field_31']) ) {
                ?>
                <div class="ses-4-right-title">
                    <?php echo $fields['main_field_31']; ?>
                </div>
                <?php 
                    }
                ?>
                <div class="ses-4-right-list">
                    
                </div>
            </div>
        </div>
    </div>
</div>