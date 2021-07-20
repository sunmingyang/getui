<?php


namespace HaiXin\GeTui\Pipeline;


use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use HaiXin\GeTui\Abstracts\Pipeline;
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
 * @package HaiXin\GeTui\Pipeline
 */
class Device extends Pipeline
{
    /**
     * @throws GuzzleException
     * @example
     *          $push = Push::pipeline->device;
     *           for ($index = 0; $index < 100; ++$index) {
     *                  $push->audience(device)
     *                  ->title(title)
     *                  ->body(body)
     *                  ->extras(extras)
     *                  ->delay();
     *           }
     *           $push->submit();
     * @link    https://docs.getui.com/getui/server/rest_v2/push/?id=doc-title-8#doc-title-3
     */
    public function submit()
    {
        $options  = $this->options();
        $response = $this->request('/push/single/batch/cid', 'POST', [RequestOptions::JSON => $options]);
        
        return $this->toArray($response);
    }
    
}
