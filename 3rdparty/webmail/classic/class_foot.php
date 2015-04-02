<?php

	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/../'));
	
	
class FootPanel
{

	/**
	 * @var PageBuilder
	 */
	var $pagebuilder;
	
	/**
	 * @var string;
	 */
	var $text = '';
	
	/**
	 * @param PageBuilder $pagebuilder
	 * @param bool $withCopy
	 * @return FootPanel
	 */
	function FootPanel(&$pagebuilder)
	{
		$this->pagebuilder = &$pagebuilder;
	}
	
	/**
	 * @return string
	 */
	function ToHTML()
	{
		$screen = $this->pagebuilder->_proc->sArray[SCREEN];
		$copy = @file_get_contents('inc.footer.php');
		
		$copyclass = 'wm_copyright';
		if ($screen == SCREEN_FULLSCREEN)
		{
			$copyclass = 'wm_hide';
		}
		$this->text = '<div class="'.$copyclass.'" id="copyright">'.$copy.'</div>';
				
		if (isset($_SESSION[INFORMATION]) && strlen($_SESSION[INFORMATION]) > 0) 
		{
			if (isset($_SESSION[ISINFOERROR]) && $_SESSION[ISINFOERROR] = true)
			{
				$this->pagebuilder->AddInitText('InfoPanel.Class("wm_error_information", "", "error.gif"); InfoPanel.Show();');
			}
			else 
			{
				$this->pagebuilder->AddInitText('InfoPanel.Class("wm_information", "wm_hide", "info.gif");  InfoPanel.Show();');
			}
			$_SESSION[INFORMATION] = '';
			$_SESSION[ISINFOERROR] = false;
		}
		else 
		{
			$infohide = 'InfoPanel.Hide();';
			if ($screen == SCREEN_FULLSCREEN)
			{
				$infohide = '
	InfoPanel._isError = false;
	InfoPanel.SetInfo("'.ConvertUtils::ClearJavaScriptString(JS_LANG_Loading, '"').'");
	InfoPanel.Show();';
			}
				
			$this->pagebuilder->AddInitText('
if (InfoPanel._isError) {
	InfoPanel.Class("wm_error_information", "wm_info_image", "error.gif");
	InfoPanel.Show();
}
else {
	'.$infohide.'
}
			');
		}		
			
		$this->text .= '</div>'.$this->pagebuilder->_js->_iniTextToHtml().'</body></html>';
		
		return $this->text;
	}
	
}
