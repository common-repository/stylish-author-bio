<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$facebook_profile 	= get_the_author_meta( 'facebook_url' );
$google_profile 	= get_the_author_meta( 'googleplus_url' );
$twitter_profile 	= get_the_author_meta( 'twitter_url' );
$linkedin_profile 	= get_the_author_meta( 'linkedin_url' );
$youtube_profile 	= get_the_author_meta( 'youtube_url' );
$flickr_profile 	= get_the_author_meta( 'flickr_url' );
$tumblr_profile 	= get_the_author_meta( 'tumblr_url' );
$vimeo_profile 		= get_the_author_meta( 'vimeo_url' );
$instagram_profile 	= get_the_author_meta( 'instagram_url' );
$pinterest_profile 	= get_the_author_meta( 'pinterest_url' );
$behance_profile 	= get_the_author_meta( 'behance_url' );
$blogger_profile 	= get_the_author_meta( 'blogger_url' );
$delicious_profile 	= get_the_author_meta( 'delicious_url' );
$digg_profile 		= get_the_author_meta( 'digg_url' );
$dribble_profile 	= get_the_author_meta( 'dribble_url' );
$myspace_profile 	= get_the_author_meta( 'myspace_url' );
$picasa_profile 	= get_the_author_meta( 'picasa_url' );
$reddit_profile 	= get_the_author_meta( 'reddit_url' );
$skype_profile 		= get_the_author_meta( 'skype_url' );
$stackoverflow_profile 	= get_the_author_meta( 'stackoverflow_url' );
$wordpress_profile 		= get_the_author_meta( 'wordpress_url' );
$rss_url 			= get_the_author_meta( 'rss_url' );


if ( ! empty( $user_website ) ) {
	$author_details .= '<li class="weblink"><a href="'.$user_website.' "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'dribble</span></a></li>';
}

if ( $facebook_profile && $facebook_profile != '' ) {
	$author_details .= '<li class="facebook"><a href="' . esc_url($facebook_profile).'" "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'facebook</span></a></li>';
}

if ( $google_profile && $google_profile != '' ) {
	$author_details .= '<li class="google-plus"><a href="' . esc_url($google_profile).'" "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'googleplus</span></a></li>';
}

if ( $twitter_profile && $twitter_profile != '' ) {
	$author_details .= '<li class="twitter"><a href="' . esc_url($twitter_profile).'" "target="_blank" rel="nofollow">
		<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'twitterbird</span></a></li>';
}

if ( $linkedin_profile && $linkedin_profile != '' ) {
	$author_details .= '<li class="linkedin"><a href="' . esc_url($linkedin_profile).'" "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'linkedin</span></a></li>';
}

if ( $youtube_profile && $youtube_profile != '' ) {
	$author_details .= '<li class="youtube"><a href="' . esc_url($youtube_profile).'" "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'youtube</span></a></li>';
}

if ( $flickr_profile && $flickr_profile != '' ) {
	$author_details .= '<li class="flickr"><a href="' . esc_url($flickr_profile).'" "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'flickr</span></a></li>';
}

if ( $tumblr_profile && $tumblr_profile != '' ) {
	$author_details .= '<li class="tumblr"><a href="' . esc_url($tumblr_profile).'" "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'tumblr</span></a></li>';
}

if ( $vimeo_profile && $vimeo_profile != '' ) {
	$author_details .= '<li class="vimeo"><a href="' . esc_url($vimeo_profile).'" "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'vimeo</span></a></li>';
}

if ( $instagram_profile && $instagram_profile != '' ) {
	$author_details .= '<li class="instagram"><a href="' . esc_url($instagram_profile).'" "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'instagram</span></a></li>';
}

if ( $pinterest_profile && $pinterest_profile != '' ) {
	$author_details .= '<li class="pinterest"><a href="' . esc_url($pinterest_profile).'" "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'pinterest</span></a></li>';
}

if ( $blogger_profile && $blogger_profile != '' ) {
	$author_details .= '<li class="blogger"><a href="' . esc_url($blogger_profile).'" "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'blogger</span></a></li>';
}

if ( $behance_profile && $behance_profile != '' ) {
	$author_details .= '<li class="behance"><a href="' . esc_url($behance_profile).'" "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'behance</span></a></li>';
}

if ( $delicious_profile && $delicious_profile != '' ) {
	$author_details .= '<li class="delicious"><a href="' . esc_url($delicious_profile).'" "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'delicious</span></a></li>';
}

if ( $digg_profile && $digg_profile != '' ) {
	$author_details .= '<li class="digg"><a href="' . esc_url($digg_profile).'" "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'digg</span></a></li>';
}

if ( $dribble_profile && $dribble_profile != '' ) {
	$author_details .= '<li class="dribble"><a href="' . esc_url($dribble_profile).'" "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'dribble</span></a></li>';
}

if ( $myspace_profile && $myspace_profile != '' ) {
	$author_details .= '<li class="myspace"><a href="' . esc_url($myspace_profile).'" "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'myspace</span></a></li>';
}

if ( $picasa_profile && $picasa_profile != '' ) {
	$author_details .= '<li class="picasa"><a href="' . esc_url($picasa_profile).'" "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'picasa</span></a></li>';
}

if ( $reddit_profile && $reddit_profile != '' ) {
	$author_details .= '<li class="reddit"><a href="' . esc_url($reddit_profile).'" "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'reddit</span></a></li>';
}

if ( $skype_profile && $skype_profile != '' ) {
	$author_details .= '<li class="skype"><a href="' . esc_url($skype_profile).'" "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'skype</span></a></li>';
}

if ( $stackoverflow_profile && $stackoverflow_profile != '' ) {
	$author_details .= '<li class="stackoverflow"><a href="' . esc_url($stackoverflow_profile).'" "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'stackoverflow</span></a></li>';
}

if ( $wordpress_profile && $wordpress_profile != '' ) {
	$author_details .= '<li class="wordpress"><a href="' . esc_url($wordpress_profile).'" "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'wordpress</span></a></li>';
}

if ( $rss_url && $rss_url != '' ) {
	$author_details .= '<li class="author-rss"><a href="' . esc_url($rss_url).'" "target="_blank" rel="nofollow">
	<span class="author-social-icon" style="'.$author_social_style.'">'.$icon_shape.'rss</span></a></li>';
}	
?>