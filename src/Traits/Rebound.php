<?php


namespace HaiXin\GeTui\Traits;


trait Rebound
{
    protected $app;
    
    /**
     * Audience constructor.
     *
     * @param $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }
    
    public function __get($name)
    {
        return $this->app->{$name};
    }
    
    public function __call($name, $params)
    {
        switch ($name) {
            case 'extras':
            case 'title':
            case 'body':
                $this->app->{$name}(...$params);
                
                return $this;
            default;
                return $this->app->{$name}(...$params);
        }
    }
}
