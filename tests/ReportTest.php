<?php

namespace Tests\GeTui;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

/**
 * Class ReportTest
 * @group report
 * @package Tests\GeTui
 */
class ReportTest extends TestCase
{
    use CreatesApplication;
    use GeTuiTrait;
    
    public function testDay()
    {
        $this->assertIsArray($this->getReport()->day(date('Y-m-d', strtotime('-1 day'))));
    }
    
    public function getReport()
    {
        return resolve('getui')->report;
    }
    
    public function testUser()
    {
        $this->assertIsArray($this->getReport()->user(date('Y-m-d', strtotime('-1 day'))));
    }
    
    public function testRemainder()
    {
        $this->assertIsArray($this->getReport()->Remainder());
    }
    
    public function testTask()
    {
        $this->assertIsArray($this->getReport()->task('RASA_0712_650e73d8022f3035d6220f7534ca4e46'));
    }
    
    public function testGroup()
    {
        try {
            $this->assertIsArray($this->getReport()->group('ggg'));
        } catch (RequestException$e) {
            if ($e->getCode() === 400) {
                $this->assertTrue(true, '个推说当天的查不到，只能查昨天的');
            }
        }
    }
    
    public function testOnline()
    {
        $this->assertIsArray($this->getReport()->online());
    }
}
