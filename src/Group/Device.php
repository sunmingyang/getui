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
 * Class Device
 * @property Audience $audience
 * @property Message  $message
 * @property Channel  $channel
 * @property Setting  $setting
 * @package HaiXin\GeTui\Group
 */
class Device
{
    use HasRequest;
    use Payload;
    use Simple;
    
    protected $options;
    
    public function audience(array $device): Device
    {
        $this->options['audience'] ['cid'] = array_values(array_unique($device));
        
        return $this;
    }
    
    public function task($id): Device
    {
        $this->options['taskid'] = $id;
        
        return $this;
    }
    
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @example Push::group->device->audience([device1,device2,device3])->task(task')->submit();
     * @link    https://docs.getui.com/getui/server/rest_v2/push/?id=doc-title-8#doc-title-6
     */
    public function submit()
    {
        $response = $this->request('/push/list/cid', 'POST', [RequestOptions::JSON => $this->options]);
        
        return $this->app->toArray($response, $this->options['taskid']);
    }
}
