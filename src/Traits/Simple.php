<?php


namespace HaiXin\GeTui\Traits;


use HaiXin\GeTui\Helper\Audience;
use HaiXin\GeTui\Helper\Channel;
use HaiXin\GeTui\Helper\Message;
use HaiXin\GeTui\Helper\Setting;
use Illuminate\Support\Arr;

/**
 * Trait Payload
 *
 * @property Audience $audience
 * @property Message  $message
 * @property Channel  $channel
 * @property Setting  $setting
 * @package HaiXin\GeTui\Traits
 */
trait Simple
{
    protected $extras;
    protected $title;
    protected $body;
    
    public function extras(array $extras): self
    {
        foreach ($extras as $index => $datum) {
            $extras[$index] = (string) $datum;
        }
        
        $this->extras = $extras;
        
        return $this;
    }
    
    public function title($title): self
    {
        $this->title = $title;
        
        return $this;
    }
    
    public function body($body): self
    {
        $this->body = $body;
        
        return $this;
    }
    
    public function isSimple(): bool
    {
        return isset($this->container['message'], $this->container['channel']);
    }
    
    protected function merge($data)
    {
        if ($this->title === null && $this->isSimple() === true) {
            throw new \RuntimeException('请设置推送标题');
        }
        
        if ($this->body === null && $this->isSimple() === true) {
            throw new \RuntimeException('请设置推送内容');
        }
        
        if (Arr::has($data, 'push_message.notification.title') === false) {
            Arr::set($data, 'push_message.notification.title', $this->title);
            Arr::set($data, 'push_channel.ios.aps.alert.title', $this->title);
            Arr::set($data, 'push_channel.android.ups.notification.title', $this->title);
        }
        
        if (Arr::has($data, 'push_message.notification.body') === false) {
            Arr::set($data, 'push_message.notification.body', $this->body);
            Arr::set($data, 'push_channel.ios.aps.alert.body', $this->body);
            Arr::set($data, 'push_channel.android.ups.notification.body', $this->body);
        }
        
        if ($this->extras !== null && Arr::has($data, 'push_message.notification.payload') === false) {
            $extras = to_json($this->extras);
            Arr::set($data, 'push_channel.ios.payload', $extras);
            Arr::set($data, 'push_channel.android.ups.notification.payload', $extras);
            Arr::set($data, 'push_channel.android.ups.notification.click_type', 'payload');
            Arr::set($data, 'push_message.notification.payload', $extras);
            Arr::set($data, 'push_message.notification.click_type', 'payload');
        }
        
        return $data;
    }
}
