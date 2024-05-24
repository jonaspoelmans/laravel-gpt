<?php

namespace Jonaspoelmans\LaravelGpt\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

use Illuminate\Contracts\Config\Repository as ConfigRepository;

class LaravelGPTService
{
    // Configuration repository instance
    private $configRepository;

    // HTTP client instance
    protected $client;

    // API key for OpenAI
    protected $apiKey;

    /**
     * Constructor to initialize the service with dependencies.
     *
     * @param ConfigRepository $configRepository
     */
    public function __construct(ConfigRepository $configRepository, Client $client = null)
    {
        // Store the configuration repository instance
        $this->configRepository = $configRepository;

        // Retrieve the OpenAI API key from environment variables
        $this->apiKey = env('OPENAI_API_KEY');

        // Initialize the HTTP client with the base URI from the configuration
        $this->client = $client ?: new Client();
    }

    /**
     * Generate a response from the OpenAI API.
     *
     * @param string $prompt
     * @return array|string
     */
    public function generateOpenAIResponse($prompt)
    {
        // get base URI
        $baseUri = $this->configRepository->get('laravelgpt.openai_base_uri');

        try {
            // Send a POST request to the OpenAI API
            $response = $this->client->request('POST', "$baseUri/chat/completions", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => $this->configRepository->get('laravelgpt.openai_model'),
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $prompt, // The prompt provided by the user
                        ],
                    ],
                    'max_tokens' => $this->configRepository->get('laravelgpt.openai_max_tokens'),
                    'temperature' => $this->configRepository->get('laravelgpt.openai_temperature'),
                ],
            ]);

            // Get the response body
            $body = $response->getBody()->getContents();

            // Decode the JSON response
            $bodyJson = json_decode($body, true);

            return $bodyJson;
        } catch (\Exception $e) {
            // Handle exception
            if($this->configRepository->get('laravelgpt.openai_logging')) {
                // Log exception
                Log::debug($e->getMessage());
            }

            // return no results
            return '';
        }
    }
}
