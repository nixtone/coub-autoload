<?
class DB {
	
	static private $db;

	function __construct() {
		if(isset(ENV['DB']['NAME'])) {
			self::$db = new PDO("mysql:host=".ENV['DB']['HOST'].";dbname=".ENV['DB']['NAME'], ENV['DB']['USER'], ENV['DB']['PASSWORD']);
			self::$db->exec("SET NAMES UTF8");
		}
	}

	public static function Rows($rows = []) {
		array_unshift($rows, 'ID');
		foreach($rows as $key => $row) $result .= "`$row`".(array_key_last($rows) == $key ? '' : ',');
		return $result;
	}

	public static function Where($fields) {
		$WHERE = !empty($fields) ? ' WHERE ' : '';
		foreach ($fields as $field => $fVal) {
			$AND = array_key_first($fields) != $field ? ' AND ' : '' ;
			if($field == 'WHERE') {
				$WHERE .= (count($fields) > 1 ? $AND : '').$fields['WHERE'];	
				continue;
			}
			if(is_array($fVal)) {
				foreach ($fVal as $index => $fValItem) {
					$OR = array_key_first($fVal) == $index ? $AND.'(' : ' OR ';
					$WHERE .= $OR.'`'.$field.'`=\''.$fValItem.'\''.(array_key_last($fVal) == $index ? ')' : '');
				}
			}
			else {
				$WHERE .= $AND.'`'.$field.'`=\''.$db::quote($fVal).'\'';
			}
		}
		return $WHERE;
	}

	public static function insertChain($fields, $tableFields) {
		$insert_fields = '';
		foreach($tableFields as $fieldName => $fieldDefaultValue) $insert_fields .= "'".($fields[$fieldName] ?? $fieldDefaultValue)."',";
		$insert_fields = substr($insert_fields,0,-1); // Убираем запятую в конце строки
		$insert_fields = str_replace("'NOW()'", "NOW()", $insert_fields); // Снимаем ковычки вокруг NOW()
		$insert_fields = str_replace("'NULL'", "NULL", $insert_fields); // Снимаем ковычки вокруг NULL
		return $insert_fields;
	}

	public static function updateChain($fields) {
		$updFields = '';
		foreach ($fields as $key => $field) {
			$next = array_key_first($fields) == $key ? "" : ", ";
			$updFields .= $next."`$key`='$field'";
		}
		return $updFields;
	}

	public static function Query($sQuery, $flag = 1) {
		$result = [];
		global $LIB;
		$LIB['CURRENT']['DB_QUERY'][] = $sQuery;
		$sqlQuery = self::$db->query($sQuery);
		switch($flag) {
			case 'rows': {
				$sqlData = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
				foreach($sqlData as $item) $result[$item['ID']] = $item;
			} break;
			case 'row': $result = $sqlQuery->fetch(PDO::FETCH_ASSOC); break;
			case 'lastId': $result = self::$db->lastInsertId(); break;
			case 'assoc': $result = $sqlQuery->fetchAll(PDO::FETCH_ASSOC); break;
			// default: $result = $sqlQuery->error; 
		}
		return $result;
	}

}
