<?php


namespace HaiXin\GeTui\Helper;

use HaiXin\GeTui\Traits\Rebound;

class Setting
{
    use Rebound;
    
    protected int $ttl   = 259200000;
    protected int $speed = 0;
    
    
    public function ttl($ttl): Setting
    {
        $this->ttl = $ttl;
        
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
                'ttl'      => $this->ttl,
                'speed'    => $this->speed,
                'strategy' => [
                    'default' => 4,
                ],
            ],
        ];
    }
}
