<?php
/*
Plugin Name: Paid Memberships Pro - Better Logins Report Add On
Plugin URI: http://www.paidmembershipspro.com/wp/pmpro-better-logins-report/
Description: Adds login, view, and visit stats for "This Week" and "This Year".
Version: .2.3.1
Author: Stranger Studios
Author URI: http://www.strangerstudios.com
*/

function pmproblr_init()
{
	//make sure PMPro is activated
	if(!defined('PMPRO_VERSION'))
		return;

	//remove the default login report
	global $pmpro_reports;
	unset($pmpro_reports['login']);		

	//include ours	
	require_once(dirname(__FILE__) . "/reports/better-logins.php");

	//some functions we might need
	if(!function_exists('pmpro_isDateThisWeek'))
	{
		function pmpro_isDateThisWeek($str)
		{
			$now = current_time('timestamp');
			$this_week = intval(date("W", $now));
			$this_year = intval(date("Y", $now));

			$date = strtotime($str, $now);
			$date_week = intval(date("W", $date));
			$date_year = intval(date("Y", $date));

			if($date_week === $this_week && $date_year === $this_year)
				return true;
			else
				return false;
		}
	}
		
	if(!function_exists('pmpro_isDateThisMonth'))
	{
		function pmpro_isDateThisMonth($str)
		{
			$now = current_time('timestamp');
			$this_month = intval(date("n", $now));
			$this_year = intval(date("Y", $now));

			$date = strtotime($str, $now);
			$date_month = intval(date("n", $date));
			$date_year = intval(date("Y", $date));

			if($date_month === $this_month && $date_year === $this_year)
				return true;
			else
				return false;
		}
	}
		
	if(!function_exists('pmpro_isDateThisYear'))
	{
		function pmpro_isDateThisYear($str)
		{
			$now = current_time('timestamp');
			$this_year = intval(date("Y", $now));

			$date = strtotime($str, $now);
			$date_year = intval(date("Y", $date));

			if($date_year === $this_year)
				return true;
			else
				return false;
		}
	}
}
add_action('init', 'pmproblr_init');

/*
	Deprecated. Functionality has been moved into the pmproblr_getValues function
	in reports/better-logins.php.

	When first installing this plugin, the view/visits/logins reporting options
	won't have elements that this plugin will be expecting.
	
	This function fixes them.
*/
function pmproblr_fixOptions($option)
{
	$now = current_time('timestamp');

	if(!isset($option['week']))
		$option['week'] = 0;
	if(!isset($option['thisweek']))
		$option['thisweek'] = date('W', $now);
	
	if(!isset($option['ytd']))
		$option['ytd'] = 0;
	if(!isset($option['thisyear']))
		$option['thisyear'] = date('Y', $now);
		
	return $option;
}

/*
Function to add links to the plugin action links
*/
function pmproblr_add_action_links($links) {
	$new_links = array(
			'<a href="' . get_admin_url(NULL, "admin.php?page=pmpro-reports&report=better_login") . '">View Report</a>',
	);
	return array_merge($new_links, $links);
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'pmproblr_add_action_links');

/*
Function to add links to the plugin row meta
*/
function pmproblr_plugin_row_meta($links, $file) {
	if(strpos($file, 'pmpro-better-logins-report.php') !== false)
	{
		$new_links = array(
			'<a href="' . esc_url('http://www.paidmembershipspro.com/add-ons/plus-add-ons/better-login-view-visits-report/') . '" title="' . esc_attr( __( 'View Documentation', 'pmpro' ) ) . '">' . __( 'Docs', 'pmpro' ) . '</a>',
			'<a href="' . esc_url('http://paidmembershipspro.com/support/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'pmpro' ) ) . '">' . __( 'Support', 'pmpro' ) . '</a>',
		);
		$links = array_merge($links, $new_links);
	}
	return $links;
}
add_filter('plugin_row_meta', 'pmproblr_plugin_row_meta', 10, 2);
