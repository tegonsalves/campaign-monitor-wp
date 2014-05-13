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

	// if the api key isn't set force the user to the settings page
	if (!$options) {
	?>
		<p>You have not completed the setup for Campaign Monitor for WordPress, you will have to do so first. Please go to the 
			<a href="options-general.php?page=campaign-monitor-settings">settings</a> page.</p>
	<?php
	} else {
	?>
		<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

		<div class="overview">
                
                <h3>Design your first campaign</h3>
                <p><strong>Welcome to Campaign Monitor</strong>. Get started by creating your first email campaign. We'll walk you through the entire process, and you can choose how you'd like to pay before you send.</p>
                <a href="/campaign/create/new" class="button primary huge forward">Get started</a>

                <div class="group">
                
                    <section>
                        <h3>Already have a list?</h3>
                        <p>Fantastic! Import your existing list of subscribers with a few clicks.</p>
                        <a  href="/subscribers/" class="secondary">Import your subscribers</a>
                    </section>
                    
                    <section>
                        <h3>Build an audience</h3>
                        <p>Make it easy for people to join your list by adding a signup form to your site.</p>
                        <a href="/subscribers/grow/1339B3D8AECDD7C5" class="secondary">Create a signup form</a>
                    </section>  
                                      
                </div>            
        </div>
	<?php } ?>