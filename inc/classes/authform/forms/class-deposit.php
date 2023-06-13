<?php

namespace Rgbcode_authform\classes\authform\forms;

use Rgbcode_authform\classes\helpers\Location;
use Rgbcode_authform\traits\Singleton;

class Deposit extends Baseform {

	use Singleton;

	const TEMPLATE_NAME = 'deposit';

	const ACTION = 'forexDeposit';

	public function get_template_data(): array {
		return [
			'title_block'      => get_field( 'rgbc_authform_deposit_title_block', 'option' ),
			'country'          => get_field( 'rgbc_authform_deposit_country', 'option' ),
			'city'             => get_field( 'rgbc_authform_deposit_city', 'option' ),
			'address'          => get_field( 'rgbc_authform_deposit_address', 'option' ),
			'postcode'         => get_field( 'rgbc_authform_deposit_postcode', 'option' ),
			'birthday'         => get_field( 'rgbc_authform_deposit_birthday', 'option' ),
			'submit'           => get_field( 'rgbc_authform_deposit_submit', 'option' ),
			'visibility_class' => $this->get_visibility_class(),
			'countries'        => Location::COUNTRIES,
		];
	}

}
