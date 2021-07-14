<?php


namespace HaiXin\GeTui\Report;


use GuzzleHttp\RequestOptions;
use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;

class User
{
    use HasRequest;
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
    
    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @example Push::report->user(2020-01-01)
     * @link    https://docs.getui.com/getui/server/rest_v2/report/#doc-title-5
     */
    public function get($date): array
    {
        $date = $this->app->toDate($date);
        $response = $this->request("/report/user/date/{$date}");
        
        return $this->app->toArray($response, $date);
    }
}
