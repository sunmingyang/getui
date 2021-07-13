<?php


namespace HaiXin\GeTui;


use HaiXin\GeTui\Tags\More;
use HaiXin\GeTui\Tags\Single;
use HaiXin\GeTui\Tags\Unbind;
use HaiXin\GeTui\Traits\Bus;

/**
 * Class Tags
 *
 * @method bool  single($device, array $tags) 一个用户绑定一批标签，此操作为覆盖操作，会删除历史绑定的标签；
 * @method array more  (string $tag, array $device) 一批用户绑定一个标签，此接口为增量
 * @method array unbind(string $tag, array $device) 解绑用户的某个标签属性，不影响其它标签
 * @package HaiXin\GeTui
 */
class Tags
{
    use Bus;
    
    protected array $providers = [
        'single' => Single::class, // 一个用户绑定一批标签，此操作为覆盖操作，会删除历史绑定的标签；
        'more'   => More::class,   // 一批用户绑定一个标签，此接口为增量
        'unbind' => Unbind::class, // 解绑用户的某个标签属性，不影响其它标签
    ];
}
