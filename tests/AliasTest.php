<?php

namespace Tests\GeTui;

use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

/**
 * Class AliasTest
 * @group alias
 * @package Tests\GeTui
 */
class AliasTest extends TestCase
{
    use CreatesApplication;
    use GeTuiTrait;
    
    public function testBind()
    {
        $this->assertTrue($this->getAlias()
                               ->bind([$this->cid => $this->cid]));
    }
    
    public function getAlias()
    {
        return resolve('getui')->alias;
    }
    
    public function testDevice()
    {
        $this->assertNotEmpty($this->getAlias()->device($this->cid));
    }
    
    public function unbind()
    {
        $this->assertTrue($this->getAlias()
                               ->unbind([$this->cid => $this->cid]));
    }
    
    public function destroy()
    {
        $this->assertTrue($this->getAlias()
                               ->destroy($this->cid));
    }
}
