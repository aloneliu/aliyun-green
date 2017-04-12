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

        // \DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", "Green", "green.cn-hangzhou.aliyuncs.com");

        $this->client = new \DefaultAcsClient($this->iClientProfile);
    }

    /**
     *
     * 纯文本垃圾检测接口
     */
    public function text()
    {
        $request = new Green\TextAntispamDetectionRequest();

        $dataItem1 = [
            'dataId'   => uniqid(), # 可填,如果未填,系统自动生成一个
            'content'  => '小阿诗在等你:女生 就我对面一栋宿舍', #发帖内容, 必填
            'postId'   => '111', # 发帖用户id 可选
            'postTime' => round(microtime(true) * 1000) # 发帖时间, 可选
        ];
        $dataItem2 = [
            'dataId'   => uniqid(), # 可填,如果未填,系统自动生成一个
            'content'  => '你好牛', # 发帖内容, 必填
            'postId'   => '111', # 发帖用户id, 可选, postId与postTime需同时填后者不填
            'postTime' => round(microtime(true) * 1000) # 发帖时间,可选, postId与postTime需同时填后者不填
        ];

        //  设置要检测的文本, 可以同时检测最多50个文本
        $request->setDataItems(json_encode([$dataItem1, $dataItem2]));

        try {
            $response = $this->client->getAcsResponse($request);
            print_r($response);
            // 如果成功且命中
            if ("Success" == $response->Code) {
                $textAntispamResults = $response->TextAntispamResults->TextAntispamResult;
                foreach ($textAntispamResults as $textAntispamResult) {
                    // 原文本
                    print_r($textAntispamResult->Text);
                    // 是否是垃圾
                    print_r($textAntispamResult->IsSpam);
                    print_r("\n");
                }
            }
        } catch (Exception $e) {
            print_r($e);
        }
    }

    /**
     *
     * 图片垃圾检测接口
     */
    public function img()
    {
        echo 'Colation-Colation';
    }


}