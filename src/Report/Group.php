<?php


namespace HaiXin\GeTui\Report;


use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;

class Group
{
    use HasRequest;
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
    
    /**
     * @param $group
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @example Push::report->group(group)
     * @link    https://docs.getui.com/getui/server/rest_v2/report/#doc-title-2
     */
    public function get($group): array
    {
        $response = $this->request("/report/push/task_group/{$group}");
        
        return $this->app->toArray($response);
    }
}
