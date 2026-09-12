<?php
    get_header();
    $fields = get_fields();
    $fields_option = get_fields('option');
    $fields_main = get_fields(PAGE_ID_HOME);
    $lang = pll_current_language();
?>
<style>
	.breadcrumbw-wrapper p > *:nth-child(5),
	.breadcrumbw-wrapper p > *:nth-child(6){
			display: none;
	}
</style>
    <div class="sing-home">
        <div class="wrapper">
            <h1 class="sing-title"><?php the_title(); ?></h1>
            <?php
            $tags = get_the_terms(get_the_ID(), 'post_tag');

            if ($tags && !is_wp_error($tags)) : ?>
                <div class="sing-tag-list">
                    <?php foreach ($tags as $tag) : ?>
                        <div class="sing-tag-item">
                            <?php echo esc_html($tag->name); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="sing-main-image">
                <?php 
                if (has_post_thumbnail()) {
                    the_post_thumbnail('large');
                }
                ?>
            </div>
            <div class="main-text">
                <?php 
                    the_content();
                ?>     
            </div>
            <div class="sing-sub-title">
                <?php 
                    if ($lang == 'uk') {
                        echo 'Схожі матеріали';
                    }else {
                        echo 'Похожие материалы';
                    }
                ?>
            </div>
            <div class="blog-list">
                <?php
                $current_id = get_the_ID();

                $args = [
                    'post_type'      => 'post',
                    'posts_per_page' => 3,
                    'post__not_in'   => [$current_id],
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ];

                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    while ($query->have_posts()) : 
                        $query->the_post();
                        get_template_part('parts/blog-card');
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </div>

<?php 
echo get_footer();
?>