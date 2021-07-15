<?php

namespace HaiXin\GeTui;

use DateTime;
use Illuminate\Config\Repository as Config;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

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
    protected static array $provider = [
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
    public Config          $config;
    public Token           $token;
    public string          $basicUri;
    public string          $timestamp;
    
    public function __construct(array $config, $cache = null)
    {
        $this->init($config, $cache);
    }
    
    protected function init(array $config,  $cache): void
    {
        $this->timestamp();
        $this->initConfig($config);
        $this->initBasicUri();
        $this->initToken($cache);
    }
    
    public function timestamp()
    {
        return $this->timestamp = time() * 1000;
    }
    
    protected function initConfig($config): void
    {
        $this->config = new Config($config);
    }
    
    protected function initBasicUri(): void
    {
        $this->basicUri = "https://restapi.getui.com/v2/{$this->config['id']}";
    }
    
    protected function initToken( $cache): void
    {
        $this->token = new Token($this, $cache);
    }
    
    public function url($path): string
    {
        return $this->basicUri.Str::start($path, '/');
    }
    
    public function __get($name)
    {
        $name = strtolower($name);
        
        if (isset(self::$provider[$name]) === true) {
            return new self::$provider[$name]($this);
        }
        
        throw new RuntimeException("{$name}不存在");
    }
    
    public function isSuccess($response): bool
    {
        if ($response instanceof ResponseInterface) {
            $response = $this->toArray($response);
        }
        
        return $response['code'] === 0;
    }
    
    public function toArray($response, $key = null)
    {
        if ($key !== null) {
            $key = Str::start($key, 'data.');
        }
        
        $data = json_decode($response->getBody()->getContents(), true);
        
        if (isset($data['data']) === true) {
            return Arr::get($data, $key ?? 'data');
        }
        
        return $data;
    }
    
    public function toDate($date, $format = null): string
    {
        $date = new DateTime(is_numeric($date) ? date('Y-m-d H:i:s', $date) : $date);
        
        return $date->format($format ?? 'Y-m-d');
    }
}
