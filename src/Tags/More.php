<?php


namespace HaiXin\GeTui\Tags;


use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use HaiXin\GeTui\Abstracts\NotPush;

class More extends NotPush
{
    /**
     * @param $tag
     * @param $devices
     *
     * @return array
     * @throws GuzzleException
     * @example Push::tags->more(tag,[device,device,device])
     * @link    https://docs.getui.com/getui/server/rest_v2/user/#doc-title-7
     */
    public function get($tag, $devices): array
    {
        $response = $this->request("user/custom_tag/batch/{$tag}",
            'put',
            [RequestOptions::JSON => ['cid' => array_unique($devices)]]);
        
        return $this->toArray($response);
    }
}
