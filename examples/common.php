<?php
// ini_set('display_errors', 1);

include_once dirname(__DIR__) . '/vendor/autoload.php';

use Douban\Douban;

// 由于本 SDK 接口的参数来源于豆瓣 iOS 客户端 v6.42.0
// 所以建议从这个版本来获取 client_id 和 client_secret
$client_id = 'Your client id';
$client_secret = 'Your client secret';

// 需要先在 APP 里登录一次，然后把设备 id 填在这，否则授权时会要求验证手机号
$device_id = 'Your device id';

$Douban = new Douban($client_id, $client_secret, $device_id);