<?php 
/**
 * Campaign Monitor for WordPress Custom Post Type.
 *
 * @package   CampaignMonitorWordPress
 * @author    Terrence Gonsalves <terrence@sophisticatedmonkey.ca>
 * @license   GPL-2.0+
 * @link      http://sophisticatedmonkey.ca
 * @copyright 2014 Terrence Gonsalves
 */

class CampaignMonitorWordPressPostType {

	const POST_TYPE = "cmwp-post-type-template";

	/**
     * Holds the value to be used for the post typr
	 *
	 * @since   1.0.0
	 *
	 * @var     string
     */
    private $post_type = 'cmwp-post-type';

    /**
	 * Initialize the plugin.
	 *
	 * @since     1.0.0
	 */
    public function __construct()
	{
		// register actions
		add_action( 'init', array($this, 'cmwp_init') );
		add_action( 'admin_head', array($this, 'add_menu_icons_styles') );
		//add_action( 'admin_init', array($this, 'cmwp_admin_init') );
	}

	/**
	 * Hook into WP's init action hook.
	 *
	 * @since     1.0.0
	 */
	public function cmwp_init()
	{
	    // initialize Post Type
	    $this->cmwp_create_post_type();

	    add_action( 'save_post', array($this, 'cmwp_save_post') );
	} 

	/**
	 * Create the post type.
	 *
	 * @since     1.0.0
	 */
	public function cmwp_create_post_type()
	{		
		register_post_type( $this->post_type,
	        array(
	            'labels' => array(
	                'name' => __( 'Campaign Monitor', 'cmwp' ),
	                'singular_name' => __( 'Campaign Monitor', 'cmwp' ),
					'menu_name' => __( 'Campaign Monitor', 'cmwp' )
	            ),
	            
				'hierarchical'        => true,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => true,
				'show_in_admin_bar'   => true,
				'menu_position'       => 20,
				'menu_icon'           => '',
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
	            'description' => __( 'This is a sample post type meant only to illustrate a preferred structure of plugin development', 'cmwp'),
	            'supports' => array(
	                'title', 'editor', 
	            ),
	        )
	    );
	} 

	/**
	 * Adding a custom icon.
	 *
	 * @since     1.0.0
	 */
	public function add_menu_icons_styles()
	{
	?>
	 
		<style>
		#adminmenu .menu-icon-cmwp-post-type div.wp-menu-image:before {
			content: "\f466";
		}
		</style>
	 
	<?php
	}

	/**
	 * Save the custom post.
	 *
	 * @since     1.0.0
	 */

	public function cmwp_save_post($post_id)
	{
	    // verify if this is an auto save routine. 
	    // if it is our form has not been submitted, so we dont want to do anything
	    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
	        return;
	    }

	    if (isset($_POST['post_type']) && $_POST['post_type'] == self::POST_TYPE && current_user_can( 'edit_post', $post_id )) {
	        foreach ($this->_meta as $field_name) {
	            
	            // update the post's meta field
	            update_post_meta( $post_id, $field_name, $_POST[$field_name] );
	        }
	    } else {
	        return;
	    }
	}

	/**
	 * Hook into WP's admin_init action hook
	 *
	 * @since     1.0.0
	 */
	public function cmwp_admin_init()
	{           
	    // add metaboxes
	    add_action( 'add_meta_boxes', array($this, 'cmwp_add_meta_boxes') );
	}

	/**
	 * Hook into WP's add_meta_boxes action hook
	 *
	 * @since     1.0.0
	 */
	public function cmwp_add_meta_boxes()
	{
	    // add this metabox to every selected post
	    add_meta_box( 
	        'wp_plugin_template_' . self::POST_TYPE . '_section',
	        ucwords(str_replace("_", " ", self::POST_TYPE)) . ' Information',
	        array(&$this, 'cmwp_add_inner_meta_boxes'),
	        self::POST_TYPE
	    );                  
	}

	/**
	 * Called off of the add meta box
	 *
	 * @since     1.0.0
	 */     
	public function cmwp_add_inner_meta_boxes($post)
	{       
	    // render the job order metabox
	    include(plugin_dir_path( __FILE__ ) . '/templates/' . self::POST_TYPE . '-metabox.php');         
	}
}

/* @end of file */