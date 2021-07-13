<?php


namespace HaiXin\GeTui\Pipeline;


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
 * @package HaiXin\GeTui\Pipeline
 */
class Device
{
    use HasRequest;
    use Payload;
    use Simple;
    
    protected $options;
    
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
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
        if ($this->options !== null) {
            $options['msg_list'] = $this->options;
        } else {
            $options = $this->toArray();
        }
        
        $response = $this->request('/push/single/batch/cid', 'POST', [RequestOptions::JSON => $options]);
        
        return $this->app->toArray($response);
    }
    
    public function delay(): Device
    {
        $this->options[] = $this->toArray();
        return $this;
    }
}
