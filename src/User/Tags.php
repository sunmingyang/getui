<?php


namespace HaiXin\GeTui\User;


use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;

class Tags
{
    use HasRequest;
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
    
    /**
     * @param $device
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @example Push::user->tags(device)
     * @link https://docs.getui.com/getui/server/rest_v2/user/#doc-title-9
     */
    public function get($device): array
    {
        $response = $this->request("/user/custom_tag/cid/{$device}");
        
        return array_filter(explode(' ', $this->app->toArray($response, "{$device}.0")));
    }
}
