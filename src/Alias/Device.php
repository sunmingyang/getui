<?php


namespace HaiXin\GeTui\Alias;


use GuzzleHttp\Exception\GuzzleException;
use HaiXin\GeTui\Abstracts\NotPush;

class Device extends NotPush
{
    /**
     * @param $alias
     *
     * @return array
     * @throws GuzzleException
     * @example  Push::alias->device(alias)
     * @link     https://docs.getui.com/getui/server/rest_v2/user/#doc-title-3
     */
    public function get($alias): string
    {
        $response = $this->request("/user/cid/alias/{$alias}");
        
        return $this->toArray($response, 'cid.0');
    }
}
