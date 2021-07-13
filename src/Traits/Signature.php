<?php


namespace HaiXin\GeTui\Traits;


trait Signature
{
    protected function signature(): string
    {
        return hash('sha256', $this->app->config->get('key').$this->timestamp().$this->app->config->get('master'));
    }
    
    protected function timestamp()
    {
        return now()->timestamp * 1000;
    }
}
