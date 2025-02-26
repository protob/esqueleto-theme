<?php

namespace Esq\WP\Taxonomies;

use Esq\Taxonomy;

/**
 * Taxonomy example.
 */
class Example {
	const NAME        = 'TaxExample';
	const NAME_PLURAL = 'TaxExamples';
	const SLUG        = 'taxexample';

	/**
	 * Class loaded automatically.
	 */
	public static function init() {
	
		 add_action( 'init', [ __CLASS__, 'create_taxonomy' ] );
	
	}

	/**
	 * Create Category.
	 */
	public static function create_taxonomy() {
		$tax = new Taxonomy(
			[
				'name'     => self::NAME,
				'singular' => self::NAME,
				'plural'   => self::NAME_PLURAL,
				'slug'     => self::SLUG,
				'objects'  => [
					'post',
				],
				'args'     => [
					'hierarchical'      => true,
					'show_admin_column' => true,
					'capabilities'      => [
						'manage_terms' => 'manage_categories',
						'edit_terms'   => 'manage_categories',
						'delete_terms' => 'manage_categories',
						'assign_terms' => 'edit_posts',
					],
				],
			]
		);
		$tax->init();
	}
}
