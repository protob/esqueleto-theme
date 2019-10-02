<?php

namespace Esq\WP\Endpoints;

use Esq\Models\Posts;
use Esq\AbstractEndpoint;

/**
 * Class used to generate an endpoint for posts.
 */
class PostsEndpoint extends AbstractEndpoint {
	/**
	 * The variable used to identify the path of the endpoint.
	 *
	 * @var string
	 */
	protected $endpoint = '/posts';

	/**
	 * Function called by the endpoint if there are no more pages it returns a 404 reponse status.
	 *
	 * @param \WP_REST_Request $request Contains data from the request.
	 */
	public function endpoint_callback( \WP_REST_Request $request ) {
		$page   = $request->get_param( 'page' ) ?? 1;
		$search = $request->get_param( 's' );

		$args['paged'] = $page;

		if ( $search ) {
			$args['s'] = $search;
		}

		$query       = Posts::query( $args );
		$total_pages = $query->max_num_pages;

		// If we don't have more pages max_pages is zero but only if we are on a greather page than 1.
		if ( 0 === $total_pages && 1 < $page ) {
			return new \WP_Error(
				'page_limit',
				'Page not found.',
				[
					'status' => 404,
				]
			);
		}

		return Posts::format_data( $query->posts );
	}

	/**
	 * Arguments that the endpoint can receive.
	 *
	 * @return array
	 */
	public function endpoint_args() {
		return [
			'page' => [
				'required'          => false,
				'validate_callback' => function ( $param ) {
					return is_numeric( $param );
				},
				'sanitize_callback' => 'absint',
				'default'           => 1,
			],
			's'    => [
				'required'          => false,
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => '',
			],
		];
	}
}
