<?php

$navArray = array('','','','','','','','');
$navArray[$navId] = ' class="wm_selected_settings_item"';

?>
	<table class="wm_settings">
		<tr>
			<!-- [start navigation] -->
			<td class="wm_settings_nav">
				<ul>
					<div class="wm_disabled">
						<nobr><li>Database Settings</li></nobr>
					</div>
					<div class="wm_disabled">
						<nobr><li>Users Management</li></nobr>
					</div>
					<div<?php echo $navArray[3];?>>
						<nobr><li><a href="?mode=wm_settings" onclick="return SaveForm();">WebMail Settings</a></li></nobr>
					</div>
					<div<?php echo $navArray[4];?>>
						<nobr><li><a href="?mode=wm_interface" onclick="return SaveForm();">Interface Settings</a></li></nobr>
					</div>
					<div<?php echo $navArray[5];?>>
						<nobr><li><a href="?mode=wm_domain" onclick="return SaveForm();">Login Settings</a></li></nobr>
					</div>
					<div<?php echo $navArray[6];?>>
						<nobr><li><a href="?mode=wm_debug" onclick="return SaveForm();">Debug Settings</a></li></nobr>
					</div>	
					<div class="wm_disabled">
						<nobr><li>Mail Server Integration</li></nobr>
					</div>
				</ul>		
				<div style="color: #999;">
					Looking for complete e-mail solution with mail server, folders and contacts management, and more? Take a look at <a style="color: #999; text-decoration: underline;" href="http://www.afterlogic.com/mailbee/webmail-pro.asp">Pro version</a>!
				</div>
			</td>
			<!-- [end navigation] -->
			<td class="wm_settings_cont" valign="top">