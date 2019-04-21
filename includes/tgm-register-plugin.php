<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.2
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
// require_once(get_template_directory().'/libs/class-tgm-plugin-activation.php');
// add_action( 'tgmpa_register', 'bebostore_theme_register_required_plugins' );
function bebostore_theme_register_required_plugins() {
	$plugins = json_decode(wp_remote_retrieve_body( wp_remote_get( 'http://api.beautheme.com/?beau_plugin=bebostore', array('user-agent' => 'beau-user-agent',) ) ),true);
	$plugins = $plugins['plugins'];
	$config = array(
		'id'           => 'tgmpa',
		'default_path' => 'bebo-active-plugins',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);
	tgmpa( $plugins, $config );
}