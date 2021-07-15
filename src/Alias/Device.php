<?php


namespace HaiXin\GeTui\Alias;


use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;

class Device
{
    use HasRequest;
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
    
    /**
     * @param $alias
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @example  Push::alias->device(alias)
     * @link     https://docs.getui.com/getui/server/rest_v2/user/#doc-title-3
     */
    public function get($alias): string
    {
        $response = $this->request("/user/cid/alias/{$alias}");
        
        return $this->app->toArray($response, 'cid.0');
    }
}
