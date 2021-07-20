<?php


namespace HaiXin\GeTui\Tags;


use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;
use HaiXin\GeTui\Traits\HasResponse;

class Unbind
{
    use HasRequest;
    use HasResponse;
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
    
    /**
     * @param $tag
     * @param $device
     *
     * @return array
     * @throws GuzzleException
     * @example Push::tags->unbind(tag, [device,device,device])
     * @link    https://docs.getui.com/getui/server/rest_v2/user/#doc-title-8
     */
    public function get($tag, $device): array
    {
        $response = $this->request("/user/custom_tag/batch/{$tag}",
            'delete',
            [RequestOptions::JSON => ['cid' => $device]]);
        
        return $this->toArray($response);
    }
}
