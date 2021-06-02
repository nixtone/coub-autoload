<?
class Coub extends crud {

	public $table;

	public function __construct() {
		$this->defineTable('coub'); // Название таблицы вместо 'tablename'
	}

	public function Create($fields = []) {
		// 
		return $this->crudCreate($fields);
	}

	public function Read($ID = false, $fields = [], $SORT = false) {
		// 
		$arItem = $this->crudRead($ID, $fields, $SORT);
		if(!$arItem['ROW_S']) $arItem = $arItem[array_key_first($arItem)];
		unset($arItem['ROW_S']);
		return $arItem;
	}

	public function list($readResult = []) {
		global $LIB;
		foreach($readResult as $item) {
			$previewPath = '/static/images/upload/'.$item['COUB_ID'].'.jpg';
			if(!file_exists($_SERVER['DOCUMENT_ROOT'].$previewPath)) {
				$coubObj = json_decode(file_get_contents('http://coub.com/api/oembed.json?url=http%3A//coub.com/view/'.$item['COUB_ID'].'&autoplay=true&maxwidth=500&maxheight=500'));
				$this->Update($item['ID'], ['TITLE' => addslashes($coubObj->title)]);
				$item['TITLE'] = $coubObj->title;
				file_put_contents($_SERVER['DOCUMENT_ROOT'].$previewPath, file_get_contents($coubObj->thumbnail_url));
			}
			// Подключение шаблона
			include($_SERVER['DOCUMENT_ROOT'].'/core/dev/item.php');
		}
	}

	public function Update($ID, $fields) {
		// 
		return $this->crudUpdate($ID, $fields);
	}

	public function Delete($ID) {
		// 
		return $this->crudDelete($ID);
	}

}