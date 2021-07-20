<?php


namespace HaiXin\GeTui\Traits;


use ArrayAccess;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use JsonException;
use Psr\Http\Message\ResponseInterface;

trait HasResponse
{
    
    /**
     * 业务响应是否成功
     *
     * @param $response
     *
     * @return bool
     * @throws JsonException
     */
    public function isSuccess($response): bool
    {
        if ($response instanceof ResponseInterface) {
            $response = $this->toArray($response);
        }
        
        return $response['code'] === 0;
    }
    
    /**
     * 直接获取有效的响应内容
     *
     * @param        $response
     * @param  null  $key
     *
     * @return array|ArrayAccess|mixed
     * @throws JsonException
     */
    public function toArray($response, $key = null)
    {
        if ($key !== null) {
            $key = Str::start($key, 'data.');
        }
        
        $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        
        if (isset($data['data']) === true) {
            return Arr::get($data, $key ?? 'data');
        }
        
        return $data;
    }
}
