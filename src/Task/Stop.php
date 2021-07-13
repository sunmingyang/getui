<?php


namespace HaiXin\GeTui\Task;


use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;

class Stop
{
    use HasRequest;
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
    
    /**
     * @param $task
     *
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @example Push::task->stop(task)
     * @link    https://docs.getui.com/getui/server/rest_v2/push/?id=doc-title-8#doc-title-11
     */
    public function get($task): bool
    {
        $response = $this->request("/task/{$task}", 'DELETE');
        
        return $this->app->isSuccess($response);
    }
}
