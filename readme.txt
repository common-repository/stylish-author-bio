=== Stylish Author Bio ===
Contributors: bdstar
Tags: author bio, wordpress, plugin, social, stylish author bio plugin, author biography, author profile, author social icons, Behance, blogger, dribbble, Facebook, flickr, github, google plus, instagram, linkedin, pinterest, shortcode, tumblr, twitter, vimeo, wordpress, yahoo, youtube, author box, author profile, author social icons, post author, responsive author box, user profile
Requires at least: 3.5
Tested up to: 4.7
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Display 100% responsive stylish author's biography with social icons in bottom of the posts/pages.

== Description ==

Stylish Author Bio is a responsive author content at the end of your posts or pages, showing the author name, country, author profession, author gravatar and author description. It also adds over 20+ social profile fields on WordPress user profile screen, allowing to display the author social icons with different style.

= Contribute =

You can contribute to this source code in [GitHub] (https://github.com/bdstar/stylish-author-bio) page.

= Credits =

* [MONO SOCIAL ICONS FONT] (http://drinchev.github.io/monosocialiconsfont/)

== Installation ==

* Upload plugin files to your plugins folder, or install using WordPress built-in Add New Plugin installer;
* Activate the plugin;
* You can fill up your biographical info(Profession, Country) and social media links from the deshboard "User" > "Your Profile"
* Go to admin deshboard "Settings" -> "Stylish Author Bio"
* And change the options as your want.
* You can display the Author Bio Section directly into anywhere in your theme using: 

<?php
	if ( function_exists( 'get_stylish_author_bio' ) ) {
		echo get_stylish_author_bio();
	}
?>

== Frequently Asked Questions(FAQ) ==

> What is the compatible wordpress version for this plugin?
  => I have tested it in latest wordpress version 4.6.1. But this plugin is compatible for wordpress 3.5 or higher(recommended) 

> What is the plugin license?
  => This plugin is released under a GPL license.

== Screenshots ==

1. Settings page of this plugin
2. Set the "Author Profile" page.
3. Style-1: Circle social icon in Desktop
4. Style-2: Circle social icon in Mobile
5. Style-3: Square social icon in Desktop
6. Style-4: Square social icon in Mobile
7. Style-5: Normal social icon in Desktop
8. Style-6: Normal social icon in Mobile

== Changelog ==

= 1.0.0 =

* Initial version.

== License ==

Stylish Author Bio is free WordPress Plugin, that's why you can redistribute it and/or modify it under the terms of the GNU General Public License.
