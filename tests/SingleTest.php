<?php

namespace Tests\GeTui;

use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

/**
 * Class SingleTest
 *
 * @group   single
 * @package Tests\GeTui
 */
class SingleTest extends TestCase
{
    use CreatesApplication;
    use GeTuiTrait;
    
    public function testAlias()
    {
        $result = $this->getSingle()->alias->title($this->getTitle())->body($this->getBody())->audience($this->cid)
                                           ->submit();
        
        $this->assertTrue(isset(reset($result)[$this->cid]));
    }
    
    public function getSingle()
    {
        return resolve('getui')->single;
    }
    
    public function testDevice()
    {
        $result = $this->getSingle()->device->title($this->getTitle())->body($this->getBody())->audience($this->cid)
                                            ->submit();
        $this->assertTrue(isset(reset($result)[$this->cid]));
    }
    
}
