<?php

namespace Tests\GeTui;

trait GeTuiTrait
{
    protected $cid  = 'c2394e51d49986a02be9a182d0a7d985';
    protected $task = 'RASA_0712_650e73d8022f3035d6220f7534ca4e46';
    
    protected function getTitle()
    {
        return sprintf('title:%s;%s', __FUNCTION__, random_int(1, 1000));
    }
    
    protected function getBody()
    {
        return sprintf('body:%s;%s', __FUNCTION__, random_int(1, 1000));
    }
}
