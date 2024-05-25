<?php

namespace Jonaspoelmans\LaravelGpt\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Jonaspoelmans\LaravelGpt\Services\LaravelGPTService;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Illuminate\Support\Facades\Log;

class LaravelGPTServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testGenerateOpenAIResponse()
    {
        // Set the environment variable for the API key
        putenv('OPENAI_API_KEY=test_api_key');

        // Create a mock config repository
        $configRepository = $this->createMock(ConfigRepository::class);

        $configRepository->expects($this->atLeastOnce())
            ->method('get')
            ->will($this->returnCallback(function ($key) {
                switch ($key) {
                    case 'laravelgpt.openai_base_uri':
                        return 'https://api.openai.com/v1';
                    case 'laravelgpt.openai_model':
                        return 'gpt-4-1106-preview';
                    case 'laravelgpt.openai_max_tokens':
                        return 4000;
                    case 'laravelgpt.openai_temperature':
                        return 0.7;
                    case 'laravelgpt.openai_logging':
                        return true;
                    default:
                        return null;
                }
            }));

        // Mock the Log facade for error logging
        $logMock = $this->createMock(\Psr\Log\LoggerInterface::class);
        Log::swap($logMock);

        // Create a mock Guzzle client
        $mockClient = $this->createMock(Client::class);
        $mockClient->expects($this->once())
            ->method('request')
            ->with(
                'POST',
                'https://api.openai.com/v1/chat/completions',
                $this->callback(function ($options) {
                    return isset($options['headers']['Authorization']) && $options['headers']['Authorization'] === 'Bearer test_api_key' &&
                        isset($options['headers']['Content-Type']) && $options['headers']['Content-Type'] === 'application/json' &&
                        isset($options['json']['model']) && $options['json']['model'] === 'gpt-4-1106-preview' &&
                        isset($options['json']['messages'][0]['content']) && $options['json']['messages'][0]['content'] === 'Test prompt' &&
                        isset($options['json']['max_tokens']) && $options['json']['max_tokens'] === 4000 &&
                        isset($options['json']['temperature']) && $options['json']['temperature'] === 0.7;
                })
            )
            ->willReturn(new Response(200, [], json_encode(['choices' => [['message' => ['content' => 'Response content']]]])));

        // Inject the mock client into the service using reflection
        $service = new LaravelGPTService($configRepository, $mockClient);
        $reflection = new \ReflectionClass($service);
        $clientProperty = $reflection->getProperty('client');
        $clientProperty->setAccessible(true);
        $clientProperty->setValue($service, $mockClient);

        // Call the generateOpenAIResponse method and check the response
        $response = $service->generateOpenAIResponse('Test prompt');

        // Assert the response content
        $this->assertIsArray($response);
        $this->assertEquals('Response content', $response['choices'][0]['message']['content']);
    }

    public function testGenerateOpenAIResponseHandlesException()
    {
        // Set the environment variable for the API key
        putenv('OPENAI_API_KEY=test_api_key');

        // Create a mock config repository
        $configRepository = $this->createMock(ConfigRepository::class);
        $configRepository->expects($this->atLeastOnce())
            ->method('get')
            ->will($this->returnCallback(function ($key) {
                switch ($key) {
                    case 'laravelgpt.openai_base_uri':
                        return 'https://api.openai.com/v1';
                    case 'laravelgpt.openai_logging':
                        return true;
                    default:
                        return null;
                }
            }));

        // Mock the Log facade for error logging
        $logMock = $this->createMock(\Psr\Log\LoggerInterface::class);
        Log::swap($logMock);

        // Create a mock Guzzle client that throws an exception
        $mockClient = $this->createMock(Client::class);
        $mockClient->method('request')->willThrowException(new \Exception('Test exception'));

        // Inject the mock client and logger into the service
        $service = new LaravelGPTService($configRepository);
        $reflection = new \ReflectionClass($service);
        $clientProperty = $reflection->getProperty('client');
        $clientProperty->setAccessible(true);
        $clientProperty->setValue($service, $mockClient);

        // Call the generateOpenAIResponse method and check the response
        $response = $service->generateOpenAIResponse('Test prompt');

        // Assert the response is empty
        $this->assertEquals('', $response);
    }
}
