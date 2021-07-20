<?php


namespace HaiXin\GeTui\Report;


use GuzzleHttp\Exception\GuzzleException;
use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;
use HaiXin\GeTui\Traits\HasResponse;

class Task
{
    use HasRequest;
    use HasResponse;
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
    
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
