<?php


namespace HaiXin\GeTui\Task;


use GuzzleHttp\Exception\GuzzleException;
use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;
use HaiXin\GeTui\Traits\HasResponse;

class Progress
{
    use HasRequest;
    use HasResponse;
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
    
    /**
     * @param $device
     * @param $task
     *
     * @return array
     * @throws GuzzleException
     * @example Push::task->progress(device, task)
     * @link    https://docs.getui.com/getui/server/rest_v2/push/?id=doc-title-8#doc-title-14
     */
    public function get($device, $task): array
    {
        $response = $this->request("/task/detail/{$device}/{$task}");
        
        return $this->toArray($response, 'deatil');
    }
}
