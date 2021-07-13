<?php


namespace HaiXin\GeTui\User;


use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Helper\Filter;
use HaiXin\GeTui\Traits\HasRequest;
use GuzzleHttp\RequestOptions;

class Count
{
    use HasRequest;
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
    
    /**
     * @param $filter
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @example Push::user->count([[key,values[],opt_type])
     * @link    https://docs.getui.com/getui/server/rest_v2/user/#doc-title-15
     */
    public function get(Filter $filter): array
    {
        $response = $this->request(
            '/user/count',
            'post',
            [RequestOptions::JSON => ['tag' => $filter->toArray()]]);
        
        return $this->app->toArray($response);
    }
}
