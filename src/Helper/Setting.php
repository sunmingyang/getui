<?php


namespace HaiXin\GeTui\Helper;

class Setting
{
    protected $app;
    
    protected $ttl      = 259200000;
    protected $speed    = 0;
    protected $schedule;
    protected $strategy = [];
    
    /**
     * Audience constructor.
     *
     * @param $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }
    
    public function ttl($ttl): Setting
    {
        $this->ttl = $ttl;
        
        return $this;
    }
    
    public function strategy($value, $key = null)
    {
        if ($key !== null) {
            $this->strategy[$key] = $value;
        } else {
            $this->strategy = $value;
        }
        
        return $this;
    }
    
    public function schedule(int $time)
    {
        $this->schedule = $time <= 9999999999 ? $time * 1000 : $time;
        
        return $this;
    }
    
    public function speed($speed): Setting
    {
        $this->speed = $speed;
        
        return $this;
    }
    
    public function get(): array
    {
        return [
            'settings' => [
                'ttl'      => $this->ttl ?? 259200000,
                'speed'    => $this->speed ?? 0,
                'strategy' => $this->strategy ?: $this->app->getConfig('strategy'),
            ],
        ];
    }
}
