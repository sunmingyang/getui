<?php


namespace HaiXin\GeTui\Broadcast;


use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use HaiXin\GeTui\Abstracts\Broadcast;
use HaiXin\GeTui\Helper\Audience;
use HaiXin\GeTui\Helper\Channel;
use HaiXin\GeTui\Helper\Message;
use HaiXin\GeTui\Helper\Setting;

/**
 * Class Tags
 *
 * @property Audience $audience
 * @property Message  $message
 * @property Channel  $channel
 * @property Setting  $setting
 * @package HaiXin\GeTui\Broadcast
 */
class Tags extends Broadcast
{
    /**
     * @throws GuzzleException
     * @example
     *          $broadcast = Push::broadcast->tags->audience($tag,
     *          'tag')->extras($extras)->title($title)->body($body)->submit(tag);
     * @link    https://docs.getui.com/getui/server/rest_v2/push/#doc-title-10
     */
    public function submit()
    {
        $response = $this->request('/push/all', 'POST', [RequestOptions::JSON => $this->serialize()]);
        
        return $this->toArray($response, 'taskid');
    }
}
