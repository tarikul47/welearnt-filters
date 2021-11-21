<?php

/**
 * Plugin Name: welearnt filters
 * Plugin URI: htpp://onlytarikul.com
 * Author: Tarikul Islam
 * Author URI: htpp://onlytarikul.com
 * Description: WordPress filters describe 
 * Version: 0.1.0
 * License: 0.1.0
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: welearnt-filters
 */

if (!defined('ABSPATH')) exit;

/**
 * Add a body class in Login page 
 * screenshot - https://prnt.sc/20cdiiu
 */

function welearnt_extra_class($classes)
{
	var_dump($classes);
	$classes[] = 'my-login-class';
	return $classes;
}
add_filter('login_body_class', 'welearnt_extra_class');

/**
 * all attachment add extra filed
 * screenshot - https://prnt.sc/20cdtzg
 */


function my_add_attachment_location_field($form_fields, $post)
{
	$field_value = get_post_meta($post->ID, 'location', true);
	$form_fields['location'] = array(
		'value' => $field_value ? $field_value : '',
		'label' => __('Location'),
		'helps' => __('Set a location for this attachment')
	);
	return $form_fields;
}
add_filter('attachment_fields_to_edit', 'my_add_attachment_location_field', 10, 2);


/**
 * attachment data save process by action
 */

function my_save_attachment_location($attachment_id)
{
	if (isset($_REQUEST['attachments'][$attachment_id]['location'])) {
		$location = $_REQUEST['attachments'][$attachment_id]['location'];
		update_post_meta($attachment_id, 'location', $location);
	}
}
add_action('edit_attachment', 'my_save_attachment_location');
