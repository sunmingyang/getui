<?php


namespace HaiXin\GeTui\Single;


use HaiXin\GeTui\Helper\Audience;
use HaiXin\GeTui\Helper\Channel;
use HaiXin\GeTui\Helper\Message;
use HaiXin\GeTui\Helper\Setting;
use HaiXin\GeTui\Traits\HasRequest;
use HaiXin\GeTui\Traits\Payload;
use HaiXin\GeTui\Traits\Simple;
use GuzzleHttp\RequestOptions;

/**
 * Class Device
 * @property Audience $audience
 * @property Message  $message
 * @property Channel  $channel
 * @property Setting  $setting
 * @package HaiXin\GeTui\Single
 */
class Device
{
    use HasRequest;
    use Payload;
    use Simple;
    
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @example $broadcast = Push::single->device->audience->device(device)->title(title)->body(body)->extras(extras)->submit();
     * @link https://docs.getui.com/getui/server/rest_v2/push/?id=doc-title-8#doc-title-1
     */
    public function submit()
    {
        dump($this->toArray());
        $response = $this->request('/push/single/cid', 'POST', [RequestOptions::JSON => $this->toArray()]);
        
        return $this->app->toArray($response);
    }
}
