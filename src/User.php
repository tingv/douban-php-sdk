<?php

namespace Douban;

class User extends Request
{
    protected $query_params = [];

    public function __construct(Config $config, array $params = [])
    {
        parent::__construct($config);
        $this->query_params = array_merge($this->query_params, $params);
    }

    /**
     * 获取授权信息
     * @param string 用户名/邮箱
     * @param string 密码
     * @return object
     */
    public function token($username, $password)
    {
        $url = $this->config->base_url . $this->config->accessTokenUrl();

        $params = array_merge(
            $this->query_params,
            [
                'grant_type' => 'password',     // 使用账号密码方式获取授权，这也是官方客户端使用的方式
                'username' => $username,
                'password' => $password,
                '_v' => $this->config->_v,    // 暂不清楚具体意义，但不同客户端（指的是豆瓣和豆瓣电影客户端）似乎不同，不知道同一个客户端不同版本是否不同。当前值来源于豆瓣 iOS 客户端 v6.42.0
                'client_id' => $this->config->client_id,
                'client_secret' => $this->config->client_secret,
                'redirect_uri' => $this->config->base_url,
                'device_id' => $this->config->device_id,
            ]
        );
        return $this->sendRequest($url, $params);
    }

    /**
     * 更新授权信息
     * @param string 刷新令牌
     * @return object
     */
    public function refresh_token($refresh_token)
    {
        $url = $this->config->base_url . $this->config->accessTokenUrl();

        $params = array_merge(
            $this->query_params,
            [
                'grant_type' => 'refresh_token',
                '_v' => $this->config->_v,
                'client_id' => $this->config->client_id,
                'client_secret' => $this->config->client_secret,
                'refresh_token' => $refresh_token,
                'device_id' => $this->config->device_id,
            ]
        );
        return $this->sendRequest($url, $params);
    }

    /**
     * 获取用户信息
     * @param int 用户 ID
     * @return object
     */
    public function info($user_id)
    {
        $url = $this->config->base_url . $this->config->userInfoUrl($user_id);
        $params = array_merge(
            $this->query_params,
            [
                'longitude' => 0,   // 经度
                'latitude' => 0,    // 纬度
                'loc_id' => '', // 位置的数字 id，没有开定位就留空
                'version' => $this->config->version,  // 客户端版本号
            ]
        );
        return $this->sendRequest($url, $params);
    }


}