<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Author Bio Box Frontend class.
 */
class Author_Bio_Box_Frontend {

	/**
	 * Initialize the frontend actions.
	 */
	public function __construct() {
		// Load public-facing style sheet.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );

		// Display the box.
		add_filter( 'the_content', array( $this, 'display' ), 9999 );
	}

	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @return void
	 */
	public function enqueue_styles() {
		wp_register_style( 'stylish-author-bio-styles', Stylish_Author_Bio::get_assets_url(). 'css/stylish-author-style.css', array(), Stylish_Author_Bio::VERSION, 'all' );
	}

	/**
	 * Checks, where Author Bio will be shown
	 *
	 * @param  array $settings Author Bio settings.
	 *
	 * @return bool
	 */
	protected function is_display( $settings ) {
		$display = false;

		if ( 'posts' == $settings['display'] ) {
			$display = is_single();
		}else if ( 'pages' == $settings['display'] ) {
			$display = is_page();
		}else if ( 'home_posts' == $settings['display'] ) {
			$display = is_single() || is_home();
		}else if ( 'author_pages' == $settings['display'] ) {
			$display = is_author();
		}

		return apply_filters( 'authorbiobox_display', $display);
	}

	/**
	 * HTML of the box.
	 *
	 * @param  array $settings Author Bio Box settings.
	 *
	 * @return string Author Bio Box HTML.
	 */
	public static function view( $settings ) {

		// Load the styles.
		wp_enqueue_style( 'stylish-author-bio-styles' );

		global $post;

		// Get author's display name 
		$display_name = get_the_author_meta( 'display_name', $post->post_author );
		$author_title = get_the_author_meta( 'author_profession' );
		$author_country = get_the_author_meta( 'author_country' );

		// If display name is not available then use nickname as display name
		if ( empty( $display_name ) )
		$display_name = get_the_author_meta( 'nickname', $post->post_author );

		// Get author's biographical information or description
		$user_description = get_the_author_meta( 'user_description', $post->post_author );

		// Get author's website URL 
		$user_website = get_the_author_meta('url', $post->post_author);

		// Get link to the author archive page
		$user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));

		// Set the gravatar size.
		$gravatar = ! empty( $settings['gravatar'] ) ? $settings['gravatar'] : 70;

		$author_details = '';
		$content = '';

		/*-Author Bio Background Style*/
		$author_bio_background_style = sprintf(
			'background-color: %1$s; border: %2$spx solid %3$s;',
			$settings['author_bio_background_color'],
			$settings['author_bio_border_size'],
			$settings['author_bio_border_color']
		);


		/* Author Bio Gravator Style*/
		$gravatar_shape = ($settings['gravatar_shape']=='circle') ? 'border-radius:50%' : 'border-radius:0%';

		$author_bio_gravator_style = sprintf(
			'border: %1$spx %2$s %3$s;',
			$settings['gravatar_border_size'],
			$settings['gravatar_border_style'],
			$settings['gravatar_border_color']
		);			
		//gravatar_shape


		/* Author Heading */
		$author_bio_heading_style = sprintf(
			'color:%1$s; font-size:%2$spx;',
			$settings['author_heading_color'],
			$settings['author_heading_font_size']
		);	
	

		/*Author Sub Heading*/
		$author_sub_heading_style = sprintf(
			'color:%1$s; font-size:%2$spx;',
			$settings['author_sub_heading_color'],
			$settings['author_sub_heading_font_size']
		);
	
		/*Author Description*/
		$author_description_style = sprintf(
			'color:%1$s; font-size:%2$spx;',
			$settings['author_description_color'],
			$settings['author_description_font_size']
		);

		if($settings['author_social_icon_shape']=='circle'){
			$icon_shape = 'circle';
		}else if($settings['author_social_icon_shape']=='rounded'){
			$icon_shape = 'rounded';
		}else{
			$icon_shape = '';
		}

		/*Social Media*/
		$author_social_style = sprintf(
			'font-size:%1$spx;', $settings['author_social_icon_size']
		);


		if ( ! empty( $display_name ) )
			$author_details .= '
				<div class="author-details">

					<!--Start: author-bio-wrapper-->
					<div class="author-bio-wrapper">
		  				
		  				<div class="author-bio-img-wrapper">
			  				<div class="author-bio-img" style="'.$author_bio_gravator_style.' '.$gravatar_shape.'">'
								.get_avatar( get_the_author_meta('user_email'), $gravatar).
							'</div>
						</div>
						
						<div class="author-bio-title">
						 	<h2 class="author-name">
						 		<a href="'.$user_posts.'" style="'.$author_bio_heading_style.'">'. $display_name. '</a>
						 	</h2>'
						  .'<h6 class="author-title" style="'.$author_sub_heading_style.'">'.$author_title. '</h6> 
						  	<h6 class="author-title" style="'.$author_sub_heading_style.'">'.$author_country.'</h6>';


						$author_details .= '
							<div class="author-social-profile">
								<ul class="author-icons">';

								require_once('author-social-media.php');

						$author_details .= '
								</ul> 
							</div>
						</div>

	  					<div class="cleared"></div>
					</div>
					<!--End: author-bio-wrapper-->
					
					<div class="author-bio-description" style="'.$author_description_style.'">'
					. nl2br( $user_description ). 
					'</div>
				</div>';//author_details 


		// Pass all this info to post content  
		$content = $content . '<footer class="author-bio-section" style="'.$author_bio_background_style.'">' . $author_details . '</footer>';

		return $content;
	}

	/**
	 * Insert the box in the content.
	 *
	 * @param  string $content WP the content.
	 *
	 * @return string WP the content with Author Bio Box.
	 */
	public function display( $content ) {
		// Get the settings.
		$settings = get_option( 'stylish_author_bio_settings' );

		if ( $this->is_display( $settings ) ) {
			return $content . self::view( $settings );
		}

		return $content;
	}

}

new Author_Bio_Box_Frontend();
