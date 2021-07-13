<?php


namespace HaiXin\GeTui\Alias;


use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;

class Destroy
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
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @example  Push::alias->destroy(alias)
     * @link     https://docs.getui.com/getui/server/rest_v2/user/#doc-title-5
     */
    public function get($alias): bool
    {
        $response = $this->request("/user/alias/{$alias}", 'delete');
        
        return $this->app->isSuccess($response);
    }
}
