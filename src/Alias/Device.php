<?php


namespace HaiXin\GeTui\Alias;


use GuzzleHttp\Exception\GuzzleException;
use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;
use HaiXin\GeTui\Traits\HasResponse;

class Device
{
    use HasRequest;
    use HasResponse;
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
    
    /**
     * @param $alias
     *
     * @return array
     * @throws GuzzleException
     * @example  Push::alias->device(alias)
     * @link     https://docs.getui.com/getui/server/rest_v2/user/#doc-title-3
     */
    public function get($alias): string
    {
        $response = $this->request("/user/cid/alias/{$alias}");
        
        return $this->toArray($response, 'cid.0');
    }
}
