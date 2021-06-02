<?
include($_SERVER['DOCUMENT_ROOT'].'/lib.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="icon" type="image/ico" href="/favicon.ico">
<title>Кубики</title>
<link rel="stylesheet" href="/static/fancy/jquery.fancybox.min.css">
<link rel="stylesheet" href="/static/custom.css">
<script src="/static/jquery-3.5.1.min.js"></script>
<script src="/static/fancy/jquery.fancybox.min.js"></script>
<script src="/static/custom.js"></script>
</head>
<body>

<div id="coub_page">
	<form method="post" class="searchForm">
		<input type="text" name="tag" placeholder="Поиск по тегам">
		<input type="hidden" name="CODE" value="search">
		<input type="submit" value="Поиск">
	</form>
	<form method="post" class="addCoubForm">
		<input type="text" name="COUB_ID" placeholder="COUB ID" class="field">
		<input type="text" name="TAGS" placeholder="Теги, через запятую" class="field">
		<input type="hidden" name="CODE" value="add">
		<input type="submit" value="Добавить">
	</form>
	<div class="wrap">
		<? coubList("SELECT * FROM `coub` LIMIT 30") ?>
	</div>
</div>

<?/*
stdClass Object
(
    [type] => video
    [version] => 1.0
    [width] => 500
    [height] => 281
    [title] => Ring-mod soundscape on the Seaboard GRAND
    [url] => https://coub.com/view/256pdu
    [thumbnail_url] => https://coubsecure-s.akamaihd.net/get/b173/p/coub/simple/cw_image/52970bf7f9d/368197162256249d3d311/big_1574891911_00063.jpg
    [thumbnail_width] => 500
    [thumbnail_height] => 281
    [author_name] => CoＮsTAＮ†IＮＥ
    [channel_url] => https://coub.com/constan-ine
    [provider_name] => Coub
    [provider_url] => https://coub.com/
    [html] => <iframe src="//coub.com/embed/256pdu?autoplay=true&maxheight=500&maxwidth=500&muted=true" allowfullscreen="true" frameborder="0" allow="autoplay" autoplay="true" width="500" height="281"></iframe>
)
*/?>

</body>
</html>