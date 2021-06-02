<?
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	require_once($_SERVER['DOCUMENT_ROOT'].'/core/lib/index.php');
	switch($DATA['CODE']) {
		case 'MORE': {
			
			$result = true;
		} break;
		/*
		case '': {
			
			$result = true;
		} break;
		*/
		default: {
			$result = false;
		} break;
	}
	die(json_encode($result));
}
