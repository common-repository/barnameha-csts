<?php
 /* 
  Plugin Name: Barnameha CSTS
  Plugin URI: http://www.design.barnameha.ir/
  Description: Auto Select Theme With Conection Speed.
  Author: Mohammad Kafi
  Version: 1.0.0
  Author URI: http://www.barnameha.ir/
*/
		include_once('barnameha-csts-function.php');
		
		function bcsts_admin() {
			include('barnameha-csts-admin.php');
		}
		
		function bcsts_admin_actions() {  
			add_options_page("barnameha-csts", "Barnameha CSTS", 1, "barnameha-csts", "bcsts_admin");  
		}
		
		function bcsts_stylesheet($stylesheet = '') {
			$theme = bcsts_theme();
	
			if (empty($theme)) {
				return $stylesheet;
			}
	
			$theme = get_theme($theme);
	
			// Don't let people peek at unpublished themes.
			if (isset($theme['Status']) && $theme['Status'] != 'publish')
				return $template;		
			
			if (empty($theme)) {
				return $stylesheet;
			}
	
			return $theme['Stylesheet'];
		}

		function bcsts_template($template) {
			$theme = bcsts_theme();
	
			if (empty($theme)) {
				return $template;
			}
	
			$theme = get_theme($theme);
			
			if ( empty( $theme ) ) {
				return $template;
			}
	
			// Don't let people peek at unpublished themes.
			if (isset($theme['Status']) && $theme['Status'] != 'publish')
				return $template;		
	
			return $theme['Template'];
		}

		function bcsts_theme() {
			if($_SESSION['bcsts_speed']!=''){
				$kbps=$_SESSION['bcsts_speed'];
				$mbps=$kbps / 1024;
				$mbps=round($mbps);
				
				if ($mbps >= 1 ){
					$theme = get_option('bcsts_theme1');
				}elseif($mbps < 1 ){
					$theme = get_option('bcsts_theme2');
				}else{
					$theme = get_current_theme();
				}
			}
			
			return $theme;
		}
		
		add_action('admin_menu', 'bcsts_admin_actions'); 
		add_filter('stylesheet', 'bcsts_stylesheet');
		add_filter('template', 'bcsts_template');
		//add_filter('option_template', 'bcsts_template');
		//add_filter('option_stylesheet', 'bcsts_stylesheet');
		add_action('wp_footer', 'bcsts_session');
		function bcsts_session($footer) {
			if($_SESSION['bcsts_speed']==''){
				$kbps=bcsts_speed();
				$_SESSION['bcsts_speed']=$kbps;
			}
		}
?>