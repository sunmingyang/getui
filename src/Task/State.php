<?php


namespace HaiXin\GeTui\Task;


use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;
use Illuminate\Support\Carbon;

class State
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
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @example Push::task->state(task)
     * @link    https://docs.getui.com/getui/server/rest_v2/push/?id=doc-title-8#doc-title-12
     */
    public function get($task): array
    {
        $response = $this->request("/task/schedule/{$task}");
    
        return $this->app->toArray($response);
    }
}
