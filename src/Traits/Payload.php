<?php


namespace HaiXin\GeTui\Traits;


use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Helper\Audience;
use HaiXin\GeTui\Helper\Channel;
use HaiXin\GeTui\Helper\Message;
use HaiXin\GeTui\Helper\Setting;

/**
 * Trait Payload
 *
 * @property Audience $audience
 * @property Message  $message
 * @property Channel  $channel
 * @property Setting  $setting
 * @package HaiXin\GeTui\Traits
 */
trait Payload
{
    protected $app;
    protected $sequence;
    protected $group;
    protected $container = [];
    protected $module    = [
        'audience' => Audience::class,
        'message'  => Message::class,
        'channel'  => Channel::class,
        'setting'  => Setting::class,
    ];
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
        
        foreach ($this->module as $key => $value) {
            $this->__get($key);
        }
    }
    
    public function __get($name)
    {
        if (isset($this->container[$name]) === true) {
            return $this->container[$name];
        }
        
        if (isset($this->module[$name]) === true) {
            $this->container[$name] = new $this->module[$name]($this);
            
            return $this->container[$name];
        }
        
        throw new \RuntimeException("{$name} 不存在");
    }
    
    public function message(Message $message): Payload
    {
        $this->container['message'] = $message;
        
        return $this;
    }
    
    public function channel(Channel $channel): Payload
    {
        $this->container['channel'] = $channel;
        
        return $this;
    }
    
    public function setting(Setting $setting): Payload
    {
        $this->container['setting'] = $setting;
        
        return $this;
    }
    
    public function audience($audience, $function = null): self
    {
        if ($audience instanceof Audience) {
            $this->container['audience'] = $audience;
            
            return $this;
        }
        
        if ($function === null) {
            $function = strtolower(class_basename(__CLASS__));
        }
        
        $this->__get('audience')->{$function}($audience);
        
        return $this;
    }
    
    public function sequence($sequence = null): self
    {
        $this->sequence = $sequence;
        
        return $this;
    }
    
    public function group($group): self
    {
        $this->group = $group;
        
        return $this;
    }
    
    public function toArray(): array
    {
        if (isset($this->container['audience']) === false) {
            throw new \RuntimeException('请设置 audience');
        }
        
        $data = [
            'request_id' => $this->sequence ?? md5(microtime()),
        ];
        
        if ($this->group !== null) {
            $data['group_name'] = $this->group;
        }
        
        foreach ($this->container as $value) {
            $data += $value->get();
        }
        
        if (method_exists($this, 'merge')) {
            $data = $this->merge($data);
        }
        
        return $data;
    }
}
