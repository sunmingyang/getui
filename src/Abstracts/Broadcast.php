<?php

namespace HaiXin\GeTui\Abstracts;

use HaiXin\GeTui\Interfaces\PushInterface;
use HaiXin\GeTui\Traits\HasRequest;
use HaiXin\GeTui\Traits\HasResponse;
use HaiXin\GeTui\Traits\Payload;

abstract class Broadcast implements PushInterface
{
    use HasRequest;
    use HasResponse;
    use Payload;
    
    abstract function submit();
}
