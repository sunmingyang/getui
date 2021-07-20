<?php


namespace HaiXin\GeTui\Helper;

use GuzzleHttp\Utils;
use HaiXin\GeTui\Interfaces\NotPushInterface;

class Message implements NotPushInterface
{
    protected $app;
    protected $level;
    protected $transmission;
    protected $revoke;
    protected $task;
    protected $force;
    
    protected $options;
    
    /**
     * Audience constructor.
     *
     * @param $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }
    
    /**
     * 纯透传消息内容，安卓和iOS均支持，与notification、revoke 三选一，都填写时报错，长度 ≤ 3072
     *
     * @param $transmission
     *
     * @return $this
     */
    public function transmission($transmission): Message
    {
        if (is_array($transmission) === true) {
            $transmission = Utils::jsonEncode($transmission, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
        
        $this->transmission = $transmission;
        
        return $this;
    }
    
    /**
     * 撤回消息时使用(仅支持撤回个推通道消息)，与notification、transmission三选一，都填写时报错(消息撤回请勿填写策略参数)
     *
     * @param         $task
     * @param  false  $force
     *
     * @return $this
     */
    public function revoke($task, bool $force = false): Message
    {
        $this->revoke = Utils::jsonEncode(['old_task_id' => $task, 'force' => $force]);
        
        return $this;
    }
    
    /**
     * 在没有找到对应的taskId，是否把对应appId下所有的通知都撤回
     *
     * @param $force
     *
     * @return $this
     */
    public function force($force): Message
    {
        $this->force = $force;
        
        return $this;
    }
    
    /**
     * 通知消息标题，长度 ≤ 50
     *
     * @param $title
     *
     * @return $this
     */
    public function title($title): self
    {
        $this->options['title'] = $title;
        
        return $this;
    }
    
    /**
     * 通知消息内容，长度 ≤ 256
     *
     * @param $body
     *
     * @return $this
     */
    public function body($body): self
    {
        $this->options['body'] = $body;
        
        return $this;
    }
    
    /**
     * 长文本消息内容，通知消息+长文本样式，与big_image二选一，两个都填写时报错，长度 ≤ 512
     *
     * @param $text
     *
     * @return $this
     */
    public function text($text): self
    {
        $this->options['big_text'] = $text;
        
        return $this;
    }
    
    /**
     * 大图的URL地址，通知消息+大图样式， 与big_text二选一，两个都填写时报错，长度 ≤ 1024
     *
     * @param $image
     *
     * @return $this
     */
    public function image($image): self
    {
        $this->options['image'] = $image;
        
        return $this;
    }
    
    /**
     * 通知的图标名称，包含后缀名（需要在客户端开发时嵌入），如“push.png”，长度 ≤ 64
     *
     * @param $logo
     *
     * @return $this
     */
    public function logo($logo): self
    {
        $this->options['logo'] = $logo;
        
        return $this;
    }
    
    /**
     * 通知图标URL地址，长度 ≤ 256
     *
     * @param $url
     *
     * @return $this
     */
    public function logoUrl($url): self
    {
        $this->options['logo_url'] = $url;
        
        return $this;
    }
    
    /**
     * 通知渠道id，长度 ≤ 64
     *
     * @param $id
     *
     * @return $this
     */
    public function id($id): self
    {
        $this->options['channel_id'] = $id;
        
        return $this;
    }
    
    /**
     * 通知渠道名称，长度 ≤ 64
     *
     * @param $name
     *
     * @return $this
     */
    public function name($name): self
    {
        $this->options['channel_name'] = $name;
        
        return $this;
    }
    
    /**
     * 设置通知渠道重要性（可以控制响铃，震动，浮动，闪灯等等）
     * android8.0以下
     * 0，1，2:无声音，无振动，不浮动
     * 3:有声音，无振动，不浮动
     * 4:有声音，有振动，有浮动
     * android8.0以上
     * 0：无声音，无振动，不显示；
     * 1：无声音，无振动，锁屏不显示，通知栏中被折叠显示，导航栏无logo;
     * 2：无声音，无振动，锁屏和通知栏中都显示，通知不唤醒屏幕;
     * 3：有声音，无振动，锁屏和通知栏中都显示，通知唤醒屏幕;
     * 4：有声音，有振动，亮屏下通知悬浮展示，锁屏通知以默认形式展示且唤醒屏幕;
     *
     * @param $level
     *
     * @return $this
     */
    public function level($level): self
    {
        $this->options['channel_level'] = $level;
        
        return $this;
    }
    
    /**
     * 覆盖任务时会使用到该字段，两条消息的notify_id相同，新的消息会覆盖老的消息，范围：0-2147483647
     *
     * @param $notify
     *
     * @return $this
     */
    public function notify($notify): self
    {
        $this->options['notify_id'] = $notify;
        
        return $this;
    }
    
    /**
     * 自定义铃声，请填写文件名，不包含后缀名(需要在客户端开发时嵌入)，个推通道下发有效
     * 客户端SDK最低要求 2.14.0.0
     *
     * @param $ring
     *
     * @return $this
     */
    public function ring($ring): self
    {
        $this->options['ring_name'] = $ring;
        
        return $this;
    }
    
    /**
     * 角标, 必须大于0, 个推通道下发有效
     * 此属性目前仅针对华为 EMUI 4.1 及以上设备有效
     * 角标数字数据会和之前角标数字进行叠加；
     * 举例：角标数字配置1，应用之前角标数为2，发送此角标消息后，应用角标数显示为3。
     * 客户端SDK最低要求 2.14.0.0
     *
     * @param $badge
     *
     * @return $this
     */
    public function badge($badge): self
    {
        $this->options['badge_add_num'] = $badge;
        
        return $this;
    }
    
    public function get(): array
    {
        switch (true) {
            case $this->transmission !== null:
                $data['transmission'] = $this->transmission;
                
                break;
            case $this->revoke !== null:
                $data['revoke'] = $this->revoke;
                break;
            default:
                if (isset($this->options['click_type']) === false) {
                    $this->options['click_type'] = 'startapp';
                }
                
                $data['notification'] = $this->options;
        }
        
        return ['push_message' => $data];
    }
    
    /**
     * 扩展消息
     *
     * @param $click
     * @param $params
     *
     * @return $this
     */
    public function extras($params, $click = null): self
    {
        if ($click === null) {
            $click = 'intent';
        }
        
        if (is_array($params) === true) {
            $params = Utils::jsonEncode($params, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
        
        if ($click === 'intent') {
            $params = sprintf($this->app->getConfig('intent'), $params);
        }
        
        $this->options['click_type'] = $click;
        $this->options[$click]       = $params;
        
        return $this;
    }
}
