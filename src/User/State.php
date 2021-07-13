<?php


namespace HaiXin\GeTui\User;


use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;

class State
{
    use HasRequest;
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
    
    /**
     * @param $devices
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @example Push::user->state(device,device)
     * @example Push::user->state([device,device])
     * @link https://docs.getui.com/getui/server/rest_v2/user/#doc-title-12
     */
    public function get($devices): array
    {
        if (is_array($devices) === false) {
            $devices = func_get_args();
        }
        
        $response = $this->request(
            sprintf('/user/status/%s', implode(',', $devices)), 'get');
        
        return $this->app->toArray($response);
    }
}
