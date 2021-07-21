<?php


namespace HaiXin\GeTui\User;


use GuzzleHttp\Exception\GuzzleException;
use HaiXin\GeTui\Abstracts\NotPush;

class Tags extends NotPush
{
    /**
     * @param $device
     *
     * @return array
     * @throws GuzzleException
     * @example Push::user->tags(device)
     * @link    https://docs.getui.com/getui/server/rest_v2/user/#doc-title-9
     */
    public function get($device): array
    {
        $response = $this->request("/user/custom_tag/cid/{$device}");
        
        return array_filter(explode(' ', $this->toArray($response, "{$device}.0")));
    }
}
