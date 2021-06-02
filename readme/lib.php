<?

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'coub_autoload');

class DB {
	static private $db;
	public function __construct() {
		if(self::$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD)) {
			self::$db->exec("SET NAMES UTF8");
		}
	}
	public static function Query($sQuery, $flag = 1) {
		$sqlQuery = self::$db->query($sQuery);
		switch ($flag) {
			case 'rows': {
				$sqlData = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
				foreach($sqlData as $item) $result[$item['ID']] = $item;
			} break;
			case 'row': {
				$result = $sqlQuery->fetch(PDO::FETCH_ASSOC);
			} break;
			default: $result = self::$db->lastInsertId(); break;
		}
		return $result;
	}
}
$LIB['DB'] = new DB();

function template($name, $data = []) {
	include($_SERVER['DOCUMENT_ROOT'].'/templates/'.$name.'.php');
}

function coubList($sqlQuery) {
	if($arCoub = DB::Query($sqlQuery, 'rows')) {
		foreach($arCoub as $item) {
			$preview = '/static/images/'.$item['COUB_ID'].'.jpg';
			if(!file_exists($_SERVER['DOCUMENT_ROOT'].$preview)) {
				$coubObj = json_decode(file_get_contents('http://coub.com/api/oembed.json?url=http%3A//coub.com/view/'.$item['COUB_ID'].'&autoplay=true&maxwidth=500&maxheight=500'));
				DB::Query("UPDATE `coub` SET `title`='{$coubObj->title}' WHERE `ID`={$item['ID']}");
				$item['title'] = $coubObj->title;
				file_put_contents($_SERVER['DOCUMENT_ROOT'].$preview, file_get_contents($coubObj->thumbnail_url));
			}
			template('item', ['ID' => $item['ID'], 'COUB_ID' => $item['COUB_ID'], 'TITLE' => $item['title'], 'thumbUrl' => $preview, 'TAGS' => $item['TAGS']]);
		}
	}
	else {
		echo "<script>$(window).off('scroll');</script>";
	}
}

function p($data) {
	echo '<pre style="background: #eee; padding: 10px; white-space: pre-wrap;">';
	print_r($data);
	echo '</pre>';
}