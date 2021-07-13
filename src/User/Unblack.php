<?php


namespace HaiXin\GeTui\User;


use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;

class Unblack
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
     * @example Push::user->unblack(device,device)
     * @example Push::user->unblack([device,device])
     * @link https://docs.getui.com/getui/server/rest_v2/user/#doc-title-11
     */
    public function get($devices): bool
    {
        if (is_array($devices) === false) {
            $devices = func_get_args();
        }
        
        $response = $this->request(
            sprintf('/user/black/cid/%s', implode(',', $devices)), 'DELETE');

        return $this->app->isSuccess($response);
    }
}
