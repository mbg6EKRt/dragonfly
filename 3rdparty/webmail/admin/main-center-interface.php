<!-- [start center] -->
<form action="?mode=save" method="POST">
<input type="hidden" name="form_id" value="interface">
<table class="wm_admin_center" width="500" border="0">
	<tr>
		<td width="150"></td>
		<td></td>
	</tr>
	<tr>
		<td colspan="2" class="wm_admin_title">Interface Settings</td>
	</tr>
	<tr><td colspan="2"><br /></td></tr>
	<tr>
		<td align="right">Mails per page: </td>
		<td><input type="text" class="wm_input" onchange="change();" name="intMailsPerPage" size="4" value="<?php echo (int) $settings->MailsPerPage;?>" maxlength="4"></td>
	</tr>
	<tr>
		<td align="right">Default skin: </td>
		<td>
			<select name="txtDefaultSkin" class="wm_input" style="width: 150px;">
			<?php
				$skinsList = &FileSystem::GetSkinsList();
				
				for ($i = 0, $c = count($skinsList); $i < $c; $i++)
				{
					$temp = ($settings->DefaultSkin == $skinsList[$i]) ? 'selected="selected"' : '';
					echo '<option value="'.dequote($skinsList[$i]).'" '. $temp .'> '.$skinsList[$i].'</option>'."\n";
				}
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="right">Default language: </td>
		<td>
			<select name="txtDefaultLanguage" class="wm_input" onchange="change();" style="width: 150px;">
			<?php
				$langList = &FileSystem::GetLangList();

				for ($i = 0, $c = count($langList); $i < $c; $i++)
				{
					$temp = ($settings->DefaultLanguage == $langList[$i]) ? 'selected="selected"' : '';
					echo '<option value="'.dequote($langList[$i]).'" '. $temp .'> '.$langList[$i].'</option>'."\n";
				}
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="right">&nbsp;</td>
		<td>
			<input type="checkbox" name="intShowTextLabels" onchange="change();" style="vertical-align: middle" id="intShowTextLabels" value="1" <?php echo ((bool) $settings->ShowTextLabels) ? 'checked="checked"' : '';?> />
			<label for="intShowTextLabels">Show text labels</label>
		</td>
	</tr>
	<tr>
		<td align="right">&nbsp;</td>
		<td>
			<input type="checkbox" name="intAllowAjaxVeersion" onchange="change();" style="vertical-align: middle" id="intAllowAjaxVeersion" value="1" <?php echo ((bool) $settings->AllowAjax) ? 'checked="checked"' : '';?> />
			<label for="intAllowAjaxVeersion">Allow AJAX Version</label>
		</td>
	</tr>
	<tr>
		<td align="right">&nbsp;</td>
		<td>
			<input type="checkbox" name="intViewMode" onchange="change();" style="vertical-align: middle" id="intViewMode" value="1" <?php echo ($settings->ViewMode == VIEW_MODE_PREVIEW_PANE) ? 'checked="checked"' : '';?> />
			<label for="intViewMode">Messages list with preview pane (AJAX only)</label>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<br /><div id="messDiv" class="messdiv" <?php echo (strlen($divMessage) > 0) ? 'style="border: 1px solid Silver;"' : '';?>>
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