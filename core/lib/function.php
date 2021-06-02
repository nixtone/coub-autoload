<?
// p($test1, 'pr', __FILE__, __LINE__); 
function p($sData, $flag = 'pr', $FILE = '', $LINE = '') {
	if(!ENV['DEV_MODE']) return false;
	global $LIB;
	echo '<pre style="background:#fafafa;color:black;font-size:1em;margin:10px 0;white-space:pre-wrap">';
	foreach ($GLOBALS as $sKey => $sValue) if($sValue == $sData AND !empty($sValue)) $varName = $sKey;
	if($flag!='file') echo '<div style="display:flex;justify-content:space-between;padding:7px 12px;background:#e0e0e0;"><b>'.(empty($varName) ? 'Нет данных' : '$'.$varName ).'</b> '.(empty($FILE) ? '' : $FILE.'('.$LINE.')').'</div><div style="padding:7px 12px;">';
	switch ($flag) {
		case 'pr': print_r($sData); break;
		case 'vd': var_dump($sData); break;
		case 'file': {
			$dump = print_r($sData, true)."\n";
			file_put_contents($_SERVER['DOCUMENT_ROOT']."/p $".$varName." - ".date('H;i;s d.m.Y').".txt", $dump);
		} break;
	}
	if($flag!='file') echo '</div></pre>';
}

function cookie($name, $content = '') {
	$cookieArgs = ['path' => '/', 'samesite' => 'Lax', 'domain' => $_SERVER['HTTP_HOST']];
	if(empty($content)) {
		$cookieArgs['expires'] = time()-60*60*24*30; 
	}
	else {
		$cookieArgs['expires'] = time()+60*60*24*30; 
		if(isset($_SERVER['HTTPS'])) $cookieArgs = array_merge($cookieArgs, ['secure' => true, 'httponly' => true]);
	}
	return setcookie($name, $content, $cookieArgs);
}

function redirect($url = '') {
	die("<script>window.location.href='{$url}'</script>");
}
