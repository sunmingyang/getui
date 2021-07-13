<?php


namespace HaiXin\GeTui\Group;


use HaiXin\GeTui\Helper\Audience;
use HaiXin\GeTui\Helper\Channel;
use HaiXin\GeTui\Helper\Message;
use HaiXin\GeTui\Helper\Setting;
use HaiXin\GeTui\Traits\HasRequest;
use HaiXin\GeTui\Traits\Payload;
use HaiXin\GeTui\Traits\Simple;
use GuzzleHttp\RequestOptions;

/**
 * Class Create
 * @property Audience $audience
 * @property Message  $message
 * @property Channel  $channel
 * @property Setting  $setting
 * @package HaiXin\GeTui\Group
 */
class Create
{
    use HasRequest;
    use Payload;
    use Simple;
    
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @example Push::group->create->title('批量推')->body('批量推')->extras($extras)->submit();
     * @link    https://docs.getui.com/getui/server/rest_v2/push/?id=doc-title-8#doc-title-5
     */
    public function submit()
    {
        $options = $this->toArray();
        
        unset($this->container['audience']);
        $response = $this->request('/push/list/message', 'POST', [RequestOptions::JSON => $options]);
        
        return $this->app->toArray($response, 'taskid');
    }
}
