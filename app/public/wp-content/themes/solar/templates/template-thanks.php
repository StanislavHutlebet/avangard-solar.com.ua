<?php
    /*
    Template Name: Thanks
    */
get_header();
$fields = get_fields();
?>

    <div class="thanks-page">
        <div class="wrapper">
            <?php 
                if ( !empty($fields['thanks_title']) ) {
            ?>
            <h1 class="thanks-page-title">
                <?php echo $fields['thanks_title']; ?>
            </h1>
            <?php 
                }
                if ( !empty($fields['thanks_text']) ) {
            ?>
            <div class="thanks-page-text">
                <?php echo $fields['thanks_text']; ?>
            </div>
            <?php 
                }
                if ( !empty($fields['thanks_btn_text']) ) {
            ?>
            <a href="<?php echo get_home_url();?>" class="thanks-page-btn main-btn">
                <?php echo $fields['thanks_btn_text']; ?>
            </a>
            <?php 
                }
            ?>
        </div>
    </div>

<?php
echo get_footer();
?>