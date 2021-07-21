<?php

namespace HaiXin\GeTui;

use DateTime;
use Exception;
use HaiXin\GeTui\Traits\Payload;
use Illuminate\Config\Repository as Config;
use Illuminate\Support\Str;

/**
 * Class GeTui
 *
 * @property Alias     $alias     别名相关
 * @property Tags      $tags      标签相关
 * @property User      $user      用户相关
 * @property Report    $report    统计相关
 * @property Broadcast $broadcast 针对指定应用推送
 * @property Task      $task      任务
 * @property Group     $group     针对list推送
 * @property Single    $single    针对单个用户推送
 * @property Pipeline  $pipeline  针对多个用户推送
 * @package HaiXin\GeTui
 */
class GeTui
{
    use Payload {
        Payload::__get as getPayload;
    }
    
    /** @var Token */
    protected $token;
    protected $cache;
    /** @var string */
    protected $basicUri;
    /** @var string */
    protected $timestamp;
    /** @var Config */
    protected $config;
    /** @var array|string[] */
    protected array $provider = [
        'alias'     => Alias::class,
        'tags'      => Tags::class,
        'user'      => User::class,
        'report'    => Report::class,
        'broadcast' => Broadcast::class,
        'task'      => Task::class,
        'group'     => Group::class,
        'single'    => Single::class,
        'pipeline'  => Pipeline::class,
    ];
    
    public function __construct(array $config)
    {
        $this->init($config);
    }
    
    /**
     * 初始化
     *
     * @param  array  $config
     */
    protected function init(array $config): void
    {
        $this->timestamp();
        $this->setConfig($config);
    }
    
    /**
     * 获取时间戳
     *
     * @return float|int
     */
    public function timestamp()
    {
        $this->timestamp = time() * 1000;
        return $this->timestamp;
    }
    
    /**
     * 获取 config 对象
     *
     * @param  null  $key
     *
     * @return array|mixed
     */
    public function getConfig($key = null)
    {
        if ($key !== null) {
            return $this->config->get($key);
        }
        
        return $this->config;
    }
    
    /**
     * 设置 config
     *
     * @param $config
     *
     * @return $this
     */
    public function setConfig($config): GeTui
    {
        if (is_array($config)) {
            $config = new Config($config);
        }
        $this->config = $config;
        
        $this->initBasicUri();
        
        return $this;
    }
    
    /**
     * 获取时间戳
     *
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }
    
    /**
     * 获取完整地址
     *
     * @param $path
     *
     * @return string
     */
    public function url($path): string
    {
        return $this->getBasicUrl().Str::start($path, '/');
    }
    
    /**
     * 获取基础地址
     *
     * @return string
     */
    public function getBasicUrl(): string
    {
        if ($this->basicUri === null) {
            $this->initBasicUri();
        }
        return $this->basicUri;
    }
    
    /**
     * 初始化基础请求地址
     */
    protected function initBasicUri(): void
    {
        $this->basicUri = "https://restapi.getui.com/v2/{$this->config['id']}";
    }
    
    /**
     * 时间处理
     *
     * @param        $date
     * @param  null  $format
     *
     * @return string
     * @throws Exception
     */
    public function toDate($date, $format = null): string
    {
        $date = new DateTime(is_numeric($date) ? date('Y-m-d H:i:s', $date) : $date);
        
        return $date->format($format ?? 'Y-m-d');
    }
    
    /**
     * 获取缓存实例
     *
     * @return
     */
    public function getCache()
    {
        if ($this->cache === null) {
            $this->cache = resolve('cache');
        }
        return $this->cache;
    }
    
    /**
     * 设置缓存实例
     *
     * @param    $cache
     *
     * @return $this
     */
    public function setCache($cache): GeTui
    {
        $this->cache = $cache;
        
        return $this;
    }
    
    /**
     * 获取 token 实例
     *
     * @return Token
     */
    public function getToken(): Token
    {
        if ($this->token === null) {
            $this->initToken();
        }
        return $this->token;
    }
    
    /**
     * 初始化token
     */
    protected function initToken(): void
    {
        $this->token = new Token($this);
    }
    
    public function __get($name)
    {
        $name = strtolower($name);
        
        if (isset($this->provider[$name]) === true) {
            return new $this->provider[$name]($this);
        }
        
        return $this->getPayload($name);
    }
}
