<?php


namespace HaiXin\GeTui\Helper;

use HaiXin\GeTui\Traits\Rebound;

class Audience
{
    use Rebound;
    
    protected $audience;
    
    public function all()
    {
        $this->to('all');
        
        return $this->app;
    }
    
    protected function to($value, $category = null)
    {
        $this->audience = $value;
        
        if ($category !== null) {
            $this->audience = [$category => (array) $value];
        }
        
        return $this->app;
    }
    
    public function device($device)
    {
        $this->to($device, 'cid');
        
        return $this->app;
    }
    
    public function alias($alias)
    {
        $this->to($alias, 'alias');
        
        return $this->app;
    }
    
    public function filter(Filter $filter)
    {
        $this->to($filter->toArray(), 'tag');
        
        return $this->app;
    }
    
    public function tags($tag)
    {
        $this->to($tag, 'fast_custom_tag');
        
        return $this->app;
    }
    
    public function get()
    {
        return ['audience' => $this->audience];
    }
}
