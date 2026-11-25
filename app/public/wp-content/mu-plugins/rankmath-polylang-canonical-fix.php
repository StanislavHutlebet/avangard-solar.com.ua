<?php
/**
 * Plugin Name: Rank Math + Polylang canonical fix (posts page)
 * Description: Rank Math's own Polylang integration (3rdparty/polylang/class-polylang.php,
 *              fix_home_canonical()) is meant to append the language path only to the real
 *              static front page's canonical. Its guard checks "! is_home()", but on a site
 *              that has BOTH a static front page (page_on_front) AND a separate posts/blog
 *              page (page_for_posts) in another language, is_home() is also true on that
 *              blog page — so the language path gets appended there too, producing a wrong
 *              canonical like https://site/ru/blog/ru/ instead of https://site/ru/blog/.
 *              This recomputes the correct canonical for that one case, without touching the
 *              vendor plugin file (so a Rank Math update won't need re-patching).
 */

add_filter( 'rank_math/frontend/canonical', function ( $canonical ) {
	if ( ! is_home() ) {
		return $canonical;
	}

	$page_for_posts = (int) get_option( 'page_for_posts' );
	if ( ! $page_for_posts ) {
		return $canonical;
	}

	// Real static front page never reaches here: on this site is_home() is only
	// true for the dedicated blog/posts page, not for page_on_front.
	$correct = get_permalink( $page_for_posts );

	$paged = (int) get_query_var( 'paged' );
	if ( $paged > 1 ) {
		global $wp_rewrite;
		$correct = user_trailingslashit(
			trailingslashit( $correct ) . trailingslashit( $wp_rewrite->pagination_base ) . $paged
		);
	}

	return $correct;
}, 1000 );
