<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Quotations_Manager
 * @subpackage Quotations_Manager/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Quotations_Manager
 * @subpackage Quotations_Manager/includes
 * @author     Your Name <email@example.com>
 */
class Quotations_Manager_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		/**
		 * Salvataggio di un transient per visualizzare la notifica di attivazione plugin personalizzata.
		 */
		set_transient( 'quoma_admin_notices_transient', true, 5 );

	}

}
