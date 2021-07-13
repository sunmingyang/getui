<?php


namespace HaiXin\GeTui\Helper;

use HaiXin\GeTui\Traits\Rebound;

class Message
{
    use Rebound;
    
    protected $level;
    protected $transmission;
    protected $revoke;
    protected $task;
    protected $force;
    
    
    public function task($task): Message
    {
        $this->task = $task;
        
        return $this;
    }
    
    public function force($force): Message
    {
        $this->force = $force;
        
        return $this;
    }
    
    public function get(): array
    {
        switch (true) {
            case $this->transmission !== null:
                $data['transmission'] = $this->transmission;
                
                break;
            case isset($this->task) === true:
                $data['revoke'] = [
                    'old_task_id' => $this->task,
                    'force'       => $this->force ?? false,
                ];
                break;
            default:
                $data['notification'] = [
                    'click_type' => 'startapp',
                ];
        }
        
        return ['push_message' => $data];
    }
    
}
