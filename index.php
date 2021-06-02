<?
require_once($_SERVER['DOCUMENT_ROOT'].'/core/lib/index.php');

// Сколько загрузить кубов сразу
$LIB['LOAD_NOW'] = 30;

include($_SERVER['DOCUMENT_ROOT'].'/core/dev/header.php');
$LIB['COUB']->List($LIB['COUB']->Read(false, ['PAGE' => 1], $LIB['LOAD_NOW']));
include($_SERVER['DOCUMENT_ROOT'].'/core/dev/footer.php');


/*
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
*/