<?php


namespace HaiXin\GeTui\Traits;


use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Helper\Audience;
use HaiXin\GeTui\Helper\Channel;
use HaiXin\GeTui\Helper\Filter;
use HaiXin\GeTui\Helper\Message;
use HaiXin\GeTui\Helper\Setting;
use RuntimeException;

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
    protected $extras;
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
        
        $this->__get('setting');
    }
    
    public function __get($name)
    {
        if (isset($this->container[$name]) === true) {
            return $this->container[$name];
        }
        
        if (isset($this->module[$name]) === true) {
            $this->container[$name] = new $this->module[$name]($this->app);
            
            return $this->container[$name];
        }
        
        throw new RuntimeException("{$name} 不存在");
    }
    
    public function extras(array $extras, $click = null, bool $mustString = true): self
    {
        if ($mustString === true) {
            foreach ($extras as $index => $datum) {
                $extras[$index] = (string) $datum;
            }
        }
        
        $this->__get('message')->extras($extras, $click);
        $this->__get('channel')->extras($extras, $click);
        
        return $this;
    }
    
    public function title($title): self
    {
        $this->__get('message')->title($title);
        $this->__get('channel')->title($title);
        
        return $this;
    }
    
    public function body($body): self
    {
        $this->__get('message')->body($body);
        $this->__get('channel')->body($body);
        
        return $this;
    }
    
    public function message($message): self
    {
        if (is_callable($message) === true) {
            $message($this->__get('message'));
        }
        
        if ($message instanceof Message) {
            $this->container['message'] = $message;
        }
        
        return $this;
    }
    
    public function channel($channel): self
    {
        if (is_callable($channel) === true) {
            $channel($this->__get('channel'));
        }
        
        if ($channel instanceof Channel) {
            $this->container['channel'] = $channel;
        }
        
        return $this;
    }
    
    public function setting($setting): self
    {
        if (is_callable($setting) === true) {
            $setting($this->__get('setting'));
        }
        
        if ($setting instanceof Setting) {
            $this->container['setting'] = $setting;
        }
        
        return $this;
    }
    
    public function audience($audience, $function = null): self
    {
        switch (true) {
            case is_callable($audience) === true:
                $audience($this->__get('audience'));
                break;
            case $audience instanceof Audience:
                $this->container['audience'] = $audience;
                break;
            default:
                if ($audience instanceof Filter) {
                    $function = 'filter';
                }
                
                if ($function === null) {
                    $function = strtolower(class_basename(static::class));
                }
                
                $this->__get('audience')->{$function}($audience);
                break;
        }
        
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
    
    public function serialize(): array
    {
        if (isset($this->container['audience']) === false && strtolower(class_basename(__CLASS__)) !== 'group') {
            throw new RuntimeException('请设置 audience');
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
