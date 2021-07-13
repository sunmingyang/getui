<?php


namespace HaiXin\GeTui;

use HaiXin\GeTui\Traits\Signature;
use Illuminate\Support\Facades\Http;

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
            $response = Http::asJson()
                            ->post($this->app->url('auth'), [
                                'sign'      => $this->signature(),
                                'timestamp' => $this->timestamp(),
                                'appkey'    => $this->app->config->get('key'),
                            ])
                            ->json();
            
            if ($this->app->isSuccess($response)) {
                $this->token = $response['data']['token'];
                $this->cache->set($this->key, $this->token, 86400);
            }
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
