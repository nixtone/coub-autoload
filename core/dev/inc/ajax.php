<?
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	require_once($_SERVER['DOCUMENT_ROOT'].'/core/lib/index.php');
	switch($_POST['CODE']) {
		case 'MORE': {
			$result = $LIB['COUB']->List($LIB['COUB']->Read(false, ['WHERE' => "ID > {$_POST['FROM']} LIMIT 10"]));
			// $result = true;
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
