<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://mustdigital.ru
 * @since      0.1.0
 *
 * @package    Md_Af
 * @subpackage Md_Af/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Md_Af
 * @subpackage Md_Af/public
 * @author     Dmitry Korolev <dk@mustdigital.ru>
 */
class Md_Af_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.1.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_scripts() {

		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/md-af-public.js', array( 'jquery' ), $this->version, true );
		$this->provide_data();
        wp_enqueue_script( $this->plugin_name );

	}

    /**
     * Provide some necessary data to the frontend
     */
    private function provide_data() {
        wp_localize_script(
            $this->plugin_name,
            'mdaf_data',
            [
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'nonce'   => wp_create_nonce( 'mdaf_nonce' ),
                'texts'   => [
                    'success' => __('Success!', 'md-af')
                ]
            ]
        );
    }

}
