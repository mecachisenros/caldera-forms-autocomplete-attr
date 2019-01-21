<?php
/**
 * Plugin Name: Caldera Forms Autocomplete Attribute
 * Description: Exposes the 'autocomplete' <a href="https://developer.mozilla.org/en-US/docs/Web/HTML/Attributes/autocomplete" target="_blank">html attribute</a> as a field setting for the field types Single Line Text, Email Address, Phone Number (Better), Phone Number (Basic), Number, URL, Range Slider, Date Picker, and Color Picker.
 * Version: 0.1
 * Author: Andrei Mondoc
 * Author URI: https://github.com/mecachisenros
 * Plugin URI: https://github.com/mecachisenros/caldera-forms-autocomplete-attr
 * GitHub Plugin URI: mecachisenros/caldera-forms-autocomplete-attr
 */

// bail if called directly
if ( ! defined( 'WPINC' ) ) die( 'That\'s cheating...' );

/**
 * Plugin class.
 */
class Caldera_Forms_Autocomplete_Attr {

	/**
	 * Version.
	 * @since 0.1
	 * @var string $version
	 */
	protected $version = '0.1';

	/**
	 * Plugin path.
	 * @since 0.1
	 * @var string $path
	 */
	protected $path;

	/**
	 * Plugin url.
	 *
	 * @since 0.1
	 * @var string $url
	 */
	protected $url;

	/**
	 * Constructor.
	 *
	 * @since 0.1
	 */
	public function __construct() {

		// plugin path
		$this->path = plugin_dir_path( __FILE__ );
		// plugin url
		$this->url = plugin_dir_url( __FILE__ );
		// initiliaze
		add_action( 'caldera_forms_core_init', [ $this, 'register_hooks' ] );

	}

	/**
	 * Register hooks.
	 *
	 * @since 0.1
	 */
	public function register_hooks() {

		// add autocomplete template setting
		add_action( 'caldera_forms_field_settings_template', [ $this, 'add_setting_template' ], 20, 2 );
		// add attribute
		add_filter( 'caldera_forms_field_attributes', [ $this, 'add_autocomplete_attribute' ], 10, 3 );

	}

	/**
	 * Adds the autocomplete setting template.
	 *
	 * @uses 'caldera_forms_field_settings_template'
	 *
	 * @since 0.1
	 *
	 * @param array $config The field config
	 * @param string $field_type The field type slug
	 */
	public function add_setting_template( $config, $field_type ) {

		$field_types = apply_filters( 'cf/autocomplete/attr/field_types', [ 
			'text',
			'email',
			'phone_better',
			'phone',
			'number',
			'url',
			'range_slider',
			'date_picker',
			'color_picker',
		] );

		if ( in_array( $field_type, $field_types ) )
			include $this->path . 'fields/autocomplete.php';

	}

	/**
	 * Filter field attributes.
	 *
	 * @since 1.0
	 * 
	 * @param array $attrs The field attributes
	 * @param array $field The field config
	 * @param array $form The form config
	 * @return array $attrs The modified field attributes
	 */
	public function add_autocomplete_attribute( $attrs, $field, $form ) {

		if ( ! isset( $field['config']['autocomplete'] ) ) return $attrs;

		if ( empty( $field['config']['autocomplete'] ) ) return $attrs;

		$attrs['autocomplete'] = $field['config']['autocomplete'];

		return $attrs;

	}

}

new Caldera_Forms_Autocomplete_Attr;