<?php


namespace HaiXin\GeTui\Task;


use GuzzleHttp\Exception\GuzzleException;
use HaiXin\GeTui\Abstracts\NotPush;

class Destroy extends NotPush
{
    /**
     * @param $task
     *
     * @return bool
     * @throws GuzzleException
     * @example Push::task->destroy(task)
     * @link    https://docs.getui.com/getui/server/rest_v2/push/?id=doc-title-8#doc-title-13
     */
    public function get($task): bool
    {
        $response = $this->request("/task/schedule/{$task}", 'DELETE');
        
        return $this->isSuccess($response);
    }
}
