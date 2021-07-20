<?php


namespace HaiXin\GeTui\Broadcast;


use HaiXin\GeTui\Helper\Audience;
use HaiXin\GeTui\Helper\Channel;
use HaiXin\GeTui\Helper\Message;
use HaiXin\GeTui\Helper\Setting;
use HaiXin\GeTui\Traits\HasRequest;use HaiXin\GeTui\Traits\HasResponse;
use HaiXin\GeTui\Traits\Payload;
use GuzzleHttp\RequestOptions;

/**
 * Class All
 * @property Audience $audience
 * @property Message  $message
 * @property Channel  $channel
 * @property Setting  $setting
 * @package HaiXin\GeTui\Broadcast
 */
class All
{
    use HasRequest;use HasResponse;
    use Payload;
    
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @example $broadcast = Push::broadcast->all->extras($extras)->title($title)->body($body)->submit();
     * @link    https://docs.getui.com/getui/server/rest_v2/push/#doc-title-8
     */
    public function submit()
    {
        $this->audience->all();
        $response = $this->request('/push/all', 'POST', [RequestOptions::JSON => $this->serialize()]);
        
        return $this->toArray($response, 'taskid');
    }
}
