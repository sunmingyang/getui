<?php

namespace Tests\GeTui;

use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

/**
 * Class PipelineTest
 *
 * @group   pipeline
 * @package Tests\GeTui
 */
class PipelineTest extends TestCase
{
    use CreatesApplication;
    use GeTuiTrait;
    
    public function testAlias()
    {
        resolve('getui')->alias->bind([$this->cid => $this->cid]);
        $alias = $this->getPipeline()->alias;
        for ($index = 0; $index < 10; ++$index) {
            $alias->title($this->getTitle())
                  ->body($this->getBody())
                  ->audience($this->cid)
                  ->delay();
        }
        $this->assertIsArray($alias->submit());
    }
    
    public function getPipeline()
    {
        return resolve('getui')->pipeline;
    }
    
    public function testDevice()
    {
        $device = $this->getPipeline()->device;
        for ($index = 0; $index < 10; ++$index) {
            $device->title($this->getTitle())
                   ->body($this->getBody())
                   ->audience($this->cid)
                   ->delay();
        }
        
        $this->assertIsArray($device->submit());
    }
}
