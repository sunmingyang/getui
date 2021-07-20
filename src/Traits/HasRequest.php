<?php

namespace HaiXin\GeTui\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Utils;
use Psr\Http\Message\ResponseInterface;

trait HasRequest
{
    /**
     * @var array
     */
    protected static array $defaults = [
        'curl' => [
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
        ],
    ];
    /**
     * @var ClientInterface
     */
    protected $httpClient;
    /**
     * @var HandlerStack
     */
    protected $handlerStack;
    
    /**
     * Set guzzle default settings.
     *
     * @param  array  $defaults
     */
    public static function setDefaultOptions(array $defaults = []): void
    {
        self::$defaults = $defaults;
    }
    
    /**
     * Return current guzzle default settings.
     *
     * @return array
     */
    public static function getDefaultOptions(): array
    {
        return self::$defaults;
    }
    
    /**
     * Make a request.
     *
     * @param  string  $url
     * @param  string  $method
     * @param  array   $options
     *
     * @return ResponseInterface
     *
     * @throws GuzzleException
     */
    public function request(string $url, string $method = 'GET', array $options = []): ResponseInterface
    {
        $method = strtoupper($method);
        
        $options = array_merge(
            self::$defaults,
            $options,
            [RequestOptions::HEADERS => ['token' => $this->app->getToken()->get()],],
            ['handler' => $this->getHandlerStack()]
        );
        
        $options = $this->fixJsonIssue($options);
        
        $response = $this->getHttpClient()->request($method, $this->app->url($url), $options);
        
        $response->getBody()->rewind();
        
        return $response;
    }
    
    /**
     * Build a handler stack.
     *
     * @return HandlerStack
     */
    public function getHandlerStack(): HandlerStack
    {
        if ($this->handlerStack) {
            return $this->handlerStack;
        }
        
        $this->handlerStack = HandlerStack::create($this->getGuzzleHandler());
        
        return $this->handlerStack;
    }
    
    /**
     * @param  HandlerStack  $handlerStack
     *
     * @return $this
     */
    public function setHandlerStack(HandlerStack $handlerStack): self
    {
        $this->handlerStack = $handlerStack;
        
        return $this;
    }
    
    /**
     * Get guzzle handler.
     *
     * @return callable
     */
    protected function getGuzzleHandler(): callable
    {
        return Utils::chooseHandler();
    }
    
    /**
     * @param  array  $options
     *
     * @return array
     */
    protected function fixJsonIssue(array $options): array
    {
        if (isset($options['json']) && is_array($options['json'])) {
            $options['headers'] = array_merge($options['headers'] ?? [], ['Content-Type' => 'application/json']);
            
            if (empty($options['json'])) {
                $options['body'] = Utils::jsonEncode($options['json'], JSON_FORCE_OBJECT);
            } else {
                $options['body'] = Utils::jsonEncode($options['json'], JSON_UNESCAPED_UNICODE);
            }
            
            unset($options['json']);
        }
        
        return $options;
    }
    
    /**
     * Return GuzzleHttp\ClientInterface instance.
     *
     * @return ClientInterface
     */
    public function getHttpClient(): ClientInterface
    {
        if (!($this->httpClient instanceof ClientInterface)) {
            $this->httpClient = new Client(['handler' => HandlerStack::create($this->getGuzzleHandler())]);
        }
        
        return $this->httpClient;
    }
    
    /**
     * Set GuzzleHttp\Client.
     *
     * @param  ClientInterface  $httpClient
     *
     * @return $this
     */
    public function setHttpClient(ClientInterface $httpClient): self
    {
        $this->httpClient = $httpClient;
        
        return $this;
    }
}
