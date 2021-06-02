<?
require_once($_SERVER['DOCUMENT_ROOT'].'/core/lib/index.php');

include($_SERVER['DOCUMENT_ROOT'].'/core/dev/header.php');
$LIB['COUB']->List($LIB['COUB']->Read(false, ['LIMIT' => 30]));
include($_SERVER['DOCUMENT_ROOT'].'/core/dev/footer.php');