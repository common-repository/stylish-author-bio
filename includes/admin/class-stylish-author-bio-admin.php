<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Author Bio Box Admin class.
 */
class Author_Bio_Box_Admin {

	/**
	 * Slug of the plugin screen.
	 *
	 * @var string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin admin.
	 */
	public function __construct() {

		// Custom contact methods.
		add_filter( 'user_contactmethods', array( $this, 'add_author_profile' ), 10, 1 );

		// Load admin JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Init plugin options form.
		add_action( 'admin_init', array( $this, 'plugin_settings' ) );
	}

	/**
	 * Sets default settings.
	 *
	 * @return array Plugin default settings.
	 */
	protected function default_settings() {

		$settings = array(
			'settings' => array(
				'title' => __( 'Settings', 'stylish-author-bio' ),
				'type'  => 'section',
				'menu'  => 'stylish_author_bio_settings'
			),
			'display' => array(
				'title'       => __( 'Display in', 'stylish-author-bio' ),
				'default'     => 'posts',
				'type'        => 'select',
				'description' => sprintf( __( 'You can display the Author Bio Section directly into anywhere in your theme using: %s', 'stylish-author-bio' ), '<br /><code>&lt;?php if ( function_exists( \'get_stylish_author_bio\' ) ) echo get_stylish_author_bio(); ?&gt;</code>' ),
				'section'     => 'settings',
				'menu'        => 'stylish_author_bio_settings',
				'options'     => array(
					'posts'      => __( 'Only in Posts', 'stylish-author-bio' ),
					'home_posts' => __( 'Homepage and Posts', 'stylish-author-bio' ),
					'pages' 	 => __( 'Only in Page', 'stylish-author-bio' ),
					'author_pages' => __( 'Only in Author Pages', 'stylish-author-bio'),
					'none'       => __( 'None', 'stylish-author-bio' ),
				)
			),

			/* ========== Start: Author Bio Background ========== */
			'author_bio_design' => array(
				'title' => __( 'Author Bio Section - Background', 'stylish-author-bio' ),
				'type'  => 'section',
				'menu'  => 'stylish_author_bio_settings'
			),

			'author_bio_background_color' => array(
				'title'   => __( 'Author Bio Background color', 'stylish-author-bio' ),
				'default' => '#EFEFEF',
				'type'    => 'color',
				'section' => 'author_bio_design',
				'menu'    => 'stylish_author_bio_settings'
			),

			'author_bio_border_color' => array(
				'title'   => __( 'Author Bio Border Color ', 'stylish-author-bio' ),
				'default' => '#cccccc',
				'type'    => 'color',
				'section' => 'author_bio_design',
				'menu'    => 'stylish_author_bio_settings'
			),

			'author_bio_border_size' => array(
				'title'       => __( 'Author Bio Border size', 'stylish-author-bio' ),
				'default'     => 5,
				'type'        => 'text',
				'section'     => 'author_bio_design',
				'description' => __( 'Author Bio outer border size(integer only)', 'stylish-author-bio' ),
				'menu'        => 'stylish_author_bio_settings'
			),			
			/* ========== End: Author Bio Background ========== */


			/* ========== Start: Author Bio Gravator ========== */
			'author_avator_design' => array(
				'title' => __( 'Author Gravator', 'stylish-author-bio' ),
				'type'  => 'section',
				'menu'  => 'stylish_author_bio_settings'
			),

			'gravatar' => array(
				'title'       => __( 'Gravatar size', 'stylish-author-bio' ),
				'default'     => 90,
				'type'        => 'text',
				'description' => sprintf( __( 'Set the Gravatar size. To configure the profile picture, you need to register in %s.', 'author-bio-box' ), '<a href="gravatar.com">gravatar.com</a>' ),
				'section'     => 'author_avator_design',
				'menu'        => 'stylish_author_bio_settings'
			),

			'gravatar_border_style' => array(
				'title'   => __( 'Gravatar Border style', 'stylish-author-bio' ),
				'default' => 'solid',
				'type'    => 'select',
				'section' => 'author_avator_design',
				'menu'    => 'stylish_author_bio_settings',
				'options' => array(
					'none'   => __( 'None', 'stylish-author-bio' ),
					'solid'  => __( 'Solid', 'stylish-author-bio' ),
					'dotted' => __( 'Dotted', 'stylish-author-bio' ),
					'dashed' => __( 'Dashed', 'stylish-author-bio' )
				)
			),

			'gravatar_shape' => array(
				'title'   => __( 'Gravatar Shape', 'stylish-author-bio' ),
				'default' => 'circle',
				'type'    => 'select',
				'section' => 'author_avator_design',
				'menu'    => 'stylish_author_bio_settings',
				'options' => array(
					'circle'  => __( 'Circle', 'stylish-author-bio' ),
					'square' => __( 'Square', 'stylish-author-bio' )
				)
			),			

			'gravatar_border_size' => array(
				'title'       => __( 'Gravatar Border size', 'stylish-author-bio' ),
				'default'     => 5,
				'type'        => 'text',
				'section'     => 'author_avator_design',
				'description' => __( 'Gravatar outer border size', 'stylish-author-bio' ),
				'menu'        => 'stylish_author_bio_settings'
			),

			'gravatar_border_color' => array(
				'title'   => __( 'Gravatar Border color', 'stylish-author-bio' ),
				'default' => '#FFFFFF',
				'type'    => 'color',
				'section' => 'author_avator_design',
				'menu'    => 'stylish_author_bio_settings'
			),

			/* ========== End: Author Bio Gravator ========== */


			/* ========== Start: Author Heading ========== */
			'author_heading' => array(
				'title' => __( 'Author Heading', 'stylish-author-bio' ),
				'type'  => 'section',
				'menu'  => 'stylish_author_bio_settings'
			),

			'author_heading_color' => array(
				'title'   => __( 'Author Heading color', 'stylish-author-bio' ),
				'default' => '#1A1A1A',
				'type'    => 'color',
				'section' => 'author_heading',
				'menu'    => 'stylish_author_bio_settings'
			),

			'author_heading_font_size' => array(
				'title'       => __( 'Author Heading Font Size', 'stylish-author-bio' ),
				'default'     => 22,
				'type'        => 'text',
				'section'     => 'author_heading',
				'description' => __( 'Author heading font size(integer only)', 'stylish-author-bio' ),
				'menu'        => 'stylish_author_bio_settings'
			),			
			/* ========== End: Author Heading ========== */


			/* ========== Start: Author Sub Heading ========== */
			'author_sub_heading' => array(
				'title' => __( 'Author Sub Heading', 'stylish-author-bio' ),
				'type'  => 'section',
				'menu'  => 'stylish_author_bio_settings'
			),

			'author_sub_heading_color' => array(
				'title'   => __( 'Author Sub Heading color', 'stylish-author-bio' ),
				'default' => '#1A1A1A',
				'type'    => 'color',
				'section' => 'author_sub_heading',
				'menu'    => 'stylish_author_bio_settings'
			),

			'author_sub_heading_font_size' => array(
				'title'       => __( 'Author Sub Heading Font Size', 'stylish-author-bio' ),
				'default'     => 14,
				'type'        => 'text',
				'section'     => 'author_sub_heading',
				'description' => __( 'Author sub heading font size(integer only)', 'stylish-author-bio' ),
				'menu'        => 'stylish_author_bio_settings'
			),			
			/* ========== End: Author Sub Heading ========== */



			/* ========== Start: Author Description ========== */
			'author_description' => array(
				'title' => __( 'Author Description', 'stylish-author-bio' ),
				'type'  => 'section',
				'menu'  => 'stylish_author_bio_settings'
			),

			'author_description_color' => array(
				'title'   => __( 'Author Description color', 'stylish-author-bio' ),
				'default' => '#1A1A1A',
				'type'    => 'color',
				'section' => 'author_description',
				'menu'    => 'stylish_author_bio_settings'
			),

			'author_description_font_size' => array(
				'title'       => __( 'Author Description Font Size', 'stylish-author-bio' ),
				'default'     => 12,
				'type'        => 'text',
				'section'     => 'author_description',
				'description' => __( 'Author description font size(integer only)', 'stylish-author-bio' ),
				'menu'        => 'stylish_author_bio_settings'
			),							
			/* ========== End: Author Description ========== */


			/* ========== Start: Social Media ========== */
			'author_social_media' => array(
				'title' => __( 'Author Social Link', 'stylish-author-bio' ),
				'type'  => 'section',
				'menu'  => 'stylish_author_bio_settings'
			),

			'author_social_icon_size' => array(
				'title'       => __( 'Author Social Icon Size', 'stylish-author-bio' ),
				'default'     => 34,
				'type'        => 'text',
				'section'     => 'author_social_media',
				'description' => __('Author Social Media Icon Size(integer only)', 'stylish-author-bio' ),
				'menu'        => 'stylish_author_bio_settings'
			),	

			'author_social_icon_shape' => array(
				'title'   => __( 'Social Icon Shape', 'stylish-author-bio' ),
				'default' => 'circle',
				'type'    => 'select',
				'section' => 'author_social_media',
				'menu'    => 'stylish_author_bio_settings',
				'options' => array(
					'none'    => __( 'None', 'stylish-author-bio' ),
					'circle'  => __( 'Circle', 'stylish-author-bio' ),
					'rounded' => __( 'Rounded', 'stylish-author-bio' )
				)
			),							
			/* ========== End: Author Social Media ========== */


		);

		return $settings;
	}

	/**
	 * Custom contact methods.
	 *
	 * @param  array $methods Old contact methods.
	 *
	 * @return array New contact methods.
	 */
	public function add_author_profile( $contactmethods ) {
		// Add new contact field in author profile

		$contactmethods['author_profession'] = __( 'Profession', 'stylish-author-bio' );
		$contactmethods['author_country'] 	 = __('Country', 'stylish-author-bio' ); 	

		$contactmethods['facebook_url']   = __( 'Facebook', 'stylish-author-bio' );
		$contactmethods['twitter_url']    = __( 'Twitter', 'stylish-author-bio' );
		$contactmethods['googleplus_url'] = __( 'Google Plus', 'stylish-author-bio' );
		$contactmethods['linkedin_url']   = __( 'LinkedIn', 'stylish-author-bio' );
		$contactmethods['flickr_url']     = __( 'Flickr', 'stylish-author-bio' );
		$contactmethods['tumblr_url']     = __( 'Tumblr', 'stylish-author-bio' );
		$contactmethods['vimeo_url']      = __( 'Vimeo', 'stylish-author-bio' );
		$contactmethods['youtube_url']    = __( 'YouTube', 'stylish-author-bio' );
		$contactmethods['instagram_url']  = __( 'Instagram', 'stylish-author-bio' );
		$contactmethods['pinterest_url']  = __( 'Pinterest', 'stylish-author-bio' );
		$contactmethods['behance_url']    = __( 'Behance', 'stylish-author-bio' );
		$contactmethods['blogger_url']    = __( 'Blogger', 'stylish-author-bio' );
		$contactmethods['delicious_url']  = __( 'Delicious', 'stylish-author-bio' );
		$contactmethods['digg_url']  	  = __( 'Digg', 'stylish-author-bio' );
		$contactmethods['dribble_url']    = __( 'Dribble', 'stylish-author-bio' );
		$contactmethods['myspace_url']    = __( 'Myspace', 'stylish-author-bio' );
		$contactmethods['picasa_url']     = __( 'Picasa', 'stylish-author-bio' );
		$contactmethods['reddit_url']     = __( 'Reddit', 'stylish-author-bio' );
		$contactmethods['skype_url']  	  = __( 'Skype', 'stylish-author-bio' );
		$contactmethods['stackoverflow_url']  = __( 'Stackoverflow', 'stylish-author-bio' );
		$contactmethods['wordpress_url']  = __( 'WordPress', 'stylish-author-bio' );																			
		$contactmethods['rss_url'] 		  = __('RSS URL', 'stylish-author-bio' );		

		// Remove old methods.
		unset( $contactmethods['aim'] );
		unset( $contactmethods['yim'] );
		unset( $contactmethods['jabber'] );

		return $contactmethods;
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @return null Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();

		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_style( 'wp-color-picker' );

			wp_enqueue_script( 'author-bio-box-admin', Stylish_Author_Bio::get_assets_url() . 'js/admin' . $suffix . '.js', array( 'jquery', 'wp-color-picker' ), Stylish_Author_Bio::VERSION, true );
		}
	}

	/**
	 * Register the administration menu.
	 *
	 * @return void
	 */
	public function add_plugin_admin_menu() {
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Stylish Author Bio', 'stylish-author-bio' ),
			__( 'Stylish Author Bio', 'stylish-author-bio' ),
			'manage_options',
			'stylish-author-bio',
			array( $this, 'display_plugin_admin_page' )
		);
	}

	/**
	 * Plugin settings form fields.
	 *
	 * @return void
	 */
	public function plugin_settings() {
		$settings = 'stylish_author_bio_settings';

		foreach ( $this->default_settings() as $key => $value ) {

			switch ( $value['type'] ) {
				case 'section':
					add_settings_section(
						$key,
						$value['title'],
						'__return_false',
						$value['menu']
					);
					break;
				case 'text':
					add_settings_field(
						$key,
						$value['title'],
						array( $this, 'text_element_callback' ),
						$value['menu'],
						$value['section'],
						array(
							'menu'        => $value['menu'],
							'id'          => $key,
							'class'       => 'small-text',
							'description' => isset( $value['description'] ) ? $value['description'] : ''
						)
					);
					break;
				case 'select':
					add_settings_field(
						$key,
						$value['title'],
						array( $this, 'select_element_callback' ),
						$value['menu'],
						$value['section'],
						array(
							'menu'        => $value['menu'],
							'id'          => $key,
							'description' => isset( $value['description'] ) ? $value['description'] : '',
							'options'     => $value['options']
						)
					);
					break;
				case 'color':
					add_settings_field(
						$key,
						$value['title'],
						array( $this, 'color_element_callback' ),
						$value['menu'],
						$value['section'],
						array(
							'menu'        => $value['menu'],
							'id'          => $key,
							'description' => isset( $value['description'] ) ? $value['description'] : ''
						)
					);
					break;

				default:
					break;
			}

		}

		// Register settings.
		register_setting( $settings, $settings, array( $this, 'validate_options' ) );
	}

	/**
	 * Text element fallback.
	 *
	 * @param  array $args Field arguments.
	 *
	 * @return string      Text field.
	 */
	public function text_element_callback( $args ) {
		$menu  = $args['menu'];
		$id    = $args['id'];
		$class = isset( $args['class'] ) ? $args['class'] : 'small-text';

		$options = get_option( $menu );

		if ( isset( $options[ $id ] ) ) {
			$current = $options[ $id ];
		} else {
			$current = isset( $args['default'] ) ? $args['default'] : '';
		}

		$html = sprintf( '<input type="text" id="%1$s" name="%2$s[%1$s]" value="%3$s" class="%4$s" />', $id, $menu, $current, $class );

		// Displays option description.
		if ( isset( $args['description'] ) ) {
			$html .= sprintf( '<p class="description">%s</p>', $args['description'] );
		}

		echo $html;
	}

	/**
	 * Select field fallback.
	 *
	 * @param  array $args Field arguments.
	 *
	 * @return string      Select field.
	 */
	public function select_element_callback( $args ) {
		$menu = $args['menu'];
		$id   = $args['id'];

		$options = get_option( $menu );

		// Sets current option.
		if ( isset( $options[ $id ] ) ) {
			$current = $options[ $id ];
		} else {
			$current = isset( $args['default'] ) ? $args['default'] : '';
		}

		$html = sprintf( '<select id="%1$s" name="%2$s[%1$s]">', $id, $menu );
		foreach( $args['options'] as $key => $label ) {
			$key = sanitize_title( $key );

			$html .= sprintf( '<option value="%s"%s>%s</option>', $key, selected( $current, $key, false ), $label );
		}
		$html .= '</select>';

		// Displays the description.
		if ( $args['description'] ) {
			$html .= sprintf( '<p class="description">%s</p>', $args['description'] );
		}

		echo $html;
	}

	/**
	 * Color element callback.
	 *
	 * @param  array $args Field arguments.
	 *
	 * @return string      Color field.
	 */
	public function color_element_callback( $args ) {
		$menu = $args['menu'];
		$id   = $args['id'];

		$options = get_option( $menu );

		if ( isset( $options[ $id ] ) ) {
			$current = $options[ $id ];
		} else {
			$current = isset( $args['default'] ) ? $args['default'] : '#333333';
		}

		$html = sprintf( '<input type="text" id="%1$s" name="%2$s[%1$s]" value="%3$s" class="stylish-author-bio-color-field" />', $id, $menu, $current );

		// Displays option description.
		if ( isset( $args['description'] ) ) {
			$html .= sprintf( '<p class="description">%s</p>', $args['description'] );
		}

		echo $html;
	}

	/**
	 * Valid options.
	 *
	 * @param  array $input options to valid.
	 *
	 * @return array        validated options.
	 */
	public function validate_options( $input ) {
		// Create our array for storing the validated options.
		$output = array();

		// Loop through each of the incoming options.
		foreach ( $input as $key => $value ) {

			// Check to see if the current option has a value. If so, process it.
			if ( isset( $input[ $key ] ) ) {

				// Strip all HTML and PHP tags and properly handle quoted strings.
				$output[ $key ] = sanitize_text_field( $input[ $key ] );
			}
		}

		return $output;
	}

	/**
	 * Render the settings page for this plugin.
	 */
	public function display_plugin_admin_page() {
		include_once 'views/html-plugin-settings.php';
	}

}

new Author_Bio_Box_Admin();
