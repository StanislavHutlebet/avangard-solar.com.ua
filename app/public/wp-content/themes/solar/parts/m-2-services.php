<?php 
    $fields = get_fields(PAGE_ID_HOME);
?>
<div class="m-2 section">
    <div class="anhor" id="services"></div>
        <div class="wrapper">
            <div class="m-2-top">
                <?php 
                    if ( !empty($fields['what_we_do_title']) ) {
                ?>
                <div class="m-2-top-left">
                    <?php echo $fields['what_we_do_title']; ?>
                </div>
                <?php 
                    }
                    if ( !empty($fields['what_we_do_text']) ) {
                ?>
                    <div class="m-2-top-right">
                        <?php echo $fields['what_we_do_text']; ?>
                    </div>
                <?php 
                    }
                ?>
            </div>
            <div class="m-2-body">
                <div class="m-2-body-left">
                    <?php 
                    if(!empty($fields['what_we_do_add'])) {
                        foreach($fields['what_we_do_add'] as $key => $row) {
                            ?>
                    <div class="m-2-tab <?php if($key == 0){
                        echo 'active';
                    } ?>" data-tab="<?php echo $key; ?>">
                        <div class="m-2-tab-icon">
                            <?php 
                            if ( !empty( $row['what_we_do_add_icon'] ) ) {
                                echo wp_get_attachment_image( $row['what_we_do_add_icon'], 'medium' );
                            }
                            ?>
                        </div>
                        <?php 
                            if ( !empty($row['what_we_do_add_title']) ) {
                        ?>
                            <div class="m-2-tab-text">
                                <?php echo $row['what_we_do_add_title']; ?>
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
                <div class="m-2-body-right">
                    <?php 
                    if(!empty($fields['what_we_do_add'])) {
                        foreach($fields['what_we_do_add'] as $key => $row) {
                            ?>
                    <div class="m-2-block <?php if($key == 0){
                        echo 'active';
                    } ?>" data-tab="<?php echo $key; ?>">
                        <?php 
                            if ( !empty($row['what_we_do_add_title']) ) {
                        ?>
                        <h3 class="m-2-block-title">
                            <?php echo $row['what_we_do_add_title']; ?>
                        </h3>
                        <?php 
                            }
                            if ( !empty($row['what_we_do_add_text']) ) {
                        ?>
                        <div class="m-2-block-text">
                            <?php echo $row['what_we_do_add_text']; ?>
                        </div>
                        <?php 
                            }
                            if ( !empty($row['what_we_do_add_btn_link']) && !empty($fields['what_we_do_btn_text']) ) {
                        ?>
                        <a href="<?php echo $row['what_we_do_add_btn_link']; ?>" class="main-btn">
                            <?php echo $fields['what_we_do_btn_text']; ?>
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
    </div>