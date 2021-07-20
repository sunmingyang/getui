<?php


namespace HaiXin\GeTui;


use HaiXin\GeTui\Alias\Bind;
use HaiXin\GeTui\Alias\Destroy;
use HaiXin\GeTui\Alias\Device;
use HaiXin\GeTui\Alias\Unbind;
use HaiXin\GeTui\Traits\Bus;

/**
 * Class Alias
 *
 * @method bool bind(array $datum) $datum: [cid => alias]
 *         将设备与别名进行绑定。一个cid只能绑定一个别名，若已绑定过别名的cid再次绑定新别名，则前一个别名会自动解绑，并绑定新别名。
 * @method array device(string $alias) 通过传入的别名查询对应的cid信息
 * @method bool unbind(array $datum) $datum: [cid => alias] 批量解除别名与cid的关系
 * @method bool destroy(array $alias) 解绑所有与该别名绑定的cid
 *
 * @package HaiXin\GeTui
 */
class Alias
{
    use Bus;
    
    protected array $providers = [
        'bind'    => Bind::class,    // 一个cid只能绑定一个别名，若已绑定过别名的cid再次绑定新别名，则前一个别名会自动解绑，并绑定新别名。
        'device'  => Device::class,  // 通过传入的别名查询对应的cid信息
        'unbind'  => Unbind::class,  // 批量解除别名与cid的关系
        'destroy' => Destroy::class, // 解绑所有与该别名绑定的cid
    ];
}
