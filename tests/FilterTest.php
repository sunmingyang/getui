<?php

namespace Tests\GeTui;

use HaiXin\GeTui\Helper\Filter;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

/**
 * Class FilterTest
 * @group filter
 * @package Tests\GeTui
 */
class FilterTest extends TestCase
{
    use CreatesApplication;
    
    public function testPhone()
    {
        $result1 = $this->getFilter()->where('phone', 'phone');
        $this->assertTrue($result1->toArray()['0']['key'] === 'phone_type');
        $result2 = $this->getFilter()->wherePhone('phone');
        $this->assertTrue($result2->toArray()['0']['key'] === 'phone_type');
    }
    
    protected function getFilter()
    {
        return new Filter();
    }
    
    public function testRegion()
    {
        $result1 = $this->getFilter()->where('region', 'region');
        $this->assertTrue($result1->toArray()['0']['key'] === 'region');
        $result2 = $this->getFilter()->whereRegion('region');
        $this->assertTrue($result2->toArray()['0']['key'] === 'region');
    }
    
    public function testPortrait()
    {
        $result1 = $this->getFilter()->where('portrait', 'portrait');
        $this->assertTrue($result1->toArray()['0']['key'] === 'portrait');
        $result2 = $this->getFilter()->wherePortrait('portrait');
        $this->assertTrue($result2->toArray()['0']['key'] === 'portrait');
    }
    
    public function testTag()
    {
        $result1 = $this->getFilter()->where('tag', 'tag');
        $this->assertTrue($result1->toArray()['0']['key'] === 'custom_tag');
        $result2 = $this->getFilter()->whereTag('tag');
        $this->assertTrue($result2->toArray()['0']['key'] === 'custom_tag');
    }
    
    public function testAnd()
    {
        $result1 = $this->getFilter()->where('tag', 'tag');
        
        $this->assertTrue($result1->toArray()['0']['opt_type'] === 'and');
    }
    
    public function testOr()
    {
        $result1 = $this->getFilter()->whereOr('tag', 'tag');
        
        $this->assertTrue($result1->toArray()['0']['opt_type'] === 'or');
    }
    
    public function testNot()
    {
        $result1 = $this->getFilter()->whereNot('tag', 'tag');
        
        $this->assertTrue($result1->toArray()['0']['opt_type'] === 'not');
    }
}
