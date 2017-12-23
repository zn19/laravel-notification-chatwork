<?php

namespace Revolution\NotificationChannels\Chatwork\Test;

use PHPUnit\Framework\TestCase;
use Revolution\NotificationChannels\Chatwork\ChatworkInformation;

class ChatworkInformationTest extends TestCase
{
    /** @test */
    public function it_can_accept_a_content_when_constructing_a_message()
    {
        $message = new ChatworkInformation('title', 'hello');
        $this->assertEquals('title', $message->informationTitle);
        $this->assertEquals('hello', $message->informationMessage);
    }

    /** @test */
    public function it_can_accept_a_content_when_creating_a_message()
    {
        $message = ChatworkInformation::create('title', 'hello');
        $this->assertEquals('title', $message->informationTitle);
        $this->assertEquals('hello', $message->informationMessage);
    }

    /** @test */
    public function it_can_set_the_information_title()
    {
        $message = (new ChatworkInformation())->informationTitle('hello');
        $this->assertEquals('hello', $message->informationTitle);
    }

    /** @test */
    public function it_can_set_the_information_message()
    {
        $message = (new ChatworkInformation())->informationMessage('room');
        $this->assertEquals('room', $message->informationMessage);
    }

    /** @test */
    public function it_can_set_the_to()
    {
        $message = (new ChatworkInformation())->roomId('99999');
        $this->assertEquals('99999', $message->roomId);
    }
}
