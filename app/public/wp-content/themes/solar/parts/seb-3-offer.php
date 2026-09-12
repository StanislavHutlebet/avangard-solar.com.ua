<?php 
    
    if(is_archive()){
        $fields = get_fields(PAGE_ID_HOME);
    }else {
        $fields = get_fields(get_the_ID());
    }
?>

<div class="seb-3 section <?php if(is_post_type_archive('case')){
    echo 'sev-3-arch-case';
} ?>">
    <?php 
        if(!is_post_type_archive('case')){
    ?>
    <div class="seb-3-bg">
        <?php 
                $seb_3_image_size = ' full';
                if(wp_is_mobile()){
                    $seb_3_image_size = 'medium';
                }
                if ( !empty( $fields['cta_image'] ) ) {
                    echo wp_get_attachment_image( $fields['cta_image'], $seb_3_image_size );
                }
        ?>
    </div>
    <?php 
        }
    ?>
    <div class="wrapper">
        <?php 
            if(is_post_type_archive('case')){
        ?>
            <div class="seb-3-archive-cases-bg">
                <!-- <a href="#" target="_blank"></a> -->
                <?php 
                    $seb_3_image_size = ' full';
                    if(wp_is_mobile()){
                        $seb_3_image_size = 'medium';
                    }
                    if ( !empty( $fields['cta_image'] ) ) {
                        echo wp_get_attachment_image( $fields['cta_image'], $seb_3_image_size );
                    }
                ?>
            </div>
        <?php
            }
        ?>
        <div class="seb-3-form-wrap">
            <?php 
                if ( !empty($fields['cta_title']) ) {
            ?>
            <h2 class="seb-3-form-title">
                <?php echo $fields['cta_title']; ?>
            </h2>
            <?php 
                }
                if ( !empty($fields['cta_text']) ) {
            ?>
            <div class="seb-3-text">
                <?php echo $fields['cta_text']; ?>
            </div>
            <?php 
                }
            ?>
            <div class="seb-3-form">
                <?php 
                    if ( !empty($fields['cta_form']) ) {
                        echo do_shortcode($fields['cta_form']); 
                    }
                ?>
            </div>
        </div>
    </div>
</div>