<?php 
    $fields = get_fields(PAGE_ID_HOME);
?>
<div class="seh-2 section">
        <div class="wrapper">
            <div class="m-2-top">
                <?php 
                    if ( !empty($fields['calc_adapt_title']) ) {
                ?>
                <div class="m-2-top-left">
                    <?php echo $fields['calc_adapt_title']; ?>
                </div>
                <?php 
                    }
                    if ( !empty($fields['calc_adapt_text']) ) {
                ?>
                <div class="m-2-top-right">
                    <?php echo $fields['calc_adapt_text']; ?>
                </div>
                <?php 
                    }
                ?>
            </div>
            <div class="seh-2-body">
                <div class="seh-2-left">
                    <?php 
                        if ( !empty($fields['calc_adapt_sub_title']) ) {
                    ?>
                    <div class="seh-2-sub-title">
                        <?php echo $fields['calc_adapt_sub_title']; ?>
                    </div>
                    <?php 
                        }
                    ?>
                    <div class="seh-2-line-value">
                        <div class="seh-2-line-value-active"></div>
                        <div class="seh-2-line-value-toggle"></div>
                    </div>
                    <div class="seh-2-left-info"><?php 
                            if ( !empty($fields['calc_adapt_text_1']) ) {
                                echo $fields['calc_adapt_text_1'];
                            }
                        ?> <span class="seh-2-line-value-text">20 кВт</span> <?php 
                            if ( !empty($fields['calc_adapt_text_2']) ) {
                                echo $fields['calc_adapt_text_2'];
                            }
                        ?></div>
                    <?php 
                        if ( !empty($fields['calc_adapt_sub_title_2']) ) {
                    ?>
                    <div class="seh-2-sub-title">
                        <?php echo $fields['calc_adapt_sub_title_2']; ?>
                    </div>
                    <?php 
                        }
                    ?>
                    <div class="seh-input-price-kvt-wrap">
                        <input type="text" class="seh-input-price-kvt" value="1200">
                        <div class="seh-input-price-kvt-eq"><?php 
                                if ( !empty($fields['calc_adapt_text_3']) ) {
                                    echo $fields['calc_adapt_text_3'];
                                }
                            ?></div>
                    </div>
                    <?php 
                        if ( !empty($fields['calc_adapt_text_4']) ) {
                    ?>
                    <div class="seh-2-left-info">
                        <?php echo $fields['calc_adapt_text_4']; ?>
                    </div>
                    <?php 
                        }
                    ?>
                    <div class="seh-2-result-block">
                        <div class="seh-2-result-row"><?php 
                                if ( !empty($fields['calc_adapt_text_5']) ) {
                                    echo $fields['calc_adapt_text_5']; 
                                }
                            ?> <span class="seh-2-result-row-1">0</span><span> кВт</span></div>
                        <div class="seh-2-result-row"><?php 
                                if ( !empty($fields['calc_adapt_text_6']) ) {
                                    echo $fields['calc_adapt_text_6']; 
                                }
                            ?> <span class="seh-2-result-row-2">0</span><span><?php 
                                if ( !empty($fields['calc_adapt_text_7']) ) {
                                    echo $fields['calc_adapt_text_7']; 
                                }
                            ?></span></div>
                        <div class="seh-2-result-row"><?php 
                                if ( !empty($fields['calc_adapt_text_8']) ) {
                                    echo $fields['calc_adapt_text_8']; 
                                }
                            ?> <span class="seh-2-result-row-2">0</span><span>%</span></div>
                        <?php 
                            if ( !empty($fields['calc_adapt_text_9']) ) {
                        ?>
                        <div class="seh-2-result-info">
                            <?php echo $fields['calc_adapt_text_9']; ?>
                        </div>
                        <?php 
                            }
                        ?>
                    </div>
                </div>
                <div class="seh-2-right">
                    <canvas id="seh-2-grafic"></canvas >
                </div>
            </div>
        </div>
    </div>