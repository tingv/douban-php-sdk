<?php

namespace Douban;

class Douban
{
    public $config;
    public function __construct($client_id, $client_secret, $device_id)
    {
        $apikey = $client_id;   // apikey 和 client_id 的值似乎是一样的
        $udid = $device_id;     // udid 和 device_id 的值似乎是一样的
        $this->config = new Config($apikey, $client_id, $client_secret, $device_id, $udid);
    }

    public function user(array $params = [])
    {
        return new User($this->config, $params);
    }

    public function movie(array $params = [])
    {
        return new Movie($this->config, $params);
    }

}