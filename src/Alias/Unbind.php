<?php


namespace HaiXin\GeTui\Alias;


use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;
use GuzzleHttp\RequestOptions;

class Unbind
{
    use HasRequest;
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
    
    /**
     * @param $input
     *
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @example  Push::alias->unbind([cid => alias])
     * @link https://docs.getui.com/getui/server/rest_v2/user/#doc-title-5
     */
    public function get($input): bool
    {
        $data = [];
        
        foreach ($input as $cid => $alias) {
            $data[] = compact('cid', 'alias');
        }
        
        $response = $this->request('/user/alias', 'delete', [RequestOptions::JSON => ['data_list' => $data]]);
        
        return $this->app->isSuccess($response);
    }
}
