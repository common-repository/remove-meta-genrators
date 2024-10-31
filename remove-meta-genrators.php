<?php
/*
Plugin Name: Wordpress Remove Meta genrators 
Version: 1.0
Plugin URL: https://www.ehostcloud.com
Author: Ehostcloud Services
Author URI: https://www.ehostcloud.com
Description: It removes meta-generators of visual composer,layer slider,revoution slider, wordpress. Also removes wordpress version. Change Wordpress weocome text Howdy to welcome. Remove resource versions from URL
*/
//Remove wp generators like theme,slider
remove_action('wp_head', 'wp_generator');

add_action('init', 'ehost_myoverride', 100);

function ehost_myoverride() {

    remove_action('wp_head', array(visual_composer(), 'addMetaData'));

}

function ehost_remove_revslider_meta_tag() {

    return '';

}

add_filter( 'revslider_meta_generator', 'ehost_remove_revslider_meta_tag' );

function ehost_remove_layerslider_meta_tag($html) {

    return '';

}
add_filter( 'ls_meta_generator', 'ehost_remove_layerslider_meta_tag' );

/******************************************************************/
//Get Rid of “Howdy”
add_filter('gettext', 'ehost_change_howdy', 10, 3);

function ehost_change_howdy($translated, $text, $domain) {

    if (!is_admin() || 'default' != $domain)
        return $translated;

    if (false !== strpos($translated, 'Howdy'))
        return str_replace('Howdy', 'Welcome', $translated);

    return $translated;
}

// Hide WordPress Version Info
function ehost_hide_wordpress_version() {
	return '';
}
add_filter('the_generator', 'ehost_hide_wordpress_version');

// Remove WordPress Meta Generator
remove_action('wp_head', 'wp_generator');

// Remove WordPress Version Number In URL Parameters From JS/CSS
function ehost_hide_wordpress_version_in_script($src, $handle) {
    $src = remove_query_arg('ver', $src);
	return $src;
}
add_filter( 'style_loader_src', 'ehost_hide_wordpress_version_in_script', 10, 2 );
add_filter( 'script_loader_src', 'ehost_hide_wordpress_version_in_script', 10, 2 );

?>
