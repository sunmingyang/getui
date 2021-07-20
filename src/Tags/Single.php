<?php


namespace HaiXin\GeTui\Tags;


use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;
use HaiXin\GeTui\Traits\HasResponse;

class Single
{
    use HasRequest;
    use HasResponse;
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
    
    /**
     * @param  string  $device
     * @param  array   $tags
     *
     * @return bool
     * @throws GuzzleException
     * @example Push::tags->single(device,[tag,tag,tag])
     * @link    https://docs.getui.com/getui/server/rest_v2/user/#doc-title-6
     */
    public function get(string $device, array $tags): bool
    {
        $response = $this->request("/user/custom_tag/cid/{$device}",
            'post',
            [RequestOptions::JSON => ['custom_tag' => $tags]]);
        
        return $this->isSuccess($response);
    }
}
