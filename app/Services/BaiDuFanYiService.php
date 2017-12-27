<?php
/**
 * 调用百度翻译接口
 * Created by PhpStorm.
 * Author: Fengguangyong
 * Date: 2017/12/7 - 15:03
 */

namespace App\Services;

use App\Exceptions\BusinessException;
use GuzzleHttp\Client;

/**
 * Class BaiDuFanYiService
 * @package App\Services
 */
class BaiDuFanYiService
{
    /**
     * @var
     */
    protected $url;
    /**
     * @var
     */
    protected $appId;
    /**
     * @var
     */
    protected $appKey;
    /**
     * @var Client
     */
    protected $client;

    /**
     * BaiDuFanYiService constructor.
     * @param $appId
     * @param $appKey
     * @param $url
     */
    public function __construct($appId, $appKey, $url)
    {
        $this->url = $url;
        $this->appId = $appId;
        $this->appKey = $appKey;
        $this->client = new Client();
    }

    /**
     * @param $title
     * @return mixed|string
     * @throws BusinessException
     * @author: Mikey
     */
    public function run($title)
    {
        $salt = $this->getRandNum();
        $response = $this->client->request('POST', $this->url, [
            'query' => [
                'q'     => $title,
                'from'  => 'zh',
                'to'    => 'en',
                'appid' => $this->appId,
                'salt'  => $salt,
                'sign'  => $this->sign($title, $salt),
            ]
        ]);
        $res = $response->getBody()->getContents();
        $res = json_decode($res, true);
        if (!empty($res['error_code'])) {
            throw new BusinessException($res['error_msg']);
        }
        $articleUrl = strtolower($res['trans_result'][0]['dst']);

        return str_replace(' ', '-', $articleUrl);
    }

    /**
     * 生成随机数
     * @return int
     * @author: Mikey
     */
    protected function getRandNum()
    {
        return mt_rand(10000, 99999);
    }

    /**
     * 生成sign
     * $str1 = appid+query+salt+密钥
     * md5($str1)
     * @param $query
     * @param $salt
     * @return string
     * @author: Mikey
     */
    public function sign($query, $salt)
    {
        return md5($this->appId . $query . $salt . $this->appKey);
    }
}