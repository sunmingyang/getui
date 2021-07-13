<?php


namespace HaiXin\GeTui;

use HaiXin\GeTui\Group\Alias;
use HaiXin\GeTui\Group\Create;
use HaiXin\GeTui\Group\Device;
use HaiXin\GeTui\Traits\Bus;

/**
 * Class Group
 * @property Create $create
 * @property Device $device
 * @property Alias $alias
 * @package HaiXin\GeTui
 */
class Group
{
    use Bus;
    protected array $providers = [
        'create' => Create::class,
        'device' => Device::class,
        'alias'  => Alias::class,
    ];
    
}
