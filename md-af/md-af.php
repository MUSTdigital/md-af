<?php

/**
 * @wordpress-plugin
 * Plugin Name:       MD Ajax Forms
 * Plugin URI:        http://mustdigital.ru/projects/md-ajax-forms
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           0.1.1
 * Author:            Dmitry Korolev
 * Author URI:        http://mustdigital.ru
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       md-af
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require plugin_dir_path( __FILE__ ) . 'includes/tgm/class-tgm-plugin-activation.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-md-af.php';

function run_md_af() {

	$plugin = new Md_Af();
	$plugin->run();

}
run_md_af();
