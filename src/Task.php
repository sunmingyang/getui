<?php


namespace HaiXin\GeTui;


use HaiXin\GeTui\Task\Destroy;
use HaiXin\GeTui\Task\Progress;
use HaiXin\GeTui\Task\State;
use HaiXin\GeTui\Task\Stop;
use HaiXin\GeTui\Traits\Bus;

/**
 * Class Task
 *
 * @property Stop     $stop
 * @property State    $state
 * @property Destroy  $destroy
 * @property Progress $progress
 * @package HaiXin\GeTui
 */
class Task
{
    use Bus;
    
    protected array $providers = [
        'stop'     => Stop::class,
        'state'    => State::class,
        'destroy'  => Destroy::class,
        'progress' => Progress::class,
    ];
}
