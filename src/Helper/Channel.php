<?php


namespace HaiXin\GeTui\Helper;


use GuzzleHttp\Utils;
use Illuminate\Support\Arr;

class Channel
{
    protected $app;
    protected $options;
    protected $transmission;
    
    /**
     * Audience constructor.
     *
     * @param $app
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->android('click_type', 'startapp');
        
    }
    
    /**
     * iOS 第二级设置
     * ios.aps
     *
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function aps($key, $value): Channel
    {
        $this->set("ios.aps.{$key}", $value);
        return $this;
    }
    
    protected function set($key, $value): Channel
    {
        Arr::set($this->options, $key, $value);
        
        return $this;
    }
    
    /**
     * iOS 第二级设置
     * ios.multimedia
     *
     * @param  array  $multimedia
     *
     * @return $this
     */
    public function multimedia(array $multimedia): Channel
    {
        $this->set("ios.multimedia", $multimedia);
        
        return $this;
    }
    
    public function title($title): Channel
    {
        $this->alert('title', $title);
        $this->android('title', $title);
        
        return $this;
    }
    
    /**
     * iOS 第三级设置
     * ios.aps.alert
     *
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function alert($key, $value): Channel
    {
        $this->set("ios.aps.alert.{$key}", $value);
        
        return $this;
    }
    
    public function android($key, $value): Channel
    {
        $this->set("android.ups.notification.{$key}", $value);
        
        return $this;
    }
    
    public function body($body): Channel
    {
        $this->alert('body', $body);
        $this->android('body', $body);
        
        return $this;
    }
    
    public function all($key, $value): Channel
    {
        $this->android("options.ALL.{$key}", $value);
        return $this;
    }
    
    public function get(): array
    {
        
        
        return ['push_channel' => $this->options];
    }
    
    public function __call($name, $params)
    {
        if (strlen($name) === 2) {
            $name = strtoupper($name);
            $this->android("options.{$name}.{$params['0']}", $params['1']);
        }
        
        throw new \RuntimeException("方法 {$name} 未找到");
    }
    
    /**
     * 扩展消息
     *
     * @param $click
     * @param $params
     *
     * @return $this
     */
    public function extras($params, $click = null): Channel
    {
        if ($click === null) {
            $click = 'intent';
        }
        
        if (is_array($params) === true) {
            $params = Utils::jsonEncode($params, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
        
        if ($click === 'intent') {
            $params = sprintf($this->app->getConfig('intent'), $params);
        }
        
        $this->ios('payload', $params);
        $this->android('click_type', $click);
        $this->android($click, $params);
        
        return $this;
    }
    
    /**
     * iOS 第一级设置
     *
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function ios($key, $value): Channel
    {
        $this->set("ios.{$key}", $value);
        
        return $this;
    }
    
    /**
     * 透传消息内容，与notification 二选一，两个都填写时报错，长度 ≤ 3072
     *
     * @param $transmission
     *
     * @return $this
     */
    public function transmission($transmission): Channel
    {
        if (is_array($transmission) === true) {
            $transmission = Utils::jsonEncode($transmission, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
        
        $this->transmission = $transmission;
        
        return $this;
    }
}
