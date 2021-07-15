# GeTui

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

## 路线图

略。。。

## 安装

``` bash
$ composer require haixin/getui

artisan vendor:publish --provider="HaiXin\GeTui\GeTuiServiceProvider"
```

## 使用

```php
$pusher = resolve('getui');
```

### token

```php
$token = $pusher->token;

$token->key(); // token缓存的key
$token->get(); // 获取token
$token->destroy(); // 销毁 token（仅销毁当前生命周期内，不请求 api）
$token->refresh($force = false); // 非强制的话，重新从缓存加载。缓存不存在请求接口；强制的话直接请求接口


```

### alias

```php
$alias = $pusher->alias;

$alias->bind(cid，alias); 			 // 设备与别名绑定；单一绑定
$alias->bind([cid => alias]);		// 设备与别名绑定；批量绑定
$alias->device(cid); 						// 根据设备查询别名
$alias->unbind(cid，alias); 		 // 解除设备与别名的绑定关系
$alias->unbind([cid => alias]); // 解除设备与别名的绑定关系
$alias->destroy([cid => alias]);// 解除所有与该别名绑定的设备
```

### tags

```php
$tags = $pusher->tags;

$tags->single(cid, [tag1,tag2,tag3,...]); 				// 给指定设备绑定一批标签
$tags->more(tag,[device1,device2,device3,...]); 	// 一批设备绑定相同的一个标签
$tags->unbind(tag,[device1,device2,device3,...]); // 一批设备解绑一个标签（指定设备解绑指定标签）
```

### user

``` php
$user = $pusher->user;

$filter = new \HaiXin\GeTui\Helper\Filter();

// 仅支持以下 4种方式
// 'phone'    => 'phone_type',
// 'region'   => 'region',
// 'portrait' => 'portrait',
// 'tag'      => 'custom_tag',
$filter->where('phone','ios') 		// and
  		 ->whereOr('phone','ios') 	// or
  	   ->whereNot('phone','ios') 	// not
  		 ->wherePhone('ios'); 			// and
$user->count($filter); 											  			// 查询总用户数量
$user->detail(device1,device2,device3,...); 				// 查询用户信息
$user->detail([device1,device2,device3,...]); 			// 查询用户信息
$user->state(device1,device2,device3,...); 					// 查询用户状态
$user->state([device1,device2,device3,...]); 				// 查询用户状态
$user->black(device1,device2,device3,...); 					// 加入黑名单
$user->black([device1,device2,device3,...]); 				// 加入黑名单
$user->unblack(device1,device2,device3,...); 				// 移除黑名单
$user->unblack([device1,device2,device3,...]);			// 移除黑名单
$user->tags(device); 																// 根据设备查询用户标签
$user->badge(badge, [device1,device2,device3,...]); // 设置角标
```

### report

```php
$report = $pusher->report;

$report->task(device1,device2,device3,...); 	// 根据任务编号查询任务详情
$report->task([device1,device2,device3,...]); // 根据任务编号查询任务详情
$report->group(group); 												// 根据任务组名查询任务详情
$report->day('2020-01-01'); 									// 指定日期的推送数据
$report->remainder(); 											  // 今日已推送与剩余可用推送量
$report->user('2020-01-01'); 									// 指定日期用户数据
$report->online();														// 近24小时在线用户统计
```



### task

```php
$task =  $pusher->task;

$task->stop(task);						// 停止任务
$task->state(task);						// 定时任务状态
$task->destroy(task);					// 删除定时任务状态
$task->progress(device,task);	// 指定任务下某设备的进度
```

### broadcast

```php
$broadcast = $pusher->broadcast;

$broadcast->all->extras($extras)->title($title)->body($body)->submit(); // 推送给全部用户
$broadcast->tags->extras($extras)->title($title)->body($body)->audience('标签','tags')->submit(); // 推送给指定标签的用户

$filter = new \HaiXin\GeTui\Helper\Filter();

// 仅支持以下 4种方式
// 'phone'    => 'phone_type',
// 'region'   => 'region',
// 'portrait' => 'portrait',
// 'tag'      => 'custom_tag',
$filter->where('phone','ios') 		// and
  		 ->whereOr('phone','ios') 	// or
  	   ->whereNot('phone','ios') 	// not
  		 ->wherePhone('ios'); 			// and
$broadcast->filter->extras($extras)->title($title)->body($body)->audience($filter)->submit(); // 推送给符合筛选条件的用户
```

### group

```php
$group = $pusher->group;

$task = $group->create->title('批量推')->body('批量推')->extras($extras)->submit(); // 预创建消息
$group->device->audience([device1,device2,device3])->task(task)->submit(); // 推送给指定设备
group->alias->audience([device1,device2,device3])->task(task)->submit(); // 推送给指定别名

```

### single

```php
$single = $pusher->single;

$single->device->audience->device(device)->title(title)->body(body)->extras(extras)->submit(); // 根据设备单推

$single->alias->audience->device(device)->title(title)->body(body)->extras(extras)->submit(); // 根据别名单推
```



### pipeline

```php
$pipeline = $pusher->pipeline;

$device = $pipeline->device;
for($index = 0; $index <= 100; ++$index){
  $device->audience(device)
    		 ->title("title{$index}")
    		 ->body("body{$index}")
    		 ->delay();
}
$device->submit(); // 批量单推给设备

$alias = $pipeline->alias;
for($index = 0; $index <= 100; ++$index){
  $alias->audience(alias)
    		 ->title("title{$index}")
    		 ->body("body{$index}")
    		 ->delay();
}
$alias->submit(); // 批量单推给别名
```



## 更新日志

Please see the [changelog](changelog.md) for more information on what has changed recently.

[ico-version]: https://img.shields.io/packagist/v/haixin/getui.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/haixin/getui.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/haixin/getui/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/haixin/getui
[link-downloads]: https://packagist.org/packages/haixin/getui
[link-travis]: https://travis-ci.org/haixin/getui
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/haixin
[link-contributors]: ../../contributors
