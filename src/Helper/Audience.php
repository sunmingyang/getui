<?php


namespace HaiXin\GeTui\Helper;

use HaiXin\GeTui\Interfaces\NotPushInterface;

class Audience
{
    protected $app;
    protected $audience;
    
    /**
     * Audience constructor.
     *
     * @param $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }
    
    /**
     * 发送给所有设备
     *
     * @return mixed
     */
    public function all()
    {
        return $this->to('all');
    }
    
    protected function to($value, $category = null)
    {
        $this->audience = $value;
        
        if ($category !== null) {
            $this->audience = [$category => (array) $value];
        }
        
        return $this->app;
    }
    
    /**
     * 根据设备编号发送
     *
     * @param $device
     *
     * @return mixed
     */
    public function device($device)
    {
        return $this->to($device, 'cid');
    }
    
    /**
     * 根据别名发送
     *
     * @param $alias
     *
     * @return mixed
     */
    public function alias($alias)
    {
        return $this->to($alias, 'alias');
    }
    
    /**
     * 根据条件过滤发送
     *
     * @param  Filter  $filter
     *
     * @return mixed
     */
    public function filter(Filter $filter)
    {
        return $this->to($filter->toArray(), 'tag');
    }
    
    /**
     * 根据标签发送
     *
     * @param $tag
     *
     * @return mixed
     */
    public function tags($tag)
    {
        return $this->to($tag, 'fast_custom_tag');
    }
    
    public function get()
    {
        return ['audience' => $this->audience];
    }
}
