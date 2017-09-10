<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://pasqualevitiello.com
 * @since      1.0.0
 *
 * @package    Hemma_Custom_Post_Types
 * @subpackage Hemma_Custom_Post_Types/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Hemma_Custom_Post_Types
 * @subpackage Hemma_Custom_Post_Types/admin
 * @author     Pasquale Vitiello <pasqualevitiello@gmail.com>
 */
class Hemma_Custom_Post_Types_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Create Hemma Room custom post types
	 *
	 * @since    1.0.0
	 */
	public function hemma_room_cpt() {
		    
		$labels = array(
		 	'name' => _x( 'Rooms', 'post type general name', 'hemma-custom-post-types' ),
			'singular_name' => _x( 'Room', 'post type singular name', 'hemma-custom-post-types' ),
			'menu_name' => _x( 'Rooms', 'admin menu', 'hemma-custom-post-types' ),
			'name_admin_bar' => _x( 'Room', 'add new on admin bar', 'hemma-custom-post-types' ),
			'add_new' => _x( 'Add New', 'room', 'hemma-custom-post-types' ),
			'add_new_item' => __( 'Add New Room', 'hemma-custom-post-types' ),
			'new_item' => __( 'New Room', 'hemma-custom-post-types' ),
			'edit_item' => __( 'Edit Room', 'hemma-custom-post-types' ),
			'view_item' => __( 'View Room', 'hemma-custom-post-types' ),
			'all_items' => __( 'All Rooms', 'hemma-custom-post-types' ),
			'search_items' =>  __( 'Search Rooms', 'hemma-custom-post-types' ),
			'parent_item_colon' => __( 'Parent Rooms:', 'hemma-custom-post-types' ),
			'not_found' => __( 'No Rooms Found', 'hemma-custom-post-types'),
			'not_found_in_trash' => __( 'No Rooms found in Trash', 'hemma-custom-post-types' )
		 );
		 
		 $args = array(
				'labels' => $labels,
				'singular_label' => __( 'Room', 'hemma-custom-post-types' ),
				'public' => true,
				'show_ui' => true,
				'hierarchical' => false,
				'has_archive' => false,
				'menu_icon' => 'dashicons-grid-view',
				'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions' ),
				'taxonomies' => array( 'roomcategory', 'post_tag' )
	       );  
	   
	    register_post_type( 'room' , $args );  

	}

	/**
	 * Create Hemma Room taxonomy
	 *
	 * @since    1.0.0
	 */
	public function hemma_room_taxonomy() {
	 
		$labels = array(
		    'name' => _x( 'Room Categories', 'taxonomy general name', 'hemma-custom-post-types' ),
		    'singular_name' => _x( 'Category', 'taxonomy singular name', 'hemma-custom-post-types' ),
		    'search_items' =>  __( 'Search Categories', 'hemma-custom-post-types' ),
		    'popular_items' => __( 'Popular Categories', 'hemma-custom-post-types' ),
		    'all_items' => __( 'All Categories', 'hemma-custom-post-types' ),
		    'parent_item' => null,
		    'parent_item_colon' => null,
		    'edit_item' => __( 'Edit Category', 'hemma-custom-post-types' ),
		    'update_item' => __( 'Update Category', 'hemma-custom-post-types' ),
		    'add_new_item' => __( 'Add New Category', 'hemma-custom-post-types' ),
		    'new_item_name' => __( 'New Category Name', 'hemma-custom-post-types' ),
		    'separate_items_with_commas' => __( 'Separate categories with commas', 'hemma-custom-post-types' ),
		    'add_or_remove_items' => __( 'Add or remove categories', 'hemma-custom-post-types' ),
		    'choose_from_most_used' => __( 'Choose from the most used categories', 'hemma-custom-post-types' )
		);
		 
		register_taxonomy( 'roomcategory', 'room', array(
		    'label' => __( 'Room Category', 'hemma-custom-post-types' ),
		    'labels' => $labels,
		    'hierarchical' => true,
		    'show_ui' => true,
		    'query_var' => true,
		    'rewrite' => array( 'slug' => 'room-category' ),
		));

	}

	/**
	 * Create Hemma Event custom post types
	 *
	 * @since    1.0.0
	 */
	public function hemma_event_cpt() {
		    
		$labels = array(
		 	'name' => _x( 'Events', 'post type general name', 'hemma-custom-post-types' ),
			'singular_name' => _x( 'Event', 'post type singular name', 'hemma-custom-post-types' ),
			'menu_name' => _x( 'Events', 'admin menu', 'hemma-custom-post-types' ),
			'name_admin_bar' => _x( 'Event', 'add new on admin bar', 'hemma-custom-post-types' ),
			'add_new' => _x( 'Add New', 'event', 'hemma-custom-post-types' ),
			'add_new_item' => __( 'Add New Event', 'hemma-custom-post-types' ),
			'new_item' => __( 'New Event', 'hemma-custom-post-types' ),
			'edit_item' => __( 'Edit Event', 'hemma-custom-post-types' ),
			'view_item' => __( 'View Event', 'hemma-custom-post-types' ),
			'all_items' => __( 'All Events', 'hemma-custom-post-types' ),
			'search_items' =>  __( 'Search Events', 'hemma-custom-post-types' ),
			'parent_item_colon' => __( 'Parent Events:', 'hemma-custom-post-types' ),
			'not_found' => __( 'No Events Found', 'hemma-custom-post-types'),
			'not_found_in_trash' => __( 'No Events found in Trash', 'hemma-custom-post-types' )
		 );
		 
		 $args = array(
				'labels' => $labels,
				'singular_label' => __( 'Event', 'hemma-custom-post-types' ),
				'public' => true,
				'show_ui' => true,
				'hierarchical' => false,
				'has_archive' => false,
				'menu_icon' => 'dashicons-calendar',
				'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions' ),
				'taxonomies' => array( 'eventcategory', 'post_tag' )
	       );  
	   
	    register_post_type( 'event' , $args ); 

	}

	/**
	 * Create Hemma Event taxonomy
	 *
	 * @since    1.0.0
	 */
	public function hemma_event_taxonomy() {
	 
		$labels = array(
		    'name' => _x( 'Event Categories', 'taxonomy general name', 'hemma-custom-post-types' ),
		    'singular_name' => _x( 'Category', 'taxonomy singular name', 'hemma-custom-post-types' ),
		    'search_items' =>  __( 'Search Categories', 'hemma-custom-post-types' ),
		    'popular_items' => __( 'Popular Categories', 'hemma-custom-post-types' ),
		    'all_items' => __( 'All Categories', 'hemma-custom-post-types' ),
		    'parent_item' => null,
		    'parent_item_colon' => null,
		    'edit_item' => __( 'Edit Category', 'hemma-custom-post-types' ),
		    'update_item' => __( 'Update Category', 'hemma-custom-post-types' ),
		    'add_new_item' => __( 'Add New Category', 'hemma-custom-post-types' ),
		    'new_item_name' => __( 'New Category Name', 'hemma-custom-post-types' ),
		    'separate_items_with_commas' => __( 'Separate categories with commas', 'hemma-custom-post-types' ),
		    'add_or_remove_items' => __( 'Add or remove categories', 'hemma-custom-post-types' ),
		    'choose_from_most_used' => __( 'Choose from the most used categories', 'hemma-custom-post-types' )
		);
		 
		register_taxonomy( 'eventcategory', 'event', array(
		    'label' => __( 'Event Category', 'hemma-custom-post-types' ),
		    'labels' => $labels,
		    'hierarchical' => true,
		    'show_ui' => true,
		    'query_var' => true,
		    'rewrite' => array( 'slug' => 'event-category' ),
		));

	}

	/**
	 * Create Hemma Food custom post types
	 *
	 * @since    1.0.0
	 */
	public function hemma_food_cpt() {
		    
		$labels = array(
		 	'name' => _x( 'Foods', 'post type general name', 'hemma-custom-post-types' ),
			'singular_name' => _x( 'Food', 'post type singular name', 'hemma-custom-post-types' ),
			'menu_name' => _x( 'Foods', 'admin menu', 'hemma-custom-post-types' ),
			'name_admin_bar' => _x( 'Food', 'add new on admin bar', 'hemma-custom-post-types' ),
			'add_new' => _x( 'Add New', 'food', 'hemma-custom-post-types' ),
			'add_new_item' => __( 'Add New Food', 'hemma-custom-post-types' ),
			'new_item' => __( 'New Food', 'hemma-custom-post-types' ),
			'edit_item' => __( 'Edit Food', 'hemma-custom-post-types' ),
			'view_item' => __( 'View Food', 'hemma-custom-post-types' ),
			'all_items' => __( 'All Foods', 'hemma-custom-post-types' ),
			'search_items' =>  __( 'Search Foods', 'hemma-custom-post-types' ),
			'parent_item_colon' => __( 'Parent Foods:', 'hemma-custom-post-types' ),
			'not_found' => __( 'No Foods Found', 'hemma-custom-post-types'),
			'not_found_in_trash' => __( 'No Foods found in Trash', 'hemma-custom-post-types' )
		 );
		 
		 $args = array(
				'labels' => $labels,
				'singular_label' => __( 'Food', 'hemma-custom-post-types' ),
				'public' => true,
				'show_ui' => true,
				'hierarchical' => false,
				'has_archive' => false,
				'menu_icon' => 'dashicons-carrot',
				'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions' ),
				'taxonomies' => array( 'foodcategory', 'post_tag' )
	       );  
	   
	    register_post_type( 'food' , $args );

	}

	/**
	 * Create Hemma Food taxonomy
	 *
	 * @since    1.0.0
	 */
	public function hemma_food_taxonomy() {
	 
		$labels = array(
		    'name' => _x( 'Food Categories', 'taxonomy general name', 'hemma-custom-post-types' ),
		    'singular_name' => _x( 'Category', 'taxonomy singular name', 'hemma-custom-post-types' ),
		    'search_items' =>  __( 'Search Categories', 'hemma-custom-post-types' ),
		    'popular_items' => __( 'Popular Categories', 'hemma-custom-post-types' ),
		    'all_items' => __( 'All Categories', 'hemma-custom-post-types' ),
		    'parent_item' => null,
		    'parent_item_colon' => null,
		    'edit_item' => __( 'Edit Category', 'hemma-custom-post-types' ),
		    'update_item' => __( 'Update Category', 'hemma-custom-post-types' ),
		    'add_new_item' => __( 'Add New Category', 'hemma-custom-post-types' ),
		    'new_item_name' => __( 'New Category Name', 'hemma-custom-post-types' ),
		    'separate_items_with_commas' => __( 'Separate categories with commas', 'hemma-custom-post-types' ),
		    'add_or_remove_items' => __( 'Add or remove categories', 'hemma-custom-post-types' ),
		    'choose_from_most_used' => __( 'Choose from the most used categories', 'hemma-custom-post-types' )
		);
		 
		register_taxonomy( 'foodcategory', 'food', array(
		    'label' => __( 'Food Category', 'hemma-custom-post-types' ),
		    'labels' => $labels,
		    'hierarchical' => true,
		    'show_ui' => true,
		    'query_var' => true,
		    'rewrite' => array( 'slug' => 'food-category' ),
		));

	}

	/**
	 * Create Hemma Deal custom post types
	 *
	 * @since    1.0.0
	 */
	public function hemma_deal_cpt() {
		    
		$labels = array(
		 	'name' => _x( 'Deals', 'post type general name', 'hemma-custom-post-types' ),
			'singular_name' => _x( 'Deal', 'post type singular name', 'hemma-custom-post-types' ),
			'menu_name' => _x( 'Deals', 'admin menu', 'hemma-custom-post-types' ),
			'name_admin_bar' => _x( 'Deal', 'add new on admin bar', 'hemma-custom-post-types' ),
			'add_new' => _x( 'Add New', 'deal', 'hemma-custom-post-types' ),
			'add_new_item' => __( 'Add New Deal', 'hemma-custom-post-types' ),
			'new_item' => __( 'New Deal', 'hemma-custom-post-types' ),
			'edit_item' => __( 'Edit Deal', 'hemma-custom-post-types' ),
			'view_item' => __( 'View Deal', 'hemma-custom-post-types' ),
			'all_items' => __( 'All Deals', 'hemma-custom-post-types' ),
			'search_items' =>  __( 'Search Deals', 'hemma-custom-post-types' ),
			'parent_item_colon' => __( 'Parent Deals:', 'hemma-custom-post-types' ),
			'not_found' => __( 'No Deals Found', 'hemma-custom-post-types'),
			'not_found_in_trash' => __( 'No Deals found in Trash', 'hemma-custom-post-types' )
		 );
		 
		 $args = array(
				'labels' => $labels,
				'singular_label' => __( 'Deal', 'hemma-custom-post-types' ),
				'public' => true,
				'show_ui' => true,
				'hierarchical' => false,
				'has_archive' => false,
				'menu_icon' => 'dashicons-tickets-alt',
				'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions' ),
				'taxonomies' => array( 'dealcategory', 'post_tag' )
	       );  
	   
	    register_post_type( 'deal' , $args );

	}

	/**
	 * Create Hemma Deal taxonomy
	 *
	 * @since    1.0.0
	 */
	public function hemma_deal_taxonomy() {
	 
		$labels = array(
		    'name' => _x( 'Deal Categories', 'taxonomy general name', 'hemma-custom-post-types' ),
		    'singular_name' => _x( 'Category', 'taxonomy singular name', 'hemma-custom-post-types' ),
		    'search_items' =>  __( 'Search Categories', 'hemma-custom-post-types' ),
		    'popular_items' => __( 'Popular Categories', 'hemma-custom-post-types' ),
		    'all_items' => __( 'All Categories', 'hemma-custom-post-types' ),
		    'parent_item' => null,
		    'parent_item_colon' => null,
		    'edit_item' => __( 'Edit Category', 'hemma-custom-post-types' ),
		    'update_item' => __( 'Update Category', 'hemma-custom-post-types' ),
		    'add_new_item' => __( 'Add New Category', 'hemma-custom-post-types' ),
		    'new_item_name' => __( 'New Category Name', 'hemma-custom-post-types' ),
		    'separate_items_with_commas' => __( 'Separate categories with commas', 'hemma-custom-post-types' ),
		    'add_or_remove_items' => __( 'Add or remove categories', 'hemma-custom-post-types' ),
		    'choose_from_most_used' => __( 'Choose from the most used categories', 'hemma-custom-post-types' )
		);
		 
		register_taxonomy( 'dealcategory', 'deal', array(
		    'label' => __( 'Deal Category', 'hemma-custom-post-types' ),
		    'labels' => $labels,
		    'hierarchical' => true,
		    'show_ui' => true,
		    'query_var' => true,
		    'rewrite' => array( 'slug' => 'deal-category' ),
		));

	}

	/**
	 * Create Hemma Guest Post custom post types
	 *
	 * @since    1.0.0
	 */
	public function hemma_guestpost_cpt() {
		    
		$labels = array(
		 	'name' => _x( 'Guest Posts', 'post type general name', 'hemma-custom-post-types' ),
			'singular_name' => _x( 'Guest Post', 'post type singular name', 'hemma-custom-post-types' ),
			'menu_name' => _x( 'Guest Posts', 'admin menu', 'hemma-custom-post-types' ),
			'name_admin_bar' => _x( 'Guest Post', 'add new on admin bar', 'hemma-custom-post-types' ),
			'add_new' => _x( 'Add New', 'guestpost', 'hemma-custom-post-types' ),
			'add_new_item' => __( 'Add New Guest Post', 'hemma-custom-post-types' ),
			'new_item' => __( 'New Guest Post', 'hemma-custom-post-types' ),
			'edit_item' => __( 'Edit Guest Post', 'hemma-custom-post-types' ),
			'view_item' => __( 'View Guest Post', 'hemma-custom-post-types' ),
			'all_items' => __( 'All Guest Posts', 'hemma-custom-post-types' ),
			'search_items' =>  __( 'Search Guest Posts', 'hemma-custom-post-types' ),
			'parent_item_colon' => __( 'Parent Guest Posts:', 'hemma-custom-post-types' ),
			'not_found' => __( 'No Guest Posts Found', 'hemma-custom-post-types'),
			'not_found_in_trash' => __( 'No Guest Posts found in Trash', 'hemma-custom-post-types' )
		 );
		 
		 $args = array(
				'labels' => $labels,
				'singular_label' => __( 'Guest Post', 'hemma-custom-post-types' ),
				'public' => true,
				'exclude_from_search' => true,
				'show_ui' => true,
				'hierarchical' => false,
				'has_archive' => false,
				'menu_icon' => 'dashicons-editor-quote',
				'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions' )
	       );  
	   
	    register_post_type( 'guestpost' , $args ); 

	}

}
