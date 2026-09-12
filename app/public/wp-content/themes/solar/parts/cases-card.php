<?php
    $id = get_the_ID();
    $fields = get_fields($id);
    $fields_main = get_fields(PAGE_ID_HOME);
?>

<div class="cases-item">
    <a href="<?php echo get_permalink($id);?>" class="cases-item--permalink"></a>
    <div class="cases-item-image">
        <?php 
            echo the_post_thumbnail('full');
        ?>
    </div>
    <h3 class="cases-item-title"><?php the_title(); ?></h3>
    <div class="cases-item-options">
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
        ?>
    </div>
</div>