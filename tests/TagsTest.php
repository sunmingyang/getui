<?php

namespace Tests\GeTui;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

/**
 * Class TagsTest
 * @group tags
 * @package Tests\GeTui
 */
class TagsTest extends TestCase
{
    use CreatesApplication;
    use GeTuiTrait;
    
    public function testSingle()
    {
        try {
            $this->assertTrue($this->getTags()->single($this->cid, ['标签1', '标签2', '标签3']));
        } catch (GuzzleException $e) {
            if ($e->getCode() === 403) {
                $this->assertTrue(true);
            }
        }
    }
    
    public function getTags()
    {
        return resolve('getui')->tags;
    }
    
    public function testMore()
    {
        $result = $this->getTags()->more('标签1', [$this->cid]);
        $this->assertTrue(isset($result[$this->cid]));
    }
    
    public function testUnbind()
    {
        $result = $this->getTags()->unbind('标签1', [$this->cid]);
        $this->assertTrue(isset($result[$this->cid]));
    }
    
}
