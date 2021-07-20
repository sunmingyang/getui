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
 * Class Device
 *
 * @property Audience $audience
 * @property Message  $message
 * @property Channel  $channel
 * @property Setting  $setting
 * @package HaiXin\GeTui\Group
 */
class Device extends Group
{
    /**
     * @throws GuzzleException
     * @example Push::group->device->audience([device1,device2,device3])->task(task')->submit();
     * @link    https://docs.getui.com/getui/server/rest_v2/push/?id=doc-title-8#doc-title-6
     */
    public function submit()
    {
        $response = $this->request('/push/list/cid', 'POST', [RequestOptions::JSON => $this->getOptions()]);
        
        return $this->toArray($response, $this->options['taskid']);
    }
}
