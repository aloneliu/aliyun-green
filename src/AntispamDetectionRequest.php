<?php

namespace AliyunAntispam;
use Green\Request\V20161216 as Green;

class AntispamDetectionRequest
{
    public function __construct()
    {
        include_once 'aliyuncs/aliyun-php-sdk-core/config.php';
        date_default_timezone_set("PRC");
    }

    /**
     *
     * 纯文本垃圾检测接口
     */
    public static function text()
    {
        echo 'AntispamDetectionRequest-text';
    }



}


// //请替换成你自己的accessKeyId、accessKeySecret
// $iClientProfile = DefaultProfile::getProfile("cn-hangzhou", "你的accessKeyId", "你的accessKeySecret"); // TODO
// DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", "Green", "green.cn-hangzhou.aliyuncs.com");
// $client  = new DefaultAcsClient($iClientProfile);
// $request = new Green\TextAntispamDetectionRequest();
//
// //最多支持50个待检测文本同时检测
// $dataItem1 = [
//     'dataId'   => uniqid(), # 可填,如果未填,系统自动生成一个
//     'content'  => '小阿诗在等你:女生 就我对面一栋宿舍', #发帖内容, 必填
//     'postId'   => '111', # 发帖用户id 可选
//     'postTime' => round(microtime(true) * 1000) # 发帖时间, 可选
// ];
// $dataItem2 = [
//     'dataId'   => uniqid(), # 可填,如果未填,系统自动生成一个
//     'content'  => '你好牛', #发帖内容, 必填
//     'postId'   => '111', # 发帖用户id, 可选, postId与postTime需同时填后者不填
//     'postTime' => round(microtime(true) * 1000) # 发帖时间,可选, postId与postTime需同时填后者不填
// ];
//
// //设置要检测的文本, 可以同时检测最多50个文本
// $request->setDataItems(json_encode([$dataItem1, $dataItem2]));
//
// /**
//  * 设置自定义关键词的词库ID, 词库和关键词的定义前往绿网控制台定义和添加(https://yundun.console.aliyun.com/?p=cts#/greenWeb/config2),
//  * 词库ID在添加词库时会自动生成,显示在控制台
//  * 默认新增的词库自动在本接口生效, 如果想部分词库有用,请将以下参数指定为对应词库的ID
//  */
// $request->setCustomDict(json_encode(["11001"]));
// try {
//     $response = $client->getAcsResponse($request);
//     print_r($response);
//     //如果成功且命中
//     if ("Success" == $response->Code) {
//         $textAntispamResults = $response->TextAntispamResults->TextAntispamResult;
//         foreach ($textAntispamResults as $textAntispamResult) {
//             //原文本
//             print_r($textAntispamResult->Text);
//             //是否是垃圾
//             print_r($textAntispamResult->IsSpam);
//             print_r("\n");
//         }
//     }
// } catch (Exception $e) {
//     print_r($e);
// }