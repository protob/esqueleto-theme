<?php

namespace Esq\WP\Endpoints;
namespace Esq\WP\Endpoints\PostsEndpoint;

/**
 * Function that is used to register the new endpoints used for the site.
 */
class Api {
	/**
	 * This class is auto loaded.
	 *
	 * Initialize endpoints
	 */
	public static function init() {
		self::add_filters();

		PostsEndpoint::init();
	}

	/**
	 * Filters used to overwrite the default configuration of the endpoints.
	 */
	public static function add_filters() {
		add_filter(
			'Esq_endpoints_api_namespace',
			function () {
				return 'Esq';
			}
		);

		add_filter(
			'Esq_endpoints_api_version',
			function () {
				return 'v1';
			}
		);
	}
}
