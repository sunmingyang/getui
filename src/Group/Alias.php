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
 * Class Alias
 * @property Audience $audience
 * @property Message  $message
 * @property Channel  $channel
 * @property Setting  $setting
 * @package HaiXin\GeTui\Group
 */
class Alias
{
    use HasRequest;
    use Payload;
    use Simple;
    protected $options;
    
    public function audience(array $device): Alias
    {
        $this->options['audience'] ['alias'] = array_values(array_unique($device));
        
        return $this;
    }
    
    public function task($id): Alias
    {
        $this->options['taskid'] = $id;
        
        return $this;
    }
    
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @example Push::group->alias->audience([alias1,alias2,alias3])->task(task')->submit();
     * @link    https://docs.getui.com/getui/server/rest_v2/push/?id=doc-title-8#doc-title-7
     */
    public function submit()
    {
        $response = $this->request('/push/list/alias', 'POST', [RequestOptions::JSON => $this->options]);
        
        return $this->app->toArray($response, $this->options['taskid']);
    }
}
