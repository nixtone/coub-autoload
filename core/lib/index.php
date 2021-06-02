<?
require_once($_SERVER['DOCUMENT_ROOT'].'/core/lib/function.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/core/config.php');

error_reporting(ENV['DEV_MODE'] ? E_ALL : 0);
ini_set('display_errors', ENV['DEV_MODE']);

foreach(['db', 'crud', 'core', 'coub'] as $cName) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/core/lib/class.'.$cName.'.php');
	$LIB[strtoupper($cName)] = new $cName();
}
