<?php


namespace HaiXin\GeTui;


use HaiXin\GeTui\Report\Day;
use HaiXin\GeTui\Report\Group;
use HaiXin\GeTui\Report\Online;
use HaiXin\GeTui\Report\Remainder;
use HaiXin\GeTui\Report\Task;
use HaiXin\GeTui\Report\User;
use HaiXin\GeTui\Traits\Bus;


/**
 * Class Report
 * @method array task(array $task) 查询推送数据，可查询消息可下发数、下发数，接收数、展示数、点击数等结果。支持单个taskId查询和多个taskId查询。
 * @method array group($group) 根据任务组名查询推送结果，返回结果包括消息可下发数、下发数，接收数、展示数、点击数。
 * @method array day($date) 调用此接口可以获取某个应用单日的推送数据推送数据包括：下发数，接收数、展示数、点击数目前只支持查询非当天的数据
 * @method array remainder() 查询应用当日可推送量和推送余量
 * @method array user($date) 调用此接口可以获取某个应用单日的用户数据用户数据包括：新增用户数，累计注册用户总数，在线峰值，日联网用户数目前只支持查询非当天的数据
 * @method array online() 查询当前时间一天内的在线用户数10分钟一个点，1个小时六个点
 *
 * @package HaiXin\GeTui
 */
class Report
{
    use Bus;
    
    protected array $providers = [
        'task'      => Task::class,      // 查询推送数据，可查询消息可下发数、下发数，接收数、展示数、点击数等结果。支持单个taskId查询和多个taskId查询。
        'group'     => Group::class,     // 根据任务组名查询推送结果，返回结果包括消息可下发数、下发数，接收数、展示数、点击数。
        'day'       => Day::class,       // 调用此接口可以获取某个应用单日的推送数据(推送数据包括：下发数，接收数、展示数、点击数)(目前只支持查询非当天的数据)
        'remainder' => Remainder::class, // 查询应用当日可推送量和推送余量
        'user'      => User::class,      // 调用此接口可以获取某个应用单日的用户数据(用户数据包括：新增用户数，累计注册用户总数，在线峰值，日联网用户数)(目前只支持查询非当天的数据)
        'online'    => Online::class,    // 查询当前时间一天内的在线用户数(10分钟一个点，1个小时六个点)
    ];
}
