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
    
	<?php echo '<h2>' . __( 'Campaign Monitor for WordPress Setup', 'cmwp' ) . '</h2>'; ?>

    <form method="post" action="options.php">
    	<?php 
    	settings_fields( 'cmwp-option-group' ); 
    	do_settings_sections( 'campaign-monitor-settings' ); 
    	submit_button( __( 'Save Settings', 'cmwp') );
    	?>
    </form>
</div>