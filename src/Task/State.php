<?php


namespace HaiXin\GeTui\Task;


use GuzzleHttp\Exception\GuzzleException;
use HaiXin\GeTui\Abstracts\NotPush;

class State extends NotPush
{
    /**
     * @param $task
     *
     * @return array
     * @throws GuzzleException
     * @example Push::task->state(task)
     * @link    https://docs.getui.com/getui/server/rest_v2/push/?id=doc-title-8#doc-title-12
     */
    public function get($task): array
    {
        $response = $this->request("/task/schedule/{$task}");
        
        return $this->toArray($response);
    }
}
