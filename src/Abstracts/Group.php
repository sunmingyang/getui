<?php

namespace HaiXin\GeTui\Abstracts;

use HaiXin\GeTui\Interfaces\PushInterface;
use HaiXin\GeTui\Traits\HasRequest;
use HaiXin\GeTui\Traits\HasResponse;
use HaiXin\GeTui\Traits\Payload;

abstract class Group implements PushInterface
{
    use HasRequest;
    use HasResponse;
    use Payload;
    protected $options;
    
    abstract function submit();
    
    public function task($id): Group
    {
        $this->options['taskid'] = $id;
        
        return $this;
    }
    
    protected function getOptions()
    {
        return $this->options + $this->container['audience']->get();
    }
}
