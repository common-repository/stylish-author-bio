<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Shows the Author Bio.
 *
 * @return string Author Bio as HTML.
 */
function get_stylish_author_bio() {
	return Author_Bio_Box_Frontend::view( get_option( 'stylish_author_bio_settings' ) );
}

/**
 * Shows the Author Bio legacy.
 *
 * @return string Author Bio as HTML.
 */
function authorbbio_add_authorbox() {
	echo get_stylish_author_bio();
}
