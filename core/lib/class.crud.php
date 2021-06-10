<?
class crud {

	public $table;

	// Проверка входных полей перед внесением в БД
	public function checkFields(&$fields) {
		// Удаление клечей, которым нет соответствующих полей в таблице
		foreach($fields as $key => $field) 
			if(!array_key_exists($key, $this->table['FIELDS'])) 
				unset($fields[$key]);
			else 
				$fields[$key] = empty($field) ? $this->table['FIELDS'][$key] : $field;
		// Обработка ключа "ACTIVE", чекбокс с ним присылает "on"
		// $fields['ACTIVE'] = isset($fields['ACTIVE']) ? 1 : 0; // мешает авторизации
	}

	public function defineTable($tableName) {
		$this->table['NAME'] = $tableName;
		foreach(DB::Query("SHOW COLUMNS FROM `".ENV['DB']['PREFIX'].$this->table['NAME']."`", 'assoc') as $column) {
			switch($column['Type']) {
				case 'int': $type = 0; break;
				case 'datetime': $type = ($column['Null'] == 'YES') ? 'NULL' : 'NOW()'; break;
				case ('varchar(255)' OR 'mediumtext'): $type = ''; break;
			}
			$this->table['FIELDS'][$column['Field']] = $type;
		}
	}

	public function row_s($arItem) {
		if(!$arItem['ROW_S']) $arItem = $arItem[array_key_first($arItem)];
		unset($arItem['ROW_S']);
		return $arItem;
	}

	public function repeatMatch($fieldName, &$fields) {
		return empty($this->row_s($this->crudRead(false, [$fieldName => $fields[$fieldName]]))) ? false : true;
	}

	public function crudCreate($fields = '') {
		$this->checkFields($fields);
		return DB::Query("INSERT INTO `".ENV['DB']['PREFIX'].$this->table['NAME']."` VALUES(".DB::insertChain($fields, $this->table['FIELDS']).")", 'lastId');
	}

	public function crudRead($ID = false, $fields = [], $onPage = 0, $SORT = false) {
		$LIMIT = '';
		if($ID AND $ID != 'row') $fields['ID'] = $ID;
		if(isset($fields['PAGE'])) {
			$page = (int)$fields['PAGE'];
			unset($fields['PAGE']);
		}
		else {
			$page = $_GET['page'] ?? 0;
		}
		if($onPage) {
			global $LIB;
			$LIB['PAGINATION']['ITEM_COUNT'] = DB::Query("SELECT count(ID) FROM `".$this->table['NAME']."`".DB::Where($fields), 'row'); // Кол-во записей из запроса
			ceil($LIB['PAGINATION']['ITEM_COUNT']['count(ID)'] / $onPage); // Кол-во страниц
			$LIB['PAGINATION']['START'] = $page ? ($page - 1) * $onPage : 0;
			$LIMIT = " LIMIT {$LIB['PAGINATION']['START']}, {$onPage}";
			$LIB['PAGINATION']['ONPAGE'] = $onPage;
		}
		if($SORT) $SORT = " ORDER BY `".array_key_first($SORT)."` ".$SORT[array_key_first($SORT)];
		$arList = DB::Query("SELECT * FROM `".ENV['DB']['PREFIX'].$this->table['NAME']."`".DB::Where($fields).$SORT.$LIMIT, 'rows');
		$arList['ROW_S'] = (is_array($ID) AND $ID != 'row' OR empty($ID)) ? true : false ;
		return $arList;
	}

	public function crudUpdate($ID, $fields = []) {
		$this->checkFields($fields);
		// return $fields;
		return DB::Query("UPDATE `".ENV['DB']['PREFIX'].$this->table['NAME']."` SET ".DB::updateChain($fields)." WHERE `ID`='$ID'");
	}
	
	public function crudDelete($ID) {
		return DB::Query("DELETE FROM `".ENV['DB']['PREFIX'].$this->table['NAME']."` WHERE `ID`='$ID'");
	}

}
