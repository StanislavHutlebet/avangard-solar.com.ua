<?php 
    $fields_option = get_fields('option');
    $fields = get_fields(PAGE_ID_HOME);
	$fields_page = get_fields();

	
	if(!empty($fields_page['portfolio_best_list_ids'])){
		$case_list = $fields_page['portfolio_best_list_ids'];
	} else {
		$case_list = $fields['portfolio_best_list_ids'];
	}
    $last = $args['last'];
?>

<div class="m-3 <?php if(!empty($last)){echo 'm-3-last'; } ?> section">
    <div class="wrapper">
        <div class="m-2-top">
            <?php 
                if ( !empty($fields['portfolio_best_title']) ) {
            ?>
                <div class="m-2-top-left">
                    <?php echo $fields['portfolio_best_title']; ?>
                </div>
            <?php 
                }
                if ( !empty($fields['portfolio_best_text']) ) {
            ?>
                <div class="m-2-top-right">
                    <?php echo $fields['portfolio_best_text']; ?>
                </div>
            <?php 
                }
            ?>
        </div>
        <div class="m-3-body">
            <?php 
            if(!empty($case_list)) {
                foreach($case_list as $item) {
					 if ( !empty($fields['portfolio_best_btn_watch_work']) ) {
                    $post_id = $item->ID;
                    ?>
                <a href="<?php echo get_permalink($post_id); ?>" class="m-3-item">
                    <div class="m-3-item-image">
                        <?php 
                            $image_previe = 'large';
                            if(wp_is_mobile()){
                                $image_previe = 'medium';
                            }
                            echo get_the_post_thumbnail($post_id, $image_previe); 
                        ?>
                    </div>
                    <div class="m-3-item-bottom">
                        <h3 class="m-3-item-title"><?php echo get_the_title($post_id) ?></h3>
                        <div class="m-3-item-btn">
                            <?php echo $fields['portfolio_best_btn_watch_work']; ?>
                        </div>
                    </div>
                </a>
            <?php
                            }
                }
            }
            ?>
        </div>
        <?php 
            if ( !empty($fields['portfolio_best_btn_text']) && !empty($fields['portfolio_best_btn_link']) ) {
        ?>
            <a href="<?php echo $fields['portfolio_best_btn_link']; ?>" class="main-btn">
                <?php echo $fields['portfolio_best_btn_text']; ?>
            </a>
        <?php 
            }
        ?>
    </div>
</div>