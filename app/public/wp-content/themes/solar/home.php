<?php
    get_header();
    $fields_option = get_fields('option');
    $fields = get_fields(PAGE_ID_HOME);
    $lang = pll_current_language();

    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

    $args = [
        'post_type'      => 'post',
        'posts_per_page' => 12,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];
    $blog_query = new WP_Query($args);


?>

    <div class="blog-home">
        <div class="wrapper">
            <div class="m-2-top">
                <?php 
                    if ( !empty($fields['blog_archive_title']) ) {
                ?>
                <h1 class="m-2-top-left">
                    <?php echo $fields['blog_archive_title']; ?>
                </h1>
                <?php 
                    }
                    if ( !empty($fields['blog_archive_text']) ) {
                ?>
                <div class="m-2-top-right">
                    <?php echo $fields['blog_archive_text']; ?>
                </div>
                <?php 
                    }
                ?>
            </div>
            
            <div class="blog-home-body">
                <div class="blog-home-body-left">
                    <div class="blog-home-body-left-title"><?php 
                    if ($lang == 'uk') {
                        echo 'Фільтри';
                    }else {
                        echo 'Фильтры';
                    }
                ?></div>

                    <div class="blog-home-body-sort-category select-filter-style">
                        <select>
                            <option value=""><?php 
                    if ($lang == 'uk') {
                        echo 'Усі';
                    }else {
                        echo 'Все';
                    }
                ?></option>

                            <?php 
                            $categories = get_categories([
                                'orderby' => 'name',
                                'order'   => 'ASC',
                            ]);

                            foreach ($categories as $cat) : ?>
                                <option value="<?php echo esc_attr($cat->term_id); ?>">
                                    <?php echo esc_html($cat->name); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="blog-home-body-left-sub-title"><?php 
                    if ($lang == 'uk') {
                        echo 'Теги';
                    }else {
                        echo 'Теги';
                    }
                ?></div>
                    <div class="blog-home-body-left-tag-list sort-style-checkbox">
                        <?php 
                        $all_posts_count = wp_count_posts('post')->publish;
                        ?>
                        <div class="blog-home-body-left-tag-item sort-style-checkbox-item" data-tag="">
                            <?php 
                            if ($lang == 'uk') {
                                echo 'Усі теги';
                            }else {
                                echo 'Все теги';
                            }
                        ?> <div class="count-items"><?php echo $all_posts_count; ?></div>
                        </div>

                        <?php
                        $tags = get_terms([
                            'taxonomy'   => 'post_tag',
                            'hide_empty' => true,
                            'orderby'    => 'name',
                            'order'      => 'ASC',
                        ]);

                        if (!empty($tags) && !is_wp_error($tags)) :
                            foreach ($tags as $tag) : ?>
                                <div class="blog-home-body-left-tag-item sort-style-checkbox-item" data-tag="<?php echo esc_attr($tag->term_id); ?>">
                                    <?php echo esc_html($tag->name); ?>
                                    <div class="count-items"><?php echo esc_html($tag->count); ?></div>
                                </div>
                            <?php endforeach;
                        endif;
                        ?>
                    </div>
                </div>
                <div class="blog-home-top">
                    <div class="blog-home-search-box">
                        <input type="text" placeholder="<?php 
                        if ($lang == 'uk') {
                            echo 'Пошук';
                        }else {
                            echo 'Поиск';
                        }
                    ?>">
                        <button class="blog-home-search-action"></button>
                    </div>
                    <button class="blog-home-clear-filter"><?php 
                        if ($lang == 'uk') {
                            echo 'Скинути фільтри';
                        }else {
                            echo 'Сбросить фильтр';
                        }
                    ?></button>
                </div>
                <div class="blog-home-body-right">
                    <div class="blog-home-body-right-top">
                        <div class="blog-home-body-right-count-post">
                            <span>
                                <?php echo $blog_query->found_posts; ?>
                            </span> <?php 
                            if ($lang == 'uk') {
                                echo 'матеріалів';
                            }else {
                                echo 'Материалов';
                            }
                        ?>
                        </div>
                    </div>

                    <div class="blog-list">
                        <?php if ($blog_query->have_posts()) : ?>
                            <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                                <?php get_template_part('parts/blog-card'); ?>
                            <?php endwhile; ?>
                        <?php  endif; ?>
                    </div>
                    <div class="main-pagination">
                        <div class="nav-links">
                            <?php
                            echo paginate_links([
                                'total'   => $blog_query->max_num_pages,
                                'current' => $paged,
                                'prev_text' => '',
                                'next_text' => '',
                                'type' => 'plain',
                            ]);
                            ?>
                        </div>
                    </div>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>

<?php 
echo get_footer();
?>