<?php

require_once __DIR__ . '/common.php';

$movie = $Douban->movie();

// 搜索影视资源
$movie_list = $movie->search('八佰', 0, 3);

// 电影信息详情
$movie_info = $movie->movie(26754233);

// 电视剧信息详情
$tv_info = $movie->tv(34814172);

echo '<pre>';
var_dump($movie_list);
var_dump($movie_info);
var_dump($tv_info);
echo '</pre>';


