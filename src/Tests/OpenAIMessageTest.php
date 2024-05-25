<?php

namespace Jonaspoelmans\LaravelGpt\Tests;

use InvalidArgumentException;
use Jonaspoelmans\LaravelGpt\Models\OpenAIMessage;
use PHPUnit\Framework\TestCase;

class OpenAIMessageTest extends TestCase
{
    public function testConstructorValidRole() {
        $message = new OpenAIMessage('user', 'Hello');
        $this->assertInstanceOf(OpenAIMessage::class, $message);
        $this->assertEquals('user', $message->getRole());
        $this->assertEquals('Hello', $message->getContent());
    }

    public function testConstructorInvalidRole() {
        $this->expectException(InvalidArgumentException::class);
        new OpenAIMessage('invalid_role', 'Hello');
    }

    public function testConvertToArray() {
        $message = new OpenAIMessage('assistant', 'How can I help you?');
        $array = $message->convertToArray();
        $this->assertIsArray($array);
        $this->assertEquals('assistant', $array['role']);
        $this->assertEquals('How can I help you?', $array['content']);
    }

    public function testSetValidRole() {
        $message = new OpenAIMessage('user', 'Hello');
        $message->setRole('system');
        $this->assertEquals('system', $message->getRole());
    }

    public function testSetInvalidRole() {
        $message = new OpenAIMessage('user', 'Hello');
        $this->expectException(InvalidArgumentException::class);
        $message->setRole('invalid_role');
    }

    public function testSetContent() {
        $message = new OpenAIMessage('user', 'Hello');
        $message->setContent('Hi there');
        $this->assertEquals('Hi there', $message->getContent());
    }

    public function testGetRole() {
        $message = new OpenAIMessage('user', 'Hello');
        $this->assertEquals('user', $message->getRole());
    }

    public function testGetContent() {
        $message = new OpenAIMessage('user', 'Hello');
        $this->assertEquals('Hello', $message->getContent());
    }
}
