<?php


namespace HaiXin\GeTui\Group;


use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use HaiXin\GeTui\Abstracts\Group;
use HaiXin\GeTui\Helper\Audience;
use HaiXin\GeTui\Helper\Channel;
use HaiXin\GeTui\Helper\Message;
use HaiXin\GeTui\Helper\Setting;

/**
 * Class Create
 *
 * @property Audience $audience
 * @property Message  $message
 * @property Channel  $channel
 * @property Setting  $setting
 * @package HaiXin\GeTui\Group
 */
class Create extends Group
{
    /**
     * @throws GuzzleException
     * @example Push::group->create->title('批量推')->body('批量推')->extras($extras)->submit();
     * @link    https://docs.getui.com/getui/server/rest_v2/push/?id=doc-title-8#doc-title-5
     */
    public function submit()
    {
        $options = $this->serialize();
        
        unset($this->container['audience']);
        $response = $this->request('/push/list/message', 'POST', [RequestOptions::JSON => $options]);
        
        return $this->toArray($response, 'taskid');
    }
}
