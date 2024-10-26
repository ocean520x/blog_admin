<?php

namespace App\Services;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

class AliYunService
{
    /**
     * 发送
     * @param string $phone 接收短信的手机号码
     * @param string $content 短信内容(json)
     * @return array
     * @throws ClientException
     */
    public function sms($phone, $templateCode, $templateParam = [])
    {
        AlibabaCloud::accessKeyClient(config('my.aliyun.key'), config('my.aliyun.secret'))
            ->regionId('cn-hangzhou')
            ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                // ->scheme('https') // https | http
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->host('dysmsapi.aliyuncs.com')
                ->options([
                    'query' => [
                        'PhoneNumbers' => $phone,
                        'SignName' => config('my.aliyun.signName'),
                        'TemplateCode' => $templateCode,
                        'TemplateParam' => json_encode($templateParam),
                        'RegionId' => 'cn-hangzhou',
                    ],
                ])
                ->request();
            if ($result['Code'] == 'OK' || $result['Message'] == 'ok') {
                return ['code' => 0, 'msg' => '发送成功'];
            } else {
                return ['code' => 4003, 'msg' => $result['Message']];
            }
        } catch (ClientException $e) {
            return ['code' => 500, 'msg' => $e->getErrorMessage()];
        } catch (ServerException $e) {
            return ['code' => 500, 'msg' => $e->getErrorMessage()];
        }
    }
}
