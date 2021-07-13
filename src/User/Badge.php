<?php


namespace HaiXin\GeTui\User;


use HaiXin\GeTui\GeTui;
use GuzzleHttp\RequestOptions;
use HaiXin\GeTui\Traits\HasRequest;
class Badge
{
    use HasRequest;
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
    
    /**
     * @param         $badge
     * @param  array  $devices
     *
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @example Push::user->badge(badge, [device,device,device])
     * @link https://docs.getui.com/getui/server/rest_v2/user/#doc-title-14
     */
    public function get($badge, array $devices): bool
    {
        $response = $this->request(
            sprintf('/user/badge/cid/%s', implode(',', $devices)),
            'post',
            [RequestOptions::JSON => ['badge' => $badge]]);
        
        return $this->app->isSuccess($response);
    }
}
