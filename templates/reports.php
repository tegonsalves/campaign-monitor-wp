<?php
/**
 * Represents the view for the reports page.
 *
 * @package   CampaignMonitorWordPress
 * @author    Terrence Gonsalves <terrence@sophisticatedmonkey.ca>
 * @license   GPL-2.0+
 * @link      http://sophisticatedmonkey.ca
 * @copyright 2014 Terrence Gonsalves
 */
?>

<div class="wrap">

	<?php screen_icon( 'cm_icon' ); ?>
	<h1><img class="cm-icon" src="<?php echo plugins_url( 'images/cm-icon.png' , dirname(__FILE__) ); ?>" alt="<?php _e( 'Campaign Monitor for WordPress','cmwp' ); ?>"> Campaign Monitor for WordPress</h1>

	<?php
	$options = get_option( 'cmwp_options' );

	// if the api key isn't set force the user to the settings page
	if (!$options) {
	?>
		<p>You have not completed the setup for Campaign Monitor for WordPress, you will have to do so first. Please go to the 
			<a href="options-general.php?page=campaign-monitor-settings">settings</a> page.</p>
	<?php
	} else {
	?>
		<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

		<div class="reports">

            <h3>Send your first campaign to see reports</h3>
            <p>As soon as you send a campaign, we'll show you detailed reports on the results.</p>
            <a href="/campaign/create/new" class="button primary huge forward">Get started</a>

        </div>
	<?php } ?>