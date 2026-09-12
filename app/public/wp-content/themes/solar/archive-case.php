<?php
    get_header();
    $fields_option = get_fields('option');
    $fields_main = get_fields(PAGE_ID_HOME);
?>

    <div class="case-home">
       <div class="wrapper">
            <div class="m-2-top">
                <?php 
                    if ( !empty($fields_main['arch_case_title']) ) {
                ?>
                    <h1 class="m-2-top-left">
                        <?php echo $fields_main['arch_case_title']; ?>
                    </h1>
                <?php 
                    }
                    if ( !empty($fields_main['arch_case_text']) ) {
                ?>
                    <div class="m-2-top-right">
                        <?php echo $fields_main['arch_case_text']; ?>
                    </div>
                <?php 
                    }
                ?>
            </div>
            <div class="cases-filter">
                <div class="cases-filter-item active">
                    <?php 
                        if ( !empty( $fields_main['arch_case_tab_all_icon'] ) ) {
                            echo wp_get_attachment_image( $fields_main['arch_case_tab_all_icon'], 'thumbnail' );
                        }
                        if ( !empty($fields_main['arch_case_tab_all']) ) {
                            echo $fields_main['arch_case_tab_all'];
                        }
                    ?>
                </div>
                <?php
                $terms = get_terms([
                    'taxonomy'   => 'case_category',
                    'hide_empty' => true,
                ]);

                if ( !empty($terms) && !is_wp_error($terms) ) :
                    foreach ($terms as $term) :

                        $icon_id = get_field('case_category_icon', 'case_category_' . $term->term_id);
                        $term_link = get_term_link($term);
                ?>
                    <a href="<?php echo esc_url($term_link); ?>" class="cases-filter-item">
                        <?php 
                            if ($icon_id) {
                                echo wp_get_attachment_image($icon_id, 'thumbnail');
                            }
                        ?>
                        <?php echo esc_html($term->name); ?>
                    </a>
                <?php
                    endforeach;
                endif;
                ?>
            </div>

            <div class="cases-list">
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part('parts/cases-card'); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <div class="main-pagination">
                <?php
                echo paginate_links([
                    'total'   => $wp_query->max_num_pages,
                    'current' => max(1, get_query_var('paged')),
                    'prev_text' => '',
                    'next_text' => '',
                    'type' => 'plain',
                ]);
                ?>
            </div>
            
       </div>
    </div>
    <div class="case-2 section">
        <div class="wrapper">
            <div class="case-2-content">
                <?php 
                    if ( !empty($fields_main['arch_case_cta_title']) ) {
                ?>
                <div class="case-2-title">
                    <?php echo $fields_main['arch_case_cta_title']; ?>
                </div>
                <?php 
                    }
                    if ( !empty($fields_main['arch_case_cta_text']) ) {
                ?>
                <div class="case-2-text">
                    <?php echo $fields_main['arch_case_cta_text']; ?>
                </div>
                <?php 
                    }
                    if ( !empty($fields_main['arch_case_cta_btn_text']) ) {
                ?>
                <a href="#call-back" class="case-2-btn">
                    <?php echo $fields_main['arch_case_cta_btn_text']; ?>
                </a>
                <?php 
                    }
                ?>
            </div>
        </div>
        <div class="case-2-image">
            <?php 
            $image_case_2_cta_size = 'large';
            if(wp_is_mobile()){
                $image_case_2_cta_size = 'medium';
            }

            if ( !empty( $fields_main['arch_case_cta_image'] ) ) {
                echo wp_get_attachment_image( $fields_main['arch_case_cta_image'], $image_case_2_cta_size, null, ['class' => ''] );
            }
            ?>
        </div>
    </div>
    <?php 
        get_template_part('parts/m-2-services');
    ?>
    <div class="case-3 section">
        <div class="wrapper">
            <div class="m-2-top">
                <?php 
                    if ( !empty($fields_main['arch_case_sets_title']) ) {
                ?>
                <div class="m-2-top-left">
                    <?php echo $fields_main['arch_case_sets_title']; ?>
                </div>
                <?php 
                    }
                    if ( !empty($fields_main['arch_case_sets_text']) ) {
                ?>
                <div class="m-2-top-right">
                    <?php echo $fields_main['arch_case_sets_text']; ?>
                </div>
                <?php 
                    }
                ?>
            </div>
            <div class="case-3-list">
                <?php 
                if(!empty($fields_main['arch_case_sets_add'])) {
                    foreach($fields_main['arch_case_sets_add'] as $row) {
                        ?>
                <div class="case-3-item">
                    <div class="case-3-item-image">
                        <?php 
                        $case_3_image_size = 'medium';

                        if ( !empty( $row['arch_case_sets_add_image'] ) ) {
                            echo wp_get_attachment_image( $row['arch_case_sets_add_image'], $case_3_image_size, null, ['class' => ''] );
                        }
                        ?>
                    </div>
                    <div class="case-3-item-content">
                        <?php 
                            if ( !empty($row['arch_case_sets_add_title']) ) {
                        ?>
                        <div class="case-3-item-title">
                            <?php echo $row['arch_case_sets_add_title']; ?>
                        </div>
                        <?php 
                            }
                            if ( !empty($row['arch_case_sets_add_btn_link']) && !empty($fields_main['arch_case_sets_btn_text']) ) {
                        ?>
                        <a href="<?php echo $row['arch_case_sets_add_btn_link']; ?>" class="case-3-item-btn" data-action="<?php if ( !empty($row['arch_case_sets_add_title']) ) { echo $row['arch_case_sets_add_title']; } ?>">
                            <?php echo $fields_main['arch_case_sets_btn_text']; ?>
                        </a>
                        <?php 
                            }
                        ?>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <?php 
        get_template_part('parts/seb-3-offer');
    ?>

    <div class="case-4 section">
        <div class="wrapper">
            <div class="case-4-list">
                <?php 
                if(!empty($fields_main['arch_insta_add'])) {
                    foreach($fields_main['arch_insta_add'] as $row) {
                        ?>
                <div class="case-4-item">
                    <?php 
                    if ( !empty( $row['arch_insta_add_image'] ) ) {
                        echo wp_get_attachment_image( $row['arch_insta_add_image'], 'medium', null, ['class' => ''] );
                    }
                        if ( !empty($fields_main['arch_insta_btn_text']) && !empty($fields_option['link_instagram']) ) {
                    ?>
                    <a href="<?php echo $fields_option['link_instagram']; ?>" class="case-4-item-btn" target="_blank">
                        <?php echo $fields_main['arch_insta_btn_text']; ?>
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

<?php 
echo get_footer();
?>