<?php
	require_once('barnameha-csts-function.php');
	load_plugin_textdomain('barnameha-csts','wp-content/plugins/barnameha-csts/languages');
	
	if(isset($_POST[Submit])){
		update_option("bcsts_theme1", $_POST[bcsts_theme1]);
		update_option("bcsts_theme2", $_POST[bcsts_theme2]);
	}
	
	$bcsts_theme1 = get_option('bcsts_theme1');
	$bcsts_theme2 = get_option('bcsts_theme2');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<form action="" method="post">
<div class="wrap">
<br /><br />
<table width="99%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h2><?php _e('Barnameha CSTS','barnameha-csts'); ?></h2><small><?php _e('Barnameha Connection Speed Theme Switcher','barnameha-csts'); ?></small></td>
    <td width="150"><a href="http://www.barnameha.ir/" target="_blank"><img src="../wp-content/plugins/barnameha-csts/Barnameha-Logo.gif" alt="" width="100" height="78" /></a></td>
  </tr>
</table>

<?php
	if(isset($_POST[Submit])){
		echo "<div class=updated><p><strong>" . __('Your options have been saved','barnameha-csts') . "</strong></p></div> ";
	}
	echo '<h3>';
	$kbps=bcsts_speed();
	$mbps=$kbps / 1024;
	$mbps=round($mbps,2);
	if ($mbps > 1 ) echo __('Now Speed:','barnameha-csts') . " $mbps Mbps.<br />";
	else echo __('Now Speed:','barnameha-csts') . " $kbps Kbps.<br />";
	echo '</h3>';
?>
<br />
<br /><br />
<?php _e('Please Select Theme For Website Viewer With Client Connection Speed','barnameha-csts'); ?>
<table width="500" border="0">
  <tr>
    <td width="200px"><?php _e('Theme For DialUp Connection','barnameha-csts'); ?></td>
    <td><?php bcsts_themelist('bcsts_theme1',$bcsts_theme1); ?></td>
  </tr>
  <tr>
    <td><?php _e('Theme For High-Speed (DSL,Cable Mode,...) Connection','barnameha-csts'); ?></td>
    <td><?php bcsts_themelist('bcsts_theme2',$bcsts_theme2); ?></td>
  </tr>
</table>

<br />
	<p class="submit">
		<input type="submit" name="Submit" value="<?php _e('Save Changes','barnameha-csts'); ?>" />
	</p>
</div>
</form>
<hr>
<?php _e('Barnameha CSTS By: ','barnameha-csts'); ?>  <a href="http://www.design.barnameha.ir/" target="_blank"><?php _e('Barnameha','barnameha-csts'); ?></a> -  <?php _e('Mohammad Kafi (Parsa)','barnameha-csts'); ?> - <a href="http://www.barnameha.ir/support" target="_blank"><?php _e('Support','barnameha-csts'); ?></a>
</body>
</html>