<?php


namespace HaiXin\GeTui\Report;


use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;
use Illuminate\Support\Carbon;

class Day
{
    use HasRequest;
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
    
    /**
     * @param $date
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @example Push::report->day(2020-01-01)
     * @link    https://docs.getui.com/getui/server/rest_v2/report/#doc-title-3
     */
    public function get($date): array
    {
        switch (true) {
            case is_numeric($date) && strlen($date) === 10;
                $date = Carbon::createFromTimestamp($date);
                break;
            case is_string($date):
                $date = Carbon::parse($date);
                break;
            case $date instanceof \DateTime:
        }
        
        $date = $date->format('Y-m-d');
        
        $response = $this->request("/report/push/date/{$date}");
        
        return $this->app->toArray($response, $date);
    }
}
