<?php


namespace HaiXin\GeTui\Traits;

trait Signature
{
    protected function signature(): string
    {
        return hash('sha256', $this->app->getConfig('key').$this->timestamp().$this->app->getConfig('master'));
    }
    
    protected function timestamp()
    {
        return now()->timestamp * 1000;
    }
}
