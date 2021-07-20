<?php

namespace Tests\GeTui;

use GuzzleHttp\Exception\RequestException;
use HaiXin\GeTui\Helper\Filter;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

/**
 * Class BroadcastTest
 *
 * @group   broadcast
 * @package Tests\GeTui
 */
class BroadcastTest extends TestCase
{
    use CreatesApplication;
    use GeTuiTrait;
    
    public function testAll()
    {
        $filter = new Filter();
        $filter->whereOr('phone', ['ios', 'android']);
        $result = $this->getBroadcast()->all->title($this->getTitle())->body($this->getBody())->submit();
        
        self::assertNotEmpty($result);
    }
    
    public function getBroadcast()
    {
        return resolve('getui')->broadcast;
    }
    
    public function testTags()
    {
        try {
            $result = $this->getBroadcast()->tags->title($this->getTitle())->body($this->getBody())
                                                 ->audience('标签1', 'tags')->submit();
            
            self::assertNotEmpty($result);
        } catch (RequestException$e) {
            if ($e->getCode() === 403) {
                $this->assertTrue(true, '超过推送限制');
            }
        }
    }
    
    public function testFilter()
    {
        $filter = new Filter();
        $filter->whereOr('phone', ['ios', 'android']);
        $result = $this->getBroadcast()->filter->title($this->getTitle())->body($this->getBody())->audience($filter)
                                               ->submit();
        
        self::assertNotEmpty($result);
    }
    
}
