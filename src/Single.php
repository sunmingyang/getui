<?php


namespace HaiXin\GeTui;


use HaiXin\GeTui\Single\Alias;
use HaiXin\GeTui\Single\Device;
use HaiXin\GeTui\Traits\Bus;

/**
 * Class Single
 *
 * @property Device $device
 * @property Alias  $alias
 * @package HaiXin\GeTui
 */
class Single
{
    use Bus;
    
    protected array $providers = [
        'device' => Device::class,
        'alias'  => Alias::class,
    ];
}
