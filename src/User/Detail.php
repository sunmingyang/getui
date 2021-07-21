<?php


namespace HaiXin\GeTui\User;


use GuzzleHttp\Exception\GuzzleException;
use HaiXin\GeTui\Abstracts\NotPush;

class Detail extends NotPush
{
    /**
     * @param $devices
     *
     * @return array
     * @throws GuzzleException
     * @example Push::user->detail(device,device)
     * @example Push::user->detail([device,device])
     * @link    https://docs.getui.com/getui/server/rest_v2/user/#doc-title-13
     */
    public function get($devices): array
    {
        if (is_array($devices) === false) {
            $devices = func_get_args();
        }
        
        $response = $this->request(
            sprintf('/user/detail/%s', implode(',', $devices)), 'get');
        
        return $this->toArray($response, 'validCids');
    }
}
