<?php 
/**
 * Campaign Monitor for WordPress.
 *
 * @package   CampaignMonitorWordPress
 * @author    Terrence Gonsalves <terrence@sophisticatedmonkey.ca>
 * @license   GPL-2.0+
 * @link      http://sophisticatedmonkey.ca
 * @copyright 2014 Terrence Gonsalves
 */

class CampaignMonitorWordPress {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	protected $version = '1.0.0';

	/**
     * Holds the values to be used in the fields callbacks
	 *
	 * @since   1.0.0
	 *
	 * @var     array
     */
    private $options;

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since     1.0.0
	 */
	public function __construct() 
	{

		// register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
		register_activation_hook( __FILE__, array($this, 'cmwp_on_activate') );
		register_deactivation_hook( __FILE__, array($this, 'cmwp_on_deactivate') );

		// add the options page and menu item.
		add_action( 'admin_menu', array($this, 'cmwp_add_admin_menu') );

		// load plugin settings
		add_action( 'admin_init', array($this, 'cmwp_register_settings') );
	}


	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    
	 */
	public static function cmwp_on_activate() 
	{
		// TODO: define activation functionality here
	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    
	 */
	public static function cmwp_on_deactivate() 
	{
		// TODO: define deactivation functionality here
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    
	 */
	public function enqueue_cmwp_admin_styles() 
	{
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    
	 */
	public function enqueue_cmwp_admin_scripts() 
	{
	}

	/**
	 * Register the administration menu into the WordPress Dashboard menu only for users that can manage options.
	 *
	 * @since    1.0.0
	 */
	public function cmwp_add_admin_menu() 
	{
		if (current_user_can( 'manage_options' )) {
			add_options_page( 
				'Campaign Monitor Settings', 
				'Campaign Monitor', 
				'manage_options', 
				'campaign-monitor-settings',
				 array($this, 'cmwp_display_admin') 
			); 
		}
	}


	/**
	 * Registers the settings for this plugin.
	 *
	 * @since    1.0.0
	 */

	public function cmwp_register_settings() 
	{
		register_setting( 
			'option-group', 
			'cmwp_options', 
			array($this, 'sanitize')
		);

		add_settings_section( 
			'cmwp_setting_id', 
			'',  
			'',  
			'campaign-monitor-settings' 
		);  

        add_settings_field( 
        	'cmwp_username', 
        	'Username',  
        	array($this, 'cmwp_username_callback'),  
        	'campaign-monitor-settings',  
        	'cmwp_setting_id' 
        );      

        add_settings_field( 
        	'cmwp_password', 
        	'Password', 
        	array($this, 'cmwp_password_callback'), 
        	'campaign-monitor-settings', 
        	'cmwp_setting_id' 
        );      

        add_settings_field( 
        	'cmwp_url', 
        	'Account URL', 
        	array($this, 'cmwp_url_callback'), 
        	'campaign-monitor-settings',
        	'cmwp_setting_id' 
        );
	}

    /** 
     * Get the settings option array and print one of its values
     */
    public function cmwp_username_callback() 
    {
        printf(
            '<input type="text" id="cmwp_username" name="cmwp_options[cmwp_username]" class="regular-text" value="%s" />',
            isset($this->options['cmwp_username'] ) ? esc_attr( $this->options['cmwp_username'] ) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function cmwp_password_callback() 
    {
        printf(
            '<input type="password" id="cmwp_password" name="cmwp_options[cmwp_password]" class="regular-text" value="%s" />',
            isset($this->options['cmwp_password']) ? esc_attr( $this->options['cmwp_password'] ) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function cmwp_url_callback() 
    {
        printf(
            '<input type="text" id="cmwp_url" name="cmwp_options[cmwp_url]" class="regular-text" placeholder="ex: client-name.createsend.com" value="%s">',
            isset($this->options['cmwp_url']) ? esc_attr( $this->options['cmwp_url'] ) : ''
        );
    }

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function cmwp_display_admin() 
	{
		$this->options = get_option( 'cmwp_options' );

	    include('templates/campaign-monitor-wp-settings.php');
	}

	/**
     * Sanitize each setting field as needed
	 *
	 * @since     1.0.0
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize($input)
    {
        $new_input = array();

        if (isset($input['cmwp_username']))
            $new_input['cmwp_username'] = sanitize_text_field( $input['cmwp_username'] );

        if (isset($input['cmwp_password']))
            $new_input['cmwp_password'] = sanitize_text_field( $input['cmwp_password'] );

        if (isset($input['cmwp_url']))
            $new_input['cmwp_url'] = sanitize_text_field( $input['cmwp_url'] );

        return $new_input;
    }
}

/* @end of file */