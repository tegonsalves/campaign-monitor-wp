<?php
/**
 * The view for the plugin settings.
 *
 * @package   CampaignMonitorWordPress
 * @author    Terrence Gonsalves <terrence@sophisticatedmnkey.ca>
 * @license   GPL-2.0+
 * @link      http://sophisticatedmonkey.ca
 * @copyright 2014 Terrence Gonsalves
 */
?>
<div class="wrap">
    
	<?php echo '<h2>' . __( 'Campaign Monitor Setup', 'cmwp' ) . '</h2>'; 

	/*
	
	if(isset($_POST['submit'])) {

		$wrap = new CS_REST_General(NULL);

		$result = $wrap->get_apikey($cmwp_username, $cmwp_password, $cmwp_url);

		if ($result->was_successful()) {
			$cmwp_api_key = $result->response->ApiKey;
			update_option( 'cmwp_api_key', $cmwp_api_key );
		} else {
			echo 'Failed with code ' . $result->http_status_code . '<br>';
		}
		?>
    }
    */
    ?>

    <form method="post" action="options.php">
    	<?php 
    	settings_fields( 'option-group' ); 
    	do_settings_sections( 'campaign-monitor-settings' ); 
    	submit_button( __( 'Save Settings', 'cmwp') );
    	?>
    </form>
</div>