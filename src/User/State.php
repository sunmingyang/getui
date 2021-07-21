<?php


namespace HaiXin\GeTui\User;


use GuzzleHttp\Exception\GuzzleException;
use HaiXin\GeTui\Abstracts\NotPush;

class State extends NotPush
{
    /**
     * @param $devices
     *
     * @return array
     * @throws GuzzleException
     * @example Push::user->state(device,device)
     * @example Push::user->state([device,device])
     * @link    https://docs.getui.com/getui/server/rest_v2/user/#doc-title-12
     */
    public function get($devices): array
    {
        if (is_array($devices) === false) {
            $devices = func_get_args();
        }
        
        $response = $this->request(
            sprintf('/user/status/%s', implode(',', array_unique($devices))), 'get');
        
        return $this->toArray($response);
    }
}
