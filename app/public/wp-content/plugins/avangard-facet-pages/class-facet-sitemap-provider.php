<?php
/**
 * Rank Math sitemap provider for the virtual facet pages: adds facet-sitemap.xml
 * (all registered pages, both languages) to sitemap_index.xml.
 *
 * Loaded lazily from the `rank_math/sitemap/providers` filter, because this plugin
 * loads before Rank Math and the Provider interface does not exist yet at load time.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Avangard_Facet_Sitemap_Provider implements \RankMath\Sitemap\Providers\Provider {

	const TYPE = 'facet';

	public function handles_type( $type ) {
		return self::TYPE === $type;
	}

	public function get_index_links( $max_entries ) {
		return array(
			array(
				'loc'     => \RankMath\Sitemap\Router::get_base_url( self::TYPE . '-sitemap.xml' ),
				'lastmod' => self::lastmod(),
			),
		);
	}

	public function get_sitemap_links( $type, $max_entries, $current_page ) {
		$links = array();
		$mod   = self::lastmod();
		foreach ( Avangard_Facet_Pages::get_pages() as $page ) {
			$links[] = array(
				'loc' => home_url( $page['path'] ),
				'mod' => $mod,
			);
		}
		return $links;
	}

	/** Page texts live in the plugin file itself, so its mtime is the honest lastmod. */
	private static function lastmod() {
		$file = __DIR__ . '/avangard-facet-pages.php';
		return '@' . ( file_exists( $file ) ? filemtime( $file ) : time() );
	}
}
