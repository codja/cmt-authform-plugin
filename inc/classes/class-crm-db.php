<?php

namespace Rgbcode_authform\classes;

use Rgbcode_authform\traits\Singleton;

class CRM_DB {

	use Singleton;

	/**
	 * Retrieves user data from the CRM database.
	 *
	 * @param string $column  The column to search by (e.g., 'email').
	 * @param string $value   The value to match in the specified column.
	 * @param string $fields  The fields to select in the query, comma-separated.
	 *
	 * @return array|null The first matching record as an associative array, or null if no match is found.
	 */
	public function get_user_register_data( string $column, string $value, string $fields = 'account_no' ): ?array {
		if ( ! $column || ! $value ) {
			return null;
		}

		$crm_db = self::instance()->db();
		if ( ! $crm_db ) {
			return null;
		}

		$sanitized_fields = implode( ', ', array_map( 'sanitize_key', explode( ',', $fields ) ) );
		$sanitized_column = sanitize_key( $column );

		// Prepare and execute the query
		$base_request = $crm_db->get_results(
			$crm_db->prepare(
				"SELECT {$sanitized_fields} FROM vtiger_account WHERE {$sanitized_column} = %s",
				sanitize_text_field( $value )
			),
			ARRAY_A
		);

		$crm_db->close();

		return $base_request
			? reset( $base_request )
			: null;
	}

	/**
	 * Establishes a connection to the CRM database.
	 *
	 * @return \Wpdb|null The Wpdb instance for the CRM database, or null on failure.
	 */
	private function db(): ?\Wpdb {
		if ( ! $this->check_constants() ) {
			return null;
		}

		$panda_db = new \Wpdb(
			CRM_DB_USER,
			CRM_DB_PASS,
			CRM_DB_NAME,
			CRM_DB_HOST
		);

		if ( ! $panda_db->check_connection() ) {
			return null;
		}

		return $panda_db;
	}

	/**
	 * Checks if the required CRM database constants are defined.
	 *
	 * @return bool True if all required constants are defined, false otherwise.
	 */
	private function check_constants(): bool {
		return defined( 'CRM_DB_USER' )
				&& defined( 'CRM_DB_PASS' )
				&& defined( 'CRM_DB_NAME' )
				&& defined( 'CRM_DB_HOST' );
	}

}
