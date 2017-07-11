<?php

namespace Liu\AliyunAscClient;

require_once __DIR__ . '/../aliyuncs/aliyun-php-sdk-core/Config.php';


class AscClient
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
     * 验证
     *
     */
    public function Check($csessionid, $token, $sig, $scene, $platform = 3)
    {
        $request = new AfsCheckRequest();

        $request->setSession($$csessionid); // 必填参数，从前端获取，不可更改
        $request->setToken($token); // 必填参数，从前端获取，不可更改
        $request->setSig($sig); // 必填参数，从前端获取，不可更改
        $request->setScene($scene); // 必填参数，从前端获取，不可更改
        $request->setPlatform($platform); // 必填参数，请求来源： 1：Android端； 2：iOS端； 3：PC端及其他

        try {
            $response = $this->client->doAction($request);
            print_r($response);
        } catch (Exception $e) {
            dump($e);
        }
    }


}