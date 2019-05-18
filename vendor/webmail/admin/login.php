<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" />
<html>
<head>
	<title>WebMail Lite - Administration Login</title>
	<link rel="stylesheet" href="<?php echo $skinPath;?>/styles.css" type="text/css" />
</head>
<body>
<form action="?mode=enter" method="POST">
<div align="center" class="wm_content">
<div class="wm_logo" id="logo" tabindex="-1"></div>
		<?php echo $errorDiv; ?>
		<table class="wm_login wm_fixed">
			<col width="70px"></col>
			<col width="88px"></col>
			<col width="70px"></col>
			<col width="33px"></col>
			<col width="42px"></col>
			<tr>
				<td class="wm_login_header" colspan="5">Administration Login</td>
			</tr>
			<tr>
				<td class="wm_title">Login:</td>
				<td colspan="4">
					<input class="wm_input" size="20" type="text" id="login" name="login"
					onfocus="this.style.background = '#FFF9B2';"
					onblur="this.style.background = 'white';" />
				</td>
			</tr>
			<tr>
				<td class="wm_title">Password:</td>
				<td colspan="4">
					<input class="wm_input" type="password" size="20" id="password" name="password" 
					onfocus="this.style.background = '#FFF9B2';"
					onblur="this.style.background = 'white';" />
				</td>
			</tr>
			<tr>
				<td colspan="5">
					<span class="wm_login_button">
						<input class="wm_button" type="submit" name="enter" value="Login" />
					</span>
				</td>
			</tr>
		</table>
<div class="wm_copyright" id="copyright">
<?php
	@require('inc.footer.php');
?>
</div>
</div>
</form>
</body>
</html>