<?php


namespace HaiXin\GeTui\Traits;


use HaiXin\GeTui\GeTui;

trait Bus
{
    protected array $workers = [];
    
    protected GeTui $app;
    
    public function __construct(GeTui $app)
    {
        $this->app = $app;
    }
    
    public function __get($name)
    {
        return $this->__call($name, []);
    }
    
    public function __call($name, $arguments)
    {
        $name = strtolower($name);
        if (isset($this->providers[$name]) === false) {
            throw new \RuntimeException('GeTui.'.class_basename(__CLASS__).".{$name}不存在");
        }
        
        if (isset($this->workers[$name]) === false) {
            $this->workers[$name] = new $this->providers[$name]($this->app, ...$arguments ?? null);
        }
        
        if (method_exists($this->workers[$name], 'get') === true) {
            return $this->workers[$name]->get(...$arguments);
        }
        
        return $this->workers[$name];
    }
}
