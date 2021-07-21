<?php

namespace HaiXin\GeTui\Abstracts;

use HaiXin\GeTui\GeTui;
use HaiXin\GeTui\Traits\HasRequest;
use HaiXin\GeTui\Traits\HasResponse;

abstract class NotPush
{
    use HasRequest;
    use HasResponse;
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
}
