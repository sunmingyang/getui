<?php

namespace Tests\GeTui;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Testing\TestResponse;
use Tests\CreatesApplication;

/**
 * Class TokenTest
 * @group token
 * @package Tests\GeTui
 */
class TokenTest extends TestCase
{
    use CreatesApplication;
    
    /**
     *
     * @return TestResponse
     */
    public function testGetToken()
    {
        $token = $this->getToken()->get();
        $this->assertNotEmpty($token);
        
        return $token;
    }
    
    protected function getToken()
    {
        return resolve('getui')->getToken();
    }
    
    /**
     * @depends testGetToken
     */
    public function testRefreshToken(string $token1)
    {
        $token2 = $this->getToken()->refresh(true);
        
        $this->assertNotEquals($token1, $token2);
    }
    
    public function testGetKey()
    {
        $key = $this->getToken()->key();
        $this->assertNotEmpty($this->getToken()->key());
        
        return $key;
    }
    
    /**
     * @depends testGetKey
     */
    public function testSetKey($key1)
    {
        $this->getToken()->key('key2');
        
        $this->assertNotEquals($key1, $this->getToken()->key());
    }
}
