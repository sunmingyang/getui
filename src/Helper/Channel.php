<?php


namespace HaiXin\GeTui\Helper;


use HaiXin\GeTui\Traits\Rebound;
use Illuminate\Support\Arr;

class Channel
{
    use Rebound;
    
    public function get(): array
    {
        $data = [];
        
        Arr::set($data, 'push_channel.ios.aps.alert', []);
        Arr::set($data, 'push_channel.android.ups.notification', ['click_type' => 'startapp']);
        
        return $data;
    }
}
