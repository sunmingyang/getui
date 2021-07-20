<?php


namespace HaiXin\GeTui\Single;


use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use HaiXin\GeTui\Abstracts\Single;
use HaiXin\GeTui\Helper\Audience;
use HaiXin\GeTui\Helper\Channel;
use HaiXin\GeTui\Helper\Message;
use HaiXin\GeTui\Helper\Setting;

/**
 * Class Device
 *
 * @property Audience $audience
 * @property Message  $message
 * @property Channel  $channel
 * @property Setting  $setting
 * @package HaiXin\GeTui\Single
 */
class Device extends Single
{
    /**
     * @throws GuzzleException
     * @example $broadcast =
     *          Push::single->device->audience->device(device)->title(title)->body(body)->extras(extras)->submit();
     * @link    https://docs.getui.com/getui/server/rest_v2/push/?id=doc-title-8#doc-title-1
     */
    public function submit()
    {
        $response = $this->request('/push/single/cid', 'POST', [RequestOptions::JSON => $this->serialize()]);
        
        return $this->toArray($response);
    }
}
