<?php


namespace HaiXin\GeTui\User;


use GuzzleHttp\Exception\GuzzleException;
use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;
use HaiXin\GeTui\Traits\HasResponse;

class Black
{
    use HasRequest;
    use HasResponse;
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
    
    /**
     * @param $devices
     *
     * @return bool
     * @throws GuzzleException
     * @example Push::user->black(device,device)
     * @example Push::user->black([device,device])
     * @link    https://docs.getui.com/getui/server/rest_v2/user/#doc-title-10
     */
    public function get($devices): bool
    {
        if (is_array($devices) === false) {
            $devices = func_get_args();
        }
        
        $response = $this->request(
            sprintf('/user/black/cid/%s', implode(',', array_unique($devices))), 'post');
        
        return $this->isSuccess($response);
    }
}
