<!-- [start center] -->
<form action="?mode=save" method="POST">
<input type="hidden" name="form_id" value="debug">
<table class="wm_admin_center" width="500">
	<tr>
		<td width="60"></td>
		<td></td>
	</tr>
	<tr>
		<td colspan="2" class="wm_admin_title">Debug Settings</td>
	</tr>
	<tr><td colspan="2"><br /></td></tr>
	<tr>
		<td></td>
		<td><input type="checkbox" class="wm_checkbox" name="intEnableLogging" onchange="change();" id="intEnableLogging" <?php echo ((bool) $settings->EnableLogging) ? 'checked="checked"' : '';?> value="1" />
		<label for="intEnableLogging">Enable logging</label></td>
	</tr>
	<tr><td colspan="2">
<div class="wm_safety_info">
<b>Enable logging</b> - enables detailed logging helpful for troubleshooting.
</div><br />
	</td></tr>
	<tr>
		<td><nobr>Path for log:</nobr></td>
		<td><input type="text" name="txtPathForLog" onchange="change();" value="<?php echo dequote(INI_DIR.'/'.LOG_PATH.'/'.LOG_FILENAME);?>" class="wm_input" readonly="readonly" style="width: 330px">
		</td>
	</tr>
	<tr>
		<td colspan="3">
<div class="wm_safety_info">
<b>Path for log</b> - path to the log file (cannot be changed). The buttons below allow viewing and clearing the log file.
</div>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<input type="button" onclick="PopUpWindow('?mode=showlog&t=0');" value="Show All Log (<?php echo (file_exists(INI_DIR.'/'.LOG_PATH.'/'.LOG_FILENAME)) ? GetFriendlySize(filesize(INI_DIR.'/'.LOG_PATH.'/'.LOG_FILENAME)) : '0K' ;?>)" class="wm_button" style="font-size: 11px;" />
			<input type="button" onclick="PopUpWindow('?mode=showlog&t=1');" value="Show Log (last records)" class="wm_button" style="font-size: 11px;" />
			<input type="button" onclick="document.location.replace('?mode=clearlog');" value="Clear Log" class="wm_button" style="font-size: 11px;" />
		</td>
	</tr>
	
	<tr>
		<td colspan="3" align="center">
			<?php echo (strlen($divMessage) > 0)? $divMessage : '&nbsp;';?></div>
		</td>
	</tr>
	<!-- hr -->
	<tr><td colspan="2"><hr size="1"></td></tr>
	<tr>
		<td colspan="2" align="right">
			<input type="submit" name="submit" value="Save" class="wm_button" style="width: 100px">&nbsp;
		</td>
	</tr>
</table>
</form>
<!-- [end center] -->