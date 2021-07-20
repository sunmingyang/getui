<?php


namespace HaiXin\GeTui\Report;


use GuzzleHttp\Exception\GuzzleException;
use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;
use HaiXin\GeTui\Traits\HasResponse;

class Day
{
    use HasRequest;
    use HasResponse;
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
    
    /**
     * @param $date
     *
     * @return array
     * @throws GuzzleException
     * @example Push::report->day(2020-01-01)
     * @link    https://docs.getui.com/getui/server/rest_v2/report/#doc-title-3
     */
    public function get($date): array
    {
        $date     = $this->app->toDate($date);
        $response = $this->request("/report/push/date/{$date}");
        
        return $this->toArray($response, $date);
    }
}
