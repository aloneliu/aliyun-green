<?php

namespace Liu\AliyunGreen;

require_once __DIR__ . '/../aliyuncs/aliyun-php-sdk-core/Config.php';

use Green\Request\V20161216 as Green;

class Colation
{
    protected $iClientProfile;

    protected $client;


    public function __construct($accessKeyId = null, $accessKeySecret = null)
    {
        // accessKeyId、accessKeySecret
        $this->iClientProfile = \DefaultProfile::getProfile("cn-hangzhou", $accessKeyId, $accessKeySecret);

        $this->client = new \DefaultAcsClient($this->iClientProfile);
    }

    /**
     * 输入文本检测
     *
     * @param $content  #发帖内容, 必填
     * @param $postId   #发帖用户id 可选
     * @param int $postTime #发帖时间, 可选
     *
     * return bool(true/false) (是垃圾内容返回true)
     */
    public function text($content, $postId = null)
    {
        $request = new Green\TextAntispamDetectionRequest();

        $postTime  = round(microtime(true) * 1000);
        $dataItem1 = [
            'dataId'   => uniqid(), # 可填,如果未填,系统自动生成一个
            'content'  => $content, # 发帖内容, 必填
            'postId'   => $postId,  # 发帖用户id 可选
            'postTime' => $postTime # 发帖时间, 可选
        ];

        // 设置要检测的文本, 可以同时检测最多50个文本
        $request->setDataItems(json_encode([$dataItem1]));

        try {
            $response = $this->client->getAcsResponse($request);
            // 如果成功且命中
            if ("Success" == $response->Code) {
                $textAntispamResults = $response->TextAntispamResults->TextAntispamResult;
                foreach ($textAntispamResults as $textAntispamResult) {
                    // 原文本
                    // print_r($textAntispamResult->Text);
                    // 是否是垃圾
                    // dump($textAntispamResult->IsSpam);
                    if ($textAntispamResult->IsSpam) {
                        return $IsSpam = true;
                    }
                }
            }
        } catch (Exception $e) {
            dump($e);
        }
    }

    /**
     *
     * 图片垃圾检测接口
     */
    public function img()
    {
        echo 'Colation-img';
    }

}