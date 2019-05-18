<?php
	$objectName = isset($_REQUEST['HistoryStorageObjectName']) ? $_REQUEST['HistoryStorageObjectName'] : '';
	$historyKey = isset($_REQUEST['HistoryKey']) ? $_REQUEST['HistoryKey'] : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" />
<html>
<body>
<script>
<?php
if (strlen($historyKey) > 0)
{
	echo 'parent.'.$objectName.'.ProcessHistory(\''.$historyKey.'\');';
}
?>
</script>
</body>
</html> 