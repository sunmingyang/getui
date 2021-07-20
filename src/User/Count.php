<?php


namespace HaiXin\GeTui\User;


use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Helper\Filter;
use HaiXin\GeTui\Traits\HasRequest;
use HaiXin\GeTui\Traits\HasResponse;

class Count
{
    use HasRequest;
    use HasResponse;
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
    
    /**
     * @param  Filter  $filter
     *
     * @return array
     * @throws GuzzleException
     * @example Push::user->count([[key,values[],opt_type])
     * @link    https://docs.getui.com/getui/server/rest_v2/user/#doc-title-15
     */
    public function get(Filter $filter): int
    {
        $response = $this->request(
            '/user/count',
            'post',
            [RequestOptions::JSON => ['tag' => $filter->toArray()]]);
        
        return $this->toArray($response, 'user_count');
    }
}
