<?php 
/*
Plugin Name: Campaign Monitor for WordPress
Plugin URI: http://sophisticatedmonkey.ca/
Description: Add Campaign Monitor functionality into the WordPress admin section
Author: Terrence Gonsalves
Version: 1.0
Author URI: http://sophisticatedmonkey.ca/
License: GPLv3

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// if this file is called directly, abort.
if (!defined( 'WPINC' )) {
	die;
}

// Campaign Monitor API
if (!class_exists('CS_REST_General'))
	require_once(plugin_dir_path( __FILE__ ) . 'api/csrest_general.php');

if (!class_exists('CS_REST_Campaigns'))
	require_once(plugin_dir_path( __FILE__ ) . 'api/csrest_campaigns.php');

require_once(plugin_dir_path( __FILE__ ) . 'campign-monitor-wp-class.php');

if (is_admin())
    $cmwp_instance = new CampaignMonitorWordPress();

// add the settings link to the plugins page
function cmwp_plugin_settings_link($links)
{ 
    $settings_link = '<a href="options-general.php?page=campaign-monitor-settings">Settings</a>'; 
    array_unshift($links, $settings_link); 

    return $links; 
}

$plugin = plugin_basename( __FILE__ ); 

add_filter( 'plugin_action_links_' . $plugin, 'cmwp_plugin_settings_link' );

/* @end of file */