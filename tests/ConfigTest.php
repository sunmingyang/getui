<?php

namespace Tests\GeTui;

use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

/**
 * Class ConfigTest
 * @group config
 * @package Tests\GeTui
 */
class ConfigTest extends TestCase
{
    use CreatesApplication;
    
    public function testConfig()
    {
        $config = resolve('getui')->getConfig()->all();
        $this->assertIsArray($config);
        
        return $config;
    }
    
    /**
     * @depends testConfig
     */
    public function testSetConfig(array $config1)
    {
        $config = [
            'id'     => 'ididididididididididid',
            'key'    => 'keykeykeykeykeykeykey',
            'secret' => 'secretsecretsecretsecret',
            'master' => 'mastermastermastermaster',
        ];
        
        $pusher = resolve('getui')->setConfig($config);
        
        $this->assertNotEquals($config1, $pusher->getConfig()->all());
    }
}
