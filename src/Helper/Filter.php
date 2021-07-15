<?php


namespace HaiXin\GeTui\Helper;


use Illuminate\Support\Str;

class Filter
{
    protected $filter;
    
    public function __call($name, $params)
    {
        if (Str::startsWith($name, 'where')) {
            $finder = substr($name, 5);
            
            switch (true) {
                case stripos($finder, 'not') === 0:
                    $key = substr($finder, 3);
                    $opt = 'not';
                    break;
                case stripos($finder, 'or') === 0:
                    $key = substr($finder, 2);
                    $opt = 'or';
                    break;
                default:
                    $key = $finder;
                    $opt = 'and';
            }
            
            return $this->where($key, $params, $opt);
        }
        
        throw new \RuntimeException("{$name}不存在");
    }
    
    public function where($key, $value, $opt = 'and'): Filter
    {
        if (func_num_args() === 2) {
            $value = $opt;
            $opt   = 'and';
        }
    
        $keys = [
            'phone'    => 'phone_type',
            'region'   => 'region',
            'portrait' => 'portrait',
            'tag'      => 'custom_tag',
        ];
        
        $this->filter[] = ['key' => $keys[strtolower($key)], 'values' => (array) $value, 'opt_type' => $opt];
        
        return $this;
    }
    
    public function toArray(){
        return array_values($this->filter);
    }
}
