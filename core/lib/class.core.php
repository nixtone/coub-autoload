<?
class Core {

	public function __construct() {

		global $LIB;

		// Адрес
		$LIB['CURRENT']['URL']['DOMAIN'] = $_SERVER['HTTP_HOST'];
		$LIB['CURRENT']['URL']['PROTOCOL'] = stripos($_SERVER['SERVER_PROTOCOL'], 'https') ? 'https' : 'http';
		$LIB['CURRENT']['URL']['ABSOLUTE_LINK'] = $LIB['CURRENT']['URL']['PROTOCOL'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$LIB['CURRENT']['URL']['REQUEST_URI'] = $_SERVER['REQUEST_URI'];
		$LIB['CURRENT']['URL']['PARSE_URL'] = parse_url($_SERVER['REQUEST_URI']);
		$LIB['CURRENT']['URL']['SECTION'] = array_filter(explode('/', $LIB['CURRENT']['URL']['PARSE_URL']['path']));
		$LIB['CURRENT']['URL']['GET'] = $_GET;
		

	}

}
