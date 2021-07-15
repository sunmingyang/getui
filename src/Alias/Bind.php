<?php


namespace HaiXin\GeTui\Alias;


use GuzzleHttp\RequestOptions;
use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;

class Bind
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
     * @example  Push::alias->bind([cid => alias])
     * @link     https://docs.getui.com/getui/server/rest_v2/user/#doc-title-1
     */
    public function get($input): bool
    {
        $data = [];
        
        if (func_num_args() === 2) {
            $input = [$input => func_get_arg(1)];
        }
        
        foreach ($input as $cid => $alias) {
            $data[] = compact('cid', 'alias');
        }
        
        $response = $this->request('/user/alias', 'post', [RequestOptions::JSON => ['data_list' => $data]]);
        
        return $this->app->isSuccess($response);
    }
}
