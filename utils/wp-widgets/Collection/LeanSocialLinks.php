<?php namespace Esq\Widgets\Collection;

use Esq\Widgets\Models\AbstractWidget;
use Esq\Acf;

/**
 * Class EsqSocialLinks.
 *
 * @package Esq\Widgets\Collection
 */
class EsqSocialLinks extends AbstractWidget {
	/**
	 * Constructor.
	 */
	public function __construct() {
		parent::__construct( 'Esq Social Links', 'Display list of social links' );
	}

	/**
	 * Get the widget's data.
	 *
	 * @return mixed
	 */
	public function get_data() {
		$data = parent::get_data();

		$data['items'] = Acf::get_option_field( 'social_links' );

		return $data;
	}
}
