<?php


namespace HaiXin\GeTui\Report;


use GuzzleHttp\Exception\GuzzleException;
use HaiXin\GeTui\Abstracts\NotPush;

class Task extends NotPush
{
    /**
     * @param $task
     *
     * @return array
     * @throws GuzzleException
     * @example Push::report->task(task,task,task)
     * @example Push::report->task([task,task,task]])
     * @link    https://docs.getui.com/getui/server/rest_v2/report/#doc-title-1
     */
    public function get($task): array
    {
        if (is_array($task) === false) {
            $task = func_get_args();
        }
        
        $response = $this->request(
            sprintf('/report/push/task/%s', implode(',', $task)), 'get');
        
        return $this->toArray($response);
    }
}
