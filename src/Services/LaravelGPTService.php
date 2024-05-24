<?php

namespace Jonaspoelmans\LaravelGpt\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

use Illuminate\Contracts\Config\Repository as ConfigRepository;

class LaravelGPTService
{
    private $configRepository;

    protected $client;
    protected $apiKey;

    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;

        $this->apiKey = env('OPENAI_API_KEY');
        $this->client = new Client([
            $this->configRepository->get('laravelgpt.base_uri'),
        ]);
    }

    public function generateOpenAIResponse($prompt)
    {
        try {
            $response = $this->client->request('POST', 'chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $prompt, // Assume you're getting a message from the request
                        ],
                    ],
                    $this->configRepository->get('laravelgpt.model'),
                    $this->configRepository->get('laravelgpt.max_tokens'),
                    $this->configRepository->get('laravelgpt.temperature')
                ],
            ]);

            $body = $response->getBody()->getContents();

            $bodyJson = json_decode($body, true);

            return $bodyJson;
        } catch (\Exception $e) {
            // Handle exception
            if($this->configRepository->get('laravelgpt.logging')) {
                Log::debug($e->getMessage());
            }

            return '';
        }
    }
}
