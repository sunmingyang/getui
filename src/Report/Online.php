<?php


namespace HaiXin\GeTui\Report;


use GuzzleHttp\Exception\GuzzleException;
use HaiXin\GeTui\Abstracts\NotPush;

class Online extends NotPush
{
    /**
     * @return bool
     * @throws GuzzleException
     * @example Push::report->online()
     * @link    https://docs.getui.com/getui/server/rest_v2/report/#doc-title-6
     */
    public function get(): array
    {
        $response = $this->request('/report/online_user');
        
        return $this->toArray($response);
    }
}
