<?php namespace Esq\Widgets\Collection;

use Esq\Widgets\Models\AbstractWidget;
use Esq\Acf;

/**
 * Class EsqContactDetails.
 *
 * @package Esq\Widgets\Collection
 */
class EsqContactDetails extends AbstractWidget {
	/**
	 * Constructor.
	 */
	public function __construct() {
		parent::__construct( 'Esq Contact Details', 'Display contact details' );
	}

	/**
	 * Get the widget's data.
	 *
	 * @return mixed
	 */
	public function get_data() {
		$data = parent::get_data();

		$data['logo'] = Acf::get_option_field( 'contact_details_logo' );
		$data['address'] = Acf::get_option_field( 'contact_details_address' );
		$data['phone'] = Acf::get_option_field( 'contact_details_phone' );
		$data['email'] = Acf::get_option_field( 'contact_details_email' );

		return $data;
	}
}
