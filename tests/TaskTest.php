<?php

namespace Tests\GeTui;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

/**
 * Class TaskTest
 *
 * @group   task
 * @package Tests\GeTui
 */
class TaskTest extends TestCase
{
    use CreatesApplication;
    use GeTuiTrait;
    
    public function testProgress()
    {
        try {
            $this->assertIsArray($this->getTask()->progress($this->cid, $this->getTaskId()));
        } catch (RequestException $e) {
            if ($e->getCode() === 401) {
                $this->assertTrue(true, '没权限');
            }
        }
    }
    
    public function getTask()
    {
        return resolve('getui')->task;
    }
    
    protected function getTaskId()
    {
        $result = resolve('getui')->single->device->title($this->getTitle())
                                                  ->body($this->getBody())
                                                  ->audience($this->cid, 'device')
                                                  ->group(__FUNCTION__)
                                                  ->submit();
        
        return key($result);
    }
    
    public function testState()
    {
        try {
            $this->assertIsArray($this->getTask()->state($this->getTaskId()));
        } catch (RequestException $e) {
            if ($e->getCode() === 400) {
                $this->assertTrue(true, '定时任务推送完成之后');
            }
        }
    }
    
    public function testStop()
    {
        try {
            $this->assertIsArray($this->getTask()->stop($this->getTaskId()));
        } catch (RequestException $e) {
            if ($e->getCode() === 400) {
                $this->assertTrue(true, '只支持批量推和群推任务');
            }
        }
    }
    
    public function testDestroy()
    {
        try {
            $this->assertIsArray($this->getTask()->destroy($this->getTaskId()));
        } catch (RequestException $e) {
            if ($e->getCode() === 400) {
                $this->assertTrue(true, '仅限未下发的定时任务');
            }
        }
    }
    
}
