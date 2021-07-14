<?php


namespace HaiXin\GeTui;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use HaiXin\GeTui\Traits\Signature;

class Token
{
    use Signature;
    
    protected GeTui   $app;
    protected string  $key = 'GT:token';
    protected ?string $token;
    protected         $cache;
    
    public function __construct(GeTui $app)
    {
        $this->app   = $app;
        $this->cache = resolve('cache');
        $this->refresh();
    }
    
    /**
     * 刷新 Token
     *
     * @param  false  $force
     *
     * @return \Illuminate\Contracts\Cache\Repository|mixed|string|null
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function refresh(bool $force = false)
    {
        $this->destroy();
        
        if ($force === false) {
            $this->token = $this->cache->get($this->key);
        }
        
        if (empty($this->token)) {
            $client = new Client();
            
            $response = $client->post($this->app->url('auth'), [
                RequestOptions::JSON => [
                    'sign'      => $this->signature(),
                    'timestamp' => $this->timestamp(),
                    'appkey'    => $this->app->config->get('key'),
                ],
            ])->getBody()->getContents();
            
            $this->token = $this->app->toArray(json_decode($response, true), 'data.token');
            $this->cache->set($this->key, $this->token, 86400);
        }
        
        return $this->token;
    }
    
    /**
     * 销毁 Token
     */
    public function destroy(): void
    {
        $this->token = null;
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
    public function key(): string
    {
        return $this->key;
    }
}
