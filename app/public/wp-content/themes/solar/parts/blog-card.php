<?php 
    $post_fields = get_fields(get_the_ID());
    $lang = pll_current_language();
    $content = get_the_content();
?>

<div class="blog-card">
    <a href="<?php the_permalink(); ?>" class="blog-card-image-wrap">
        <div class="blog-card-caterory-and-date">
            <div class="blog-card-category">
                <?php
                $cats = get_the_category();
                if (!empty($cats)) {
                    echo esc_html($cats[0]->name);
                }
                ?>
            </div>
            <div class="blog-card-date">
                <?php echo get_the_date('j M Y'); ?>
            </div>
        </div>
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('medium'); ?>
        <?php endif; ?>
    </a>
    <div class="blog-card-content">
		<h3 class="blog-card-content-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h3>
        
        <a href="<?php the_permalink(); ?>" class="blog-card-content-desc">
            <?php echo wp_trim_words($content, 20); ?>
        </a>
        <a href="<?php the_permalink(); ?>"  class="blog-card-content-tags">
            <?php
            $tags = get_the_terms(get_the_ID(), 'post_tag');
            if ($tags && !is_wp_error($tags)) :
                foreach ($tags as $tag) :
            ?>
                <div class="blog-card-content-tag">
                    <?php echo esc_html($tag->name); ?>
                </div>
            <?php endforeach; endif; ?>
        </a>
        <div class="blog-card-content-bottom">
            <a href="<?php the_permalink(); ?>" class="blog-card-btn">
                <?php 
                    if ($lang == 'uk') {
                        echo 'Читати';
                    }else {
                        echo 'Читать';
                    }
                ?>
            </a>
            <div class="blog-card-content-time-read">
                <?php
                $words = str_word_count(strip_tags($content));
                $minutes = ceil($words / 200);
                if ($lang == 'uk') {
                    $read_text = ' хв. читання';
                }else {
                    $read_text = ' мин. чтения';
                }
                echo $minutes . $read_text ;
                ?>
            </div>
        </div>
    </div>
</div>