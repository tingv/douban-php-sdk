<?php

namespace Douban;

class Movie extends Request
{
    protected $query_params = [];

    public function __construct(Config $config, array $params = [])
    {
        parent::__construct($config);
        $this->query_params = array_merge($this->query_params, $params);
    }

    /**
     * 搜索影片
     * @param string 关键词
     * @param int 偏移值
     * @param int 每页最多结果数
     * @return object
     */
    public function search($keyword, $start=0, $count=15)
    {
        $url = $this->config->base_url . $this->config->searchMovieUrl();

        $params = array_merge(
            $this->query_params,
            [
                'q' => $keyword,   // 关键词
                'start' => $start,  // 偏移值
                'count' => $count,  // 每页最多结果数
                'longitude' => 0,   // 经度
                'latitude' => 0,    // 纬度
                'loc_id' => '', // 位置的数字 id，没有开定位就留空
            ]
        );
        return $this->sendRequest($url, $params);
    }

    /**
     * 获取电影信息
     * @param int 电影 ID
     * @return object
     */
    public function movie($movie_id)
    {
        $url = $this->config->base_url . $this->config->movieInfoUrl($movie_id);

        $params = array_merge(
            $this->query_params,
            [
                'longitude' => 0,   // 经度
                'latitude' => 0,    // 纬度
                'loc_id' => '', // 位置的数字 id，没有开定位就留空
                'version' => $this->config->version, // 版本号
            ]
        );
        return $this->sendRequest($url, $params);
    }

    /**
     * 获取电视剧信息
     * @param int 电视剧 ID
     * @return object
     */
    public function tv($tv_id)
    {
        $url = $this->config->base_url . $this->config->tvInfoUrl($tv_id);

        $params = array_merge(
            $this->query_params,
            [
                'longitude' => 0,   // 经度
                'latitude' => 0,    // 纬度
                'loc_id' => '', // 位置的数字 id，没有开定位就留空
                'version' => $this->config->version, // 版本号
            ]
        );
        return $this->sendRequest($url, $params);
    }
}