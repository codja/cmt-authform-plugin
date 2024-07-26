<?php

namespace Rgbcode_authform\interfaces;

interface CRM_Endpoint {

	public function get_endpoint(): string;

	public function get_body( $data ): array;

}
