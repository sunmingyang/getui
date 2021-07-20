<?php

namespace Tests\GeTui;

use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

/**
 * Class GroupTest
 *
 * @group   group
 * @package Tests\GeTui
 */
class GroupTest extends TestCase
{
    use CreatesApplication;
    use GeTuiTrait;
    
    public function testCreate()
    {
        $result = $this->getGroup()->create->title($this->getTitle())->body($this->getBody())->submit();
        
        $this->assertNotEmpty($result);
        
        return $result;
    }
    
    public function getGroup()
    {
        return resolve('getui')->group;
    }
    
    /**
     * @depends testCreate
     */
    public function testAlias($task)
    {
        $result = $this->getGroup()->alias->audience([$this->cid])->task($task)->submit();
        
        $this->assertTrue(isset($result[$this->cid]));
    }
    
    /**
     * @depends testCreate
     */
    public function testDevice($task)
    {
        $result = $this->getGroup()->device->audience([$this->cid])->task($task)->submit();
        
        $this->assertTrue(isset($result[$this->cid]));
    }
}
