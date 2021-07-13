<?php


namespace HaiXin\GeTui\User;


use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;

class Black
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
     * @example Push::user->black(device,device)
     * @example Push::user->black([device,device])
     * @link https://docs.getui.com/getui/server/rest_v2/user/#doc-title-10
     */
    public function get($devices): array
    {
        if (is_array($devices) === false) {
            $devices = func_get_args();
        }
        
        $response = $this->request(
            sprintf('/user/black/cid/%s', implode(',', $devices)), 'post');
        
        return $this->app->isSuccess($response);
    }
}
