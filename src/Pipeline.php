<?php


namespace HaiXin\GeTui;

use HaiXin\GeTui\Pipeline\Alias;
use HaiXin\GeTui\Pipeline\Device;
use HaiXin\GeTui\Traits\Bus;

/**
 * Class Pipeline
 *
 * @property Device $device
 * @property Alias  $alias
 * @package HaiXin\GeTui
 */
class Pipeline
{
    use Bus;
    
    protected array $providers = [
        'device' => Device::class,
        'alias'  => Alias::class,
    ];
}
