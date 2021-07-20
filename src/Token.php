<?php


namespace HaiXin\GeTui;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use HaiXin\GeTui\Traits\HasResponse;
use HaiXin\GeTui\Traits\Signature;
use Illuminate\Contracts\Cache\Repository;
use Psr\SimpleCache\InvalidArgumentException;

class Token
{
    use Signature;
    use HasResponse;
    
    protected GeTui   $app;
    protected string  $key = 'GT:token';
    protected ?string $token;
    protected         $cache;
    
    public function __construct(GeTui $app)
    {
        $this->app   = $app;
        $this->cache = $app->getCache();
        $this->refresh();
    }
    
    /**
     * 刷新 Token
     *
     * @param  false  $force
     *
     * @return Repository|mixed|string|null
     * @throws InvalidArgumentException
     */
    public function refresh(bool $force = false)
    {
        if ($force === false) {
            $this->token = $this->cache->get($this->key);
        }
        
        if (empty($this->token)) {
            $response = $this->getClient()->post($this->app->url('auth'), [
                RequestOptions::JSON => [
                    'sign'      => $this->signature(),
                    'timestamp' => $this->timestamp(),
                    'appkey'    => $this->app->getConfig('key'),
                ],
            ]);
            
            $this->token = $this->toArray($response, 'data.token');
            $this->cache->set($this->key, $this->token, 86400);
        }
        
        return $this->token;
    }
    
    protected function getClient()
    {
        return new Client();
    }
    
    /**
     * 销毁 Token
     */
    public function destroy(): self
    {
        $this->getClient()->delete($this->app->url("auth/{$this->get()}"));
        
        $this->token = null;
        
        return $this;
    }
    
    /**
     * 获取 Token
     *
     * @return string|null
     */
    public function get(): ?string
    {
        if ($this->token === null) {
            $this->refresh();
        }
        
        return $this->token;
    }
    
    /**
     * Token 的缓存 Key
     *
     * @return string
     */
    public function key($key = null): string
    {
        if ($key !== null) {
            $this->key = $key;
        }
        
        return $this->key;
    }
}
