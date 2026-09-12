<?php
get_header();
$fields = get_fields();
$fields_option = get_fields('option');
$fields_main = get_fields(PAGE_ID_HOME);
?>
<?php
    get_header();
    $fields = get_fields();
    $fields_option = get_fields('option');
    $fields_main = get_fields(PAGE_ID_HOME);
    $lang = pll_current_language();

    if(( (function_exists('is_cart') && is_cart()))){
       ?>
            <div class="defpage">
                <div class="wrapper">
                    <h1 class="fepage-title">
                        <?php the_title(); ?>
                    </h1>
                    <div class="fepage-text">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
       <?php
    } else {
?>

    <div class="sing-home">
        <div class="wrapper">
            <h1 class="sing-title"><?php the_title(); ?></h1>
            <div class="main-text">
                <?php 
                    the_content();
                ?>     
            </div>
        </div>
    </div>
<?php 
    }
echo get_footer();
?>