<?php

namespace Tests\GeTui;

use HaiXin\GeTui\Helper\Filter;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

/**
 * Class UserTest
 *
 * @group   user
 * @package Tests\GeTui
 */
class UserTest extends TestCase
{
    use CreatesApplication;
    use GeTuiTrait;
    
    public function testCount()
    {
        $filter = new Filter();
//
        $filter->whereOr('region', ['11000000', '12000000', '31000000']);
        
        $this->assertIsNumeric($this->getUser()->count($filter));
    }
    
    public function getUser()
    {
        return resolve('getui')->user;
    }
    
    public function testDetail()
    {
        $result = $this->getUser()->detail($this->cid);
        $this->assertTrue(isset($result[$this->cid]));
    }
    
    public function testState()
    {
        $result = $this->getUser()->state($this->cid);
        $this->assertTrue(isset($result[$this->cid]));
    }
    
    public function testBlack()
    {
        $this->assertTrue($this->getUser()->black($this->cid));
    }
    
    public function testUnblack()
    {
        $this->assertTrue($this->getUser()->unblack($this->cid));
    }
    
    public function testTags()
    {
        $this->assertIsArray($this->getUser()->tags($this->cid));
    }
    
    public function testBadge()
    {
        $this->assertTrue($this->getUser()->badge(100, [
            $this->cid, $this->cid, $this->cid,
        ]));
    }
}
