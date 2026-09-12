<?php
/**
 * Fallback template — serves author, search, category, tag and date archives
 * (the theme has no dedicated author.php / search.php / category.php).
 * Renders the main query safely; exposes no object internals.
 */

get_header();

$is_ru = function_exists( 'pll_current_language' ) && pll_current_language() === 'ru';
?>

<div class="blog-home">
    <div class="wrapper">
        <div class="m-2-top">
            <h1 class="m-2-top-left">
                <?php
                if ( is_search() ) {
                    echo esc_html( $is_ru ? 'Результаты поиска: ' : 'Результати пошуку: ' );
                    echo '<span>' . esc_html( get_search_query() ) . '</span>';
                } else {
                    echo wp_kses_post( get_the_archive_title() );
                }
                ?>
            </h1>
        </div>

        <div class="blog-home-body">
            <div class="blog-home-body-right">
                <div class="blog-list">
                    <?php if ( have_posts() ) : ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'parts/blog-card' ); ?>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <p class="blog-empty">
                            <?php echo esc_html( $is_ru ? 'Ничего не найдено.' : 'Нічого не знайдено.' ); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="main-pagination">
                    <div class="nav-links">
                        <?php
                        the_posts_pagination( array(
                            'prev_text' => '',
                            'next_text' => '',
                            'type'      => 'plain',
                        ) );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
