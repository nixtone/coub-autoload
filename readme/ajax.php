<?
if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	include($_SERVER['DOCUMENT_ROOT'].'/lib.php');
	switch ($_POST['CODE']) {
		case 'more': {
			coubList("SELECT * FROM `coub` WHERE `ID` > ".$_POST['FROM']." LIMIT 10");
		} break;
		case 'search': {
			coubList("SELECT * FROM `coub` WHERE `TAGS` LIKE '%{$_POST['tag']}%'");
		} break;
		case 'add': {
			if(!DB::Query("SELECT * FROM `coub` WHERE `COUB_ID`='{$_POST['COUB_ID']}'", 'row')) DB::Query("INSERT INTO `coub` VALUES(0, '{$_POST['COUB_ID']}', '', '{$_POST['TAGS']}')");
		} break;
	}

	
}