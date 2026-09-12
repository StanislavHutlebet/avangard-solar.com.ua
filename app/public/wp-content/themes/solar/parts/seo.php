<?php 
    $fields = get_fields(get_the_ID());
    $fields_main = get_fields(PAGE_ID_HOME);

?>
<div class="m-7 section">
    <div class="wrapper">
        <div class="m-7-box">
            <?php 
                if ( !empty($fields['seo_text']) ) {
            ?>
                <div class="main-text">
                    <?php echo $fields['seo_text']; ?>
                </div>
            <?php 
                }
                if ( !empty($fields_main['seo_btn_read_more']) && !empty($fields_main['seo_btn_hide']) ) {
            ?>
            <div class="m-7-btn" data-open="<?php echo $fields_main['seo_btn_read_more']; ?>" data-hide="<?php echo $fields_main['seo_btn_hide']; ?>"><?php echo $fields_main['seo_btn_read_more']; ?></div>
            <?php 
                }
            ?>
        </div>
    </div>
</div>