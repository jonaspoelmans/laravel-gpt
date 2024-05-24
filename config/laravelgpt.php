<?php

return [
    // The base URI for the OpenAI API.
    // This is the endpoint where all API requests will be sent.
    'openai_base_uri' => 'https://api.openai.com/v1',

    // The default model to be used for generating responses.
    // You can change this to any valid model identifier provided by OpenAI,
    // such as 'gpt-3.5-turbo' or 'gpt-4-1106-preview'.
    'openai_model' => 'gpt-4-1106-preview',

    // The maximum number of tokens to generate in the response.
    // Tokens can be thought of as pieces of words. The maximum number
    // of tokens allowed is determined by the model you are using.
    'openai_max_tokens' => 4000,

    // The temperature setting for the response generation.
    // Temperature controls the randomness of the output.
    // A value closer to 0 makes the output more deterministic and repetitive,
    // while a value closer to 1 makes it more random.
    'openai_temperature' => 0.7,

    // Enable or disable logging of errors.
    // When set to true, any errors encountered while using the API
    // will be logged using Laravel's built-in logging system.
    'openai_logging' => true,
];
