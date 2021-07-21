<?php


namespace HaiXin\GeTui\Report;


use GuzzleHttp\Exception\GuzzleException;
use HaiXin\GeTui\Abstracts\NotPush;

class Day extends NotPush
{
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
