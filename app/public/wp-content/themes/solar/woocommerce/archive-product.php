<?php
get_header();
$fields_main = get_fields(PAGE_ID_HOME);
$lang = pll_current_language();
?>

    <div class="sh-hero">
        <div class="wrapper">
                <?php
			 if ( !is_product_category() ) {
				?>
			<h1 class="main-title main-title--shop">Магазин</h1>
			<?php
			}
                $terms = get_terms([
                    'taxonomy'   => 'product_cat',
                    'hide_empty' => true, 
                ]);

                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
                ?>
                <div class="sh-hero-category-list">
					<?php foreach ( $terms as $term ) :

						$term_link = get_term_link( $term );

						$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
						$image_url = $thumbnail_id
							? wp_get_attachment_url( $thumbnail_id )
							: get_template_directory_uri() . '/assets/images/default-category.svg';

						$is_active = is_product_category() && get_queried_object_id() == $term->term_id;
						$active_class = $is_active ? ' active' : '';

					?>

						<?php
						$avangard_facet_page = class_exists( 'Avangard_Facet_Pages' ) ? Avangard_Facet_Pages::get_active_page() : null;
						$hero_h1_text        = $avangard_facet_page ? $avangard_facet_page['h1'] : $term->name;
						?>
						<?php if ( $is_active ) : ?>
							<h1 class="sh-hero-category-item<?php echo $active_class; ?>">
								<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $term->name ); ?>">
								<?php echo esc_html( $hero_h1_text ); ?>
							</h1>
						<?php else : ?>
							<a href="<?php echo esc_url( $term_link ); ?>" class="sh-hero-category-item">
								<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $term->name ); ?>">
								<?php echo esc_html( $term->name ); ?>
							</a>
						<?php endif; ?>

					<?php endforeach; ?>
				</div>
                <?php endif; ?>
        </div>
    </div>

    <div class="sh-body">
        <div class="wrapper">
            <div class="sh-hero-flex">
                <div class="sh-hero-left">
                    <?php 
                    if ( is_product_category('avtonomni-invertory') || is_product_category('avtonomnye-invertory') ) {
                        echo do_shortcode('[br_filters_group group_id=737]');
                    } else if( is_product_category('sonyachni-paneli') || is_product_category('solnechnye-paneli') ){
                        echo do_shortcode('[br_filters_group group_id=759]');
                    } else if( is_product_category('merezhevi-invertory') || is_product_category('setevye-invertory') ){
                        echo do_shortcode('[br_filters_group group_id=764]');
                    } else if( is_product_category('akkumulyatory') || is_product_category('akumulyatory')  ){
                        echo do_shortcode('[br_filters_group group_id=768]');
                    } else if( is_product_category('stabilizatory-naprugy') || is_product_category('stabilizatory-napryazheniya') ){
                        echo do_shortcode('[br_filters_group group_id=771]');
                    } else if( is_product_category('zazemlennya-i-blyskavkozahyst') || is_product_category('zazemleniya-i-grozozashhita') ){
                        echo do_shortcode('[br_filters_group group_id=777]');
                    } else if( is_product_category('kriplennya') || is_product_category('krepleniya') ){
                        echo do_shortcode('[br_filters_group group_id=781]');
                    } else if( is_product_category('komplekty-rezervnogo-zhyvlennya') || is_product_category('komplekty-rezervnogo-pitaniya') ){
                        echo do_shortcode('[br_filters_group group_id=784]');
                    } else if( is_product_category('solar-station') || is_product_category('solnechnye-elektrostanczii') ){
                        echo do_shortcode('[br_filters_group group_id=787]');
                    } else {
                        echo do_shortcode('[br_filters_group group_id=790]');
                    }
                    ?>
                </div>
                <div class="sh-hero-right">
                    <div class="blog-home-top">
                        <?php 
                            echo do_shortcode('[aws_search_form]');;
                        ?>
                        <div class="sh-sort-product-main-prior select-filter-style">
                            <?php
                                woocommerce_catalog_ordering();
                            ?>
                        </div>
                    </div>
                    <div class="sh-hero-right-list">
                        <?php if ( woocommerce_product_loop() ) : ?>

                            <?php woocommerce_product_loop_start(); ?>

                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php wc_get_template_part( 'content', 'product' ); ?>
                            <?php endwhile; ?>

                            <?php woocommerce_product_loop_end(); ?>

                        <?php endif; ?>
                    </div>
                    <div class="main-pagination woocommerce-pagination">
                        <?php
                        the_posts_pagination([
                            'mid_size'  => 2,
                            'prev_text' => __('« Назад', 'your-textdomain'),
                            'next_text' => __('Вперед »', 'your-textdomain'),
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="favourite-product">
        <div class="wrapper">
            <div class="favourite-product-title">
                <?php 
                    if($lang == 'uk'){
                        echo 'Найпопулярніші товари';
                    }else {
                        echo 'Cамые популярные товары';
                    }
                ?>
            </div>
            <div class="favourite-product-list">
                <?php
                    $args = [
                        'limit'      => 4,
                        'status'     => 'publish',
                        'type'       => 'simple',
                        'meta_query' => [
                            [
                                'key'     => '_featured',
                                'value'   => 'yes',
                                'compare' => '='
                            ]
                        ]
                    ];

                    $query = new WC_Product_Query($args);
                    $products = $query->get_products();

                    if ( $products ) :
                        foreach ( $products as $prod ) :
                            ?>
                            <div class="favourite-product-list-item">
                                <div class="pr-card">

                                    <a href="<?php echo get_permalink( $prod->get_id() ); ?>" class="pr-card-image-box">
                                        <?php echo $prod->get_image('medium'); ?>
                                    </a>

                                    <a href="<?php echo get_permalink( $prod->get_id() ); ?>" class="pr-card-title">
                                        <?php echo $prod->get_name(); ?>
                                    </a>

                                    <div class="pr-card-price">
                                        <?php echo $prod->get_price_html(); ?>
                                    </div>

                                    <div class="pr-card-btn-wrap">
                                        <a href="<?php echo get_permalink( $prod->get_id() ); ?>" class="pr-card-btn-one-click">
                                            <?php echo ($lang == 'uk') ? 'Замовити в 1 клік' : 'Заказать в 1 клик'; ?>
                                        </a>

                                        <a href="#"
                                        class="pr-card-btn-add-basket pr-btn-add-basket"
                                        data-product-id="<?php echo $prod->get_id(); ?>">
                                            <?php echo ($lang == 'uk') ? 'Додати в кошик' : 'Добавить в корзину'; ?>
                                        </a>
                                    </div>

                                </div>
                            </div>
                            <?php
                        endforeach;
                    endif;
                    ?>
            </div>
        </div>
    </div>

<?php if ( is_product_category() ) : 
    $term = get_queried_object();
    $description = ! empty( $term->description ) ? $term->description : '';
     if ( ! empty( $description ) ) : ?>
        

<div class="m-7 section">
    <div class="wrapper">
        <div class="m-7-box">
                <div class="main-text main-text-onlyffull">
                    <?php echo wp_kses_post( wpautop( $description ) ); ?>
                </div>
           
        </div>
    </div>
</div>
  <?php endif; ?>

<?php endif; ?>
<?php
echo get_footer();
?>