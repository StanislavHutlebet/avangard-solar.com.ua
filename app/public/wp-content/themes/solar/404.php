<?php
get_header();
$fields = get_fields(PAGE_ID_HOME);
?>

    <div class="page-404">
        <div class="wrapper">
            <div class="page-404-image-top">
                <?php 
                if ( !empty( $fields['page_404_image'] ) ) {
                    echo wp_get_attachment_image( $fields['page_404_image'], 'large', null, ['class' => ''] );
                }
                ?>
            </div>
            <?php 
                if ( !empty($fields['page_404_title']) ) {
            ?>
            <h1 class="page-404-title">
                <?php echo $fields['page_404_title']; ?>
            </h1>
            <?php 
                }
                if ( !empty($fields['page_404_text']) ) {
            ?>
            <div class="page-404-text">
                <?php echo $fields['page_404_text']; ?>
            </div>
            <?php 
                }
                if ( !empty($fields['page_404_btn_text']) ) {
            ?>
            <a href="<?php echo get_home_url();?>" class="page-404-btn">
                <?php echo $fields['page_404_btn_text']; ?>
            </a>
            <?php 
                }
            ?>
        </div>
    </div>

<?php 
echo get_footer();
?>