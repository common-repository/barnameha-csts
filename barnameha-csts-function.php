<?php
	session_start();
	
	function bcsts_speed()
	{
	
	  //Prepare a 1kB chunk to send
	  for ($i=0; $i<1023; $i++) $chunk.='A';
	  $chunk.='\n';
	  //Hide what happens next
	  echo "<!-- ";
	  //Keep sending 1 kB chunks for 1 second
	  flush();
	  $count=0;
	  $starttime = micro_time();
	  do
	  {
		echo $chunk;
		$count++;
		flush();
		$endtime = micro_time();
		$totaltime = $endtime - $starttime;
		$totaltime = round($totaltime,5);
	  } while ($totaltime < 1);
	  echo " -->\n";
	  //Return how many kb were sent
	  return ($count * 8);
	}
	
	//Return the unix timestamp + microseconds
	function micro_time()
	{
		$timearray = explode(" ", microtime());
		return ($timearray[1] + $timearray[0]);
	}
		
	function bcsts_Initialize(){
			
		//if ( ! $theme_data = wp_cache_get('themes-data', 'barnameha-csts') ) {
			$themes = (array) get_themes();
			if ( function_exists('is_site_admin') ) {
				$allowed_themes = (array) get_site_option( 'allowedthemes' );
				foreach( $themes as $key => $theme ) {
					if( isset( $allowed_themes[ wp_specialchars( $theme[ 'Stylesheet' ] ) ] ) == false ) {
						unset( $themes[ $key ] );
					}
				}
			}
		//}
		
		global $default_theme;
		$default_theme = get_current_theme();
		
		$theme_data = array();
		
		foreach ((array) $themes as $theme_name => $data) {
			// Skip unpublished themes.
			if (empty($theme_name) || isset($themes[$theme_name]['Status']) && $themes[$theme_name]['Status'] != 'publish')
				continue;
			$theme_data[add_query_arg('wptheme', $theme_name, get_option('home'))] = $theme_name;
		}
	
		asort($theme_data);
	
		wp_cache_set('themes-data', $theme_data, 'barnameha-csts');	
		
		return $theme_data;
	}
	
	function bcsts_themelist($selname='', $sellast=''){
		
		$theme_data=bcsts_Initialize();
		
		echo '<select name="' . $selname . '">';
		foreach ($theme_data as $url => $theme_name) {
			echo  '<option  ' ;
			if($sellast == esc_attr($theme_name)) echo 'selected="selected"' ;
			echo 'value="' . esc_attr($theme_name) . '">' . esc_attr($theme_name) . '</option>';
		}
		echo '</select>';
	}
	
?>