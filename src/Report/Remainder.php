<?php


namespace HaiXin\GeTui\Report;


use GuzzleHttp\Exception\GuzzleException;
use HaiXin\GeTui\Abstracts\NotPush;

class Remainder extends NotPush
{
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
