<?php


namespace HaiXin\GeTui\Alias;


use GuzzleHttp\Exception\GuzzleException;
use HaiXin\GeTui\Abstracts\NotPush;

class Destroy extends NotPush
{
    
    /**
     * @param $alias
     *
     * @return bool
     * @throws GuzzleException
     * @example  Push::alias->destroy(alias)
     * @link     https://docs.getui.com/getui/server/rest_v2/user/#doc-title-5
     */
    public function get($alias): bool
    {
        $response = $this->request("/user/alias/{$alias}", 'delete');
        
        return $this->isSuccess($response);
    }
}
