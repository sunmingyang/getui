<?php

namespace HaiXin\GeTui\Abstracts;

use HaiXin\GeTui\Interfaces\PushInterface;
use HaiXin\GeTui\Traits\HasRequest;
use HaiXin\GeTui\Traits\HasResponse;
use HaiXin\GeTui\Traits\Payload;

abstract class Pipeline implements PushInterface
{
    use HasRequest;
    use HasResponse;
    use Payload;
    
    protected $options;
    
    public function delay(): self
    {
        $this->options[] = $this->serialize();
        
        return $this;
    }
    
    abstract function submit();
    
    protected function options(): array
    {
        if ($this->options !== null) {
            $options['msg_list'] = $this->options;
        } else {
            $options = $this->serialize();
        }
        
        return $options;
    }
}
