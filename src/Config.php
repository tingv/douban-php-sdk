<?php

namespace Douban;

class Config
{
    protected $base_url = 'https://frodo.douban.com';
    protected $apikey;
    protected $client_id;
    protected $client_secret;
    protected $device_id;
    protected $udid;
    protected $douban_udid = 'eae10a5fa65e262c13d7ab315614f281651f4b17';    // 此参数来源于豆瓣 iOS 客户端 v7.35.0，但豆瓣电影 iOS 客户端也是这个 ID，所以猜测官方客户端都是这个 ID
    protected $version = '7.35.0';  // 客户端版本号
    protected $_v = '29971';  // 暂不清楚具体意义，但不同客户端（指的是豆瓣和豆瓣电影 iOS 客户端）似乎不同。不知道同一个客户端不同版本是否不同（未测试）。当前值来源于豆瓣 iOS 客户端 v7.35.0
    protected $access_token = null;

    public function __construct($apikey, $client_id, $client_secret, $device_id, $udid)
    {
        $this->apikey = $apikey;
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->device_id = $device_id;
        $this->udid = $udid;
    }

    public function accessTokenUrl()
    {
        return '/service/auth2/token';
    }

    public function userInfoUrl($user_id)
    {
        return sprintf("/api/v2/user/%u", $user_id);
    }

    public function movieInfoUrl($movie_id)
    {
        return sprintf("/api/v2/movie/%u", $movie_id);
    }

    public function tvInfoUrl($tv_id)
    {
        return sprintf("/api/v2/tv/%u", $tv_id);
    }

    public function searchMovieUrl()
    {
        return '/api/v2/search/movie';
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value) 
    {
        $this->$name = $value;
    }

}