<?php

namespace HaiXin\GeTui\Facades;

use HaiXin\GeTui\Alias;
use HaiXin\GeTui\Broadcast;
use HaiXin\GeTui\Group;
use HaiXin\GeTui\Helper\Audience;
use HaiXin\GeTui\Helper\Channel;
use HaiXin\GeTui\Helper\Message;
use HaiXin\GeTui\Pipeline;
use HaiXin\GeTui\Report;
use HaiXin\GeTui\Single;
use HaiXin\GeTui\Tags;
use HaiXin\GeTui\Task;
use HaiXin\GeTui\User;
use Illuminate\Support\Facades\Facade;

/**
 * Class GeTui
 *
 * @property-read Alias    $alias     别名相关
 * @property-read Tags      $tags      标签相关
 * @property-read User      $user      用户相关
 * @property-read Report    $report    统计相关
 * @property-read Broadcast $broadcast 针对指定应用推送
 * @property-read Task      $task      任务
 * @property-read Group     $group     针对list推送
 * @property-read Single    $single    针对单个用户推送
 * @property-read Pipeline  $pipeline  针对多个用户推送
 * @method Message message() 获得 Message 对象
 * @method Channel channel() 获得 Channel 对象
 * @method Audience audience() 获得 Audience 对象
 * @package HaiXin\GeTui\Facades
 */
class GeTui extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'getui';
    }
}
