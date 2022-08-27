<?php

namespace Douban;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Request
{
    protected $config;
    private $timestamp;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->timestamp = time();
    }

    private function createSignature($url, $method, $access_token)
    {
        $url = str_replace($this->config->base_url,'', $url);
        $sig_string = $method."&".urlencode($url);
        if ($access_token) {
            $sig_string .= "&" . $access_token;
        }
        $sig_string .= "&".$this->timestamp;
        return urlencode(base64_encode(hash_hmac('sha1', $sig_string, $this->config->client_secret, true)));
    }

    protected function sendRequest($url, $params=[], $method='POST')
    {
        $method = strtoupper($method);
        $access_token = $this->config->access_token;
        $signature = $this->createSignature($url, $method, $access_token);
        $params = array_merge(
            $params,
            // 下面是一些固定参数
            [
                '_sig' => $signature,
                '_ts' => $this->timestamp,
                'alt' => 'json',
                'apikey' => $this->config->apikey,
                'douban_udid' => $this->config->douban_udid,
                'udid' => $this->config->udid,
            ]
        );

        $headers = [
            'User-Agent' => 'api-client/0.1.3 com.douban.frodo/7.35.0 iOS/14.3 model/iPhone12,1 network/wifi',
            'Accept-Language' => 'zh-Hans-CN;q=1, en-CN;q=0.9',
        ];

        if ($access_token) {
            $headers['Authorization'] = 'Bearer '.$access_token;
        }

        $options = [
            'headers' => $headers,
        ];

        if ($method == 'GET') {
            $url .= '?' . http_build_query($params, null, '&', PHP_QUERY_RFC3986);
        }

        if ($method == 'POST') {
            $options['form_params'] = $params;
        }

        $client = new Client();
        try {
            $response = $client->request($method, $url, $options);
            $body = $response->getBody();
            $stringBody = (string) $body;
        } catch (RequestException $e) {
            $stringBody = $e->getResponse()->getBody()->getContents();
        }

        return json_decode($stringBody, false);
    }
}