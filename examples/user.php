<?php

require_once __DIR__ . '/common.php';

$user = $Douban->user();

// 使用账号密码获取授权
$auth_info = $user->token('Your username', 'Your password');

// 如果接口需要授权访问，先设置访问令牌
$Douban->config->setAccessToken($auth_info->access_token);

// 获取用户信息
$user_info = $user->info($auth_info->douban_user_id);

// 获取新的授权信息
$new_auth_info = $user->refresh_token($auth_info->refresh_token);

echo '<pre>';
var_dump($auth_info);
var_dump($user_info);
var_dump($new_auth_info);
echo '</pre>';


