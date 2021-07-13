<?php


namespace HaiXin\GeTui\Report;


use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;

class Online
{
    use HasRequest;
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
    
    /**
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @example Push::report->online()
     * @link    https://docs.getui.com/getui/server/rest_v2/report/#doc-title-6
     */
    public function get(): array
    {
        $response = $this->request('/report/online_user');
        
        return $this->app->toArray($response);
    }
}
