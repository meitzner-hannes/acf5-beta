<?php

class acf_settings_info {

	/*
	*  __construct
	*
	*  Initialize filters, action, variables and includes
	*
	*  @type	function
	*  @date	23/06/12
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/

	function __construct() {

		// actions
		add_action( 'admin_menu', 				array( $this, 'admin_menu' ) );
	}


	/*
	*  admin_menu
	*
	*  This function will add the ACF menu item to the WP admin
	*
	*  @type	action (admin_menu)
	*  @date	28/09/13
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/

	function admin_menu() {

		// bail early if no show_admin
		if( !acf_get_setting('show_admin') ) {
		
			return;
			
		}


		// add page
		$page = add_submenu_page('edit.php?post_type=acf-field-group', __('Info','acf'), __('Info','acf'), 'manage_options','acf-settings-info', array($this,'html') );

	}


	/*
	*  html
	*
	*  description
	*
	*  @type	function
	*  @date	7/01/2014
	*  @since	5.0.0
	*
	*  @param	$post_id (int)
	*  @return	$post_id (int)
	*/

	function html() {

		// load view
		acf_get_view('settings-info');

	}

}


// initialize
new acf_settings_info();

?>