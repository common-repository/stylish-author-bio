<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="wrap">

	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	<form method="post" action="options.php">
		<?php
			settings_fields( 'stylish_author_bio_settings' );
			do_settings_sections( 'stylish_author_bio_settings' );
			submit_button();
		?>
	</form>
</div>
