<?php

namespace Tests\GeTui;

use HaiXin\GeTui\Helper\Audience;
use HaiXin\GeTui\Helper\Channel;
use HaiXin\GeTui\Helper\Message;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

/**
 * Class ComplexTest
 *
 * @group   complex
 * @package Tests\GeTui
 */
class ComplexTest extends TestCase
{
    use CreatesApplication;
    use GeTuiTrait;
    
//    public function testParams()
//    {
//        $pusher = resolve('getui');
//        /** @var Message $message */
//        $message = $pusher->message();
//        $message->title($this->getTitle())->body($this->getBody());
//        /** @var Channel $channel */
//        $channel = $pusher->channel();
//        $channel->title($this->getTitle())->body($this->getBody());
//        /** @var Audience $audience */
//        $audience = $pusher->audience();
//        $audience->device($this->cid);
//
//        $result = $pusher->single->device->message($message)->channel($channel)->audience($audience)->submit();
//
//        $this->assertNotEmpty($result);
//    }
    
    public function testCallable()
    {
        $result = resolve('getui')->single->device->message(function (Message $message) {
            $message->title($this->getTitle());
            $message->body($this->getBody());
        })
                                                  ->channel(function (Channel $channel) {
                                                      $channel->title($this->getTitle());
                                                      $channel->body($this->getBody());
                                                  })
                                                  ->audience(function (Audience $audience) {
                                                      $audience->device($this->cid);
                                                  })
                                                  ->submit();
        
        $this->assertNotEmpty($result);
    }
}
