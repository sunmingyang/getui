<?php


namespace HaiXin\GeTui\Report;


use GuzzleHttp\Exception\GuzzleException;
use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;
use HaiXin\GeTui\Traits\HasResponse;

class Remainder
{
    use HasRequest;
    use HasResponse;
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
    
    /**
     * @return array
     * @throws GuzzleException
     * @example Push::report->remainder()
     * @link    https://docs.getui.com/getui/server/rest_v2/report/#doc-title-4
     */
    public function get(): array
    {
        $response = $this->request('/report/push/count');
        
        return $this->toArray($response);
    }
}
