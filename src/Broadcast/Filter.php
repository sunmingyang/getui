<?php


namespace HaiXin\GeTui\Broadcast;


use HaiXin\GeTui\Helper\Audience;
use HaiXin\GeTui\Helper\Channel;
use HaiXin\GeTui\Helper\Message;
use HaiXin\GeTui\Helper\Setting;
use HaiXin\GeTui\Traits\HasRequest;
use HaiXin\GeTui\Traits\Payload;
use HaiXin\GeTui\Traits\Simple;
use GuzzleHttp\RequestOptions;

/**
 * Class Filter
 * @property Audience $audience
 * @property Message  $message
 * @property Channel  $channel
 * @property Setting  $setting
 * @package HaiXin\GeTui\Broadcast
 */
class Filter
{
    use HasRequest;
    use Payload;
    use Simple;
    
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @example
     *          $filter = (new
     *          Filter())->wherePhone()->whereOrRegion()->whereNotTag()->wherePortrait()->wherePortrait();
     *          $broadcast =
     *          Push::broadcast->filter->audience($filter, 'filter')->extras($extras)->title($title)->body($body)->submit($filter);
     * @link    https://docs.getui.com/getui/server/rest_v2/push/#doc-title-9
     */
    public function submit()
    {
        $response = $this->request('/push/tag', 'POST', [RequestOptions::JSON => $this->toArray()]);
        
        return $this->app->toArray($response, 'taskid');
    }
}
