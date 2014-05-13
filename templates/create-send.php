<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
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

	$wrap = new CS_REST_General(NULL);

	$result = $wrap->get_apikey($options['cmwp_username'], $options['cmwp_password'], $options['cmwp_url']);

	if ($result->was_successful()) {
		$cmwp_api_key = $result->response->ApiKey;

		add_option( 'cmwp_options', array('cmwp_api_key' => $cmwp_api_key) );
	} else {
		echo 'Failed with code ' . $result->http_status_code . '<br>';
	}

	//echo $options['cmwp_api_key'];

	// if the api key isn't set force the user to the settings page
	if (!$options) {
	?>
		<p>You have not completed the setup for Campaign Monitor for WordPress, you will have to do so first. Please go to the 
			<a href="options-general.php?page=campaign-monitor-settings">settings</a> page.</p>
	<?php
	} else {
	?>
		<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

		<div id="new-slate" class="overview">

            <h3>Design your first campaign</h3>
            <p>Get started by creating your first email campaign. We'll walk you through the<br/>
                entire process, and you can choose how you'd like to pay before you send.</p>
            <a href="/campaign/create/new" class="button primary huge forward">Get started</a>

            
            <div class="group">

                <section class="wide">
                    <h3>Test an email design</h3>
                    <p>See screenshots of your email in more than 20 email clients, and make sure it passes popular spam filters before you send.</p>
                    <a href="/createsend/dstesting.aspx" class="secondary">Start a test</a>
                </section>

            </div>
            
        </div>
	<?php } ?>