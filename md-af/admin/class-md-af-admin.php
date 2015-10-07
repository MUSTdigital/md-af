<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://mustdigital.ru
 * @since      0.1.0
 *
 * @package    Md_Af
 * @subpackage Md_Af/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Md_Af
 * @subpackage Md_Af/admin
 * @author     Dmitry Korolev <dk@mustdigital.ru>
 */
class Md_Af_Admin {

	/**
	 * @since   0.1.0
	 * @access  private
	 * @var     string   $plugin_name  The ID of this plugin.
	 * @var     string   $version      The current version of this plugin.
	 * @var     array    $data         Raw form data.
	 * @var     array    $post         Post data.
	 * @var     array    $meta         Post meta fields.
	 * @var     string   $taxonomy     Post taxonomy.
	 */
	private $plugin_name,
            $version,
            $data,
            $post,
            $meta,
            $taxonomy;

    /**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.1.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/md-af-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/md-af-admin.js', array( 'jquery' ), $this->version, true );

	}

	/**
	 * Custom post type.
	 *
	 * @since    0.1.0
	 */
    public function post_types() {

        $labels = array(
            'name'                => _x( 'Submissions', 'Post Type General Name', 'md-af' ),
            'singular_name'       => _x( 'Submission', 'Post Type Singular Name', 'md-af' ),
            'menu_name'           => __( 'Submissions', 'md-af' ),
            'name_admin_bar'      => __( 'Submissions', 'md-af' ),
            'parent_item_colon'   => __( '', 'md-af' ),
            'all_items'           => __( 'All Submissions', 'md-af' ),
            'add_new_item'        => __( 'Add New Submission', 'md-af' ),
            'add_new'             => __( 'Add New', 'md-af' ),
            'new_item'            => __( 'New Submission', 'md-af' ),
            'edit_item'           => __( 'Edit Submission', 'md-af' ),
            'update_item'         => __( 'Update Submission', 'md-af' ),
            'view_item'           => __( 'View Submission', 'md-af' ),
            'search_items'        => __( 'Search Submission', 'md-af' ),
            'not_found'           => __( 'Not found', 'md-af' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'md-af' ),
        );
        $args = array(
            'label'               => __( 'Submission', 'md-af' ),
            'description'         => __( 'Forms submissions', 'md-af' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'custom-fields', ),
            'taxonomies'          => array( 'mdaf_id' ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 25,
            'menu_icon'           => 'dashicons-email-alt',
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => false,
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => true,
            'publicly_queryable'  => false,
            'rewrite'             => false,
            'capability_type'     => 'page',
        );
        register_post_type( 'mdaf', $args );

    }

    /**
     * Custom taxonomy
	 *
	 * @since    0.1.0
	 */
    public function taxonomies() {

        $labels = array(
            'name'                       => _x( 'Form IDs', 'Taxonomy General Name', 'md-af' ),
            'singular_name'              => _x( 'Form ID', 'Taxonomy Singular Name', 'md-af' ),
            'menu_name'                  => __( 'Form IDs', 'md-af' ),
            'all_items'                  => __( 'All IDs', 'md-af' ),
            'parent_item'                => __( '', 'md-af' ),
            'parent_item_colon'          => __( '', 'md-af' ),
            'new_item_name'              => __( 'New ID', 'md-af' ),
            'add_new_item'               => __( 'Add New ID', 'md-af' ),
            'edit_item'                  => __( 'Edit ID', 'md-af' ),
            'update_item'                => __( 'Update ID', 'md-af' ),
            'view_item'                  => __( 'View ID', 'md-af' ),
            'separate_items_with_commas' => __( 'Separate IDs with commas', 'md-af' ),
            'add_or_remove_items'        => __( 'Add or remove IDs', 'md-af' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'md-af' ),
            'popular_items'              => __( 'Popular IDs', 'md-af' ),
            'search_items'               => __( 'Search IDs', 'md-af' ),
            'not_found'                  => __( 'Not Found', 'md-af' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => false,
            'show_tagcloud'              => false,
            'rewrite'                    => false,
        );
        register_taxonomy( 'mdaf_id', array( 'mdaf' ), $args );

    }

    /**
     * Save form
	 *
	 * @since    0.1.0
	 */
    public function save_form_submission() {

        // Save post
        $post_id = wp_insert_post( $this->post );
        if ( $post_id == 0 ) {
            $this->generate_response([
                'success' => false,
                'errors'  => [
                    'code'    => 'PostNotInserted',
                    'message' => __( 'Problem occured, try again later', 'md-af' )
                ]
            ]);
        }

        // Update post taxonomy
        if ( !term_exists( $this->taxonomy, 'mdaf_id' ) ) {
            $this->taxonomy = wp_insert_term( $this->taxonomy, 'mdaf_id');
        }
        wp_set_object_terms($post_id, $this->taxonomy, 'mdaf_id');

        // Save post meta
        foreach($this->meta as $key => $value){
            update_post_meta($post_id, $key, $value);
        }

        $this->generate_response([
            'success' => true,
            'post_id' => $post_id
        ]);

    }

    /**
     * Ajax action for frontend
     *
     * @since 0.1.0
     */
    public function ajax_action() {

        if ( !( isset( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'mdaf_nonce' ) ) ) {
            $this->generate_response([
                'success' => false,
                'errors'  => [
                    'code'    => 'InvalidNonce',
                    'message' => __( 'Invalid nonce', 'md-af' )
                ]
            ]);
        }

        $this->data = $_POST;
        $this->sanitize_n_sort();
        $this->save_form_submission();

    }

    /**
     * Sanitize and sort form data.
     *
     * @since 0.1.0
     */
    private function sanitize_n_sort() {

        $post = [
            'post_status' => 'publish'
        ];
        $meta = [];
        $taxonomy  = '';

        foreach( $this->data as $key => $value ){

            $errors = [];

            switch ( $key ) {
                case 'action':
                case 'nonce':
                    break; // Do nothing.

                case 'post_type':
                    $post['post_type'] = $value;
                    break;

                case 'content':
                case 'title':
                    $post['post_' . $key] = $value; // We don't need any sanitation since wp_insert_post will handle it itself.
                    break;

                case 'form_id':
                    $taxonomy = sanitize_title( $value );
                    break;

                case 'email':
                    if ( is_email($value) ) {
                        $meta['mdaf_email'] = $value;
                    } else {
                        $errors[] = [
                            'field' => $key,
                            'error' => __( 'Invalid email', 'md-af' )
                        ];
                    }
                    break;

                case 'phone':
                    $value = preg_replace('/[^0-9]/', '', $value);
                    if ($value) {
                        $meta['mdaf_phone'] = $value;
                    } else {
                        $errors[] = [
                            'field' => $key,
                            'error' => __( 'Invalid phone number', 'md-af' )
                        ];
                    }
                    break;

                case 'email_or_phone':
                    if ( is_email($value) ) {
                        $meta['mdaf_email'] = $value;
                    } else {
                        $value = preg_replace( '/[^0-9]/', '', $value );
                        if ( $value ) {
                            $meta['mdaf_phone'] = $value;
                        } else {
                            $errors[] = [
                                'field' => $key,
                                'error' => __( 'Invalid contact information', 'md-af' )
                            ];
                        }
                    }
                    break;

                default:
                    if ( $value ) {
                        $meta['mdaf_' . $key] = sanitize_text_field( $value );
                    }
                    break;

            }

            if ( count($errors) > 0 ) {
                $this->generate_response([
                    'success' => false,
                    'errors'  => [
                        'code'     => 'ValidationErrors',
                        'messages' => $errors
                    ]
                ]);
            }

        }

        $this->post     = $post;
        $this->meta     = $meta;
        $this->taxonomy = $taxonomy;

    }

    /**
     * @since 0.1.0
     */
    private function generate_response($data) {
        exit( json_encode( $data ) );
    }

}
