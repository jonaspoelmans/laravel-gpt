# Connect with LLMs such as OpenAI ChatGPT and Mistral

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jonaspoelmans/laravel-gpt.svg)](https://packagist.org/packages/jonaspoelmans/laravel-gpt)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/jonaspoelmans/laravel-gpt/php.yml?branch=main&label=Tests)](https://github.com/jonaspoelmans/laravel-gpt/actions?query=workflow%3ATests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/jonaspoelmans/laravel-gpt.svg?style=flat-square)](https://packagist.org/packages/jonaspoelmans/laravel-gpt)

## Documentation, Installation, and Usage Instructions

### Laravel
Require this package in your composer.json and update composer. This will download the package and the laravel-gpt libraries also.

    composer require jonaspoelmans/laravel-gpt

You also need to create an OpenAI API key and add it to your.env file:

    OPENAI_API_KEY=xxxxxxxxxxxxx

## What It Does
This package allows you to connect by API to Large language Models such as OpenAI ChatGPT and Mistral.

Once installed you can do stuff like this:

```php
// Create your prompt for the LLM
$prompt = "Give me the list of 10 best PHP frameworks."

// Instantiate the Laravel GPT service
$laravelGPT = new LaravelGPTService();

// Retrieve a response from ChatGPT
$response = $laravelGPT->generateOpenAIResponse($prompt);
```

The response object is an associative array if the request went through or an empty string if an error occurred.

The parameters for the LLMs can be configured through the laravelgpt.php config class. You can publish the configuration file as follows:

    php artisan vendor:publish --tag="laravel-gpt-config" 

For OpenAI you can tweak these parameters:
```php
// The base URI for the OpenAI API.
// This is the endpoint where all API requests will be sent.
'openai_base_uri' => 'https://api.openai.com/v1/',

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
```
## Contributing

Please send me a direct message if you would like to contribute..

### Testing

``` bash
composer test
```

### Security

If you discover any security-related issues, please email [jonas.poelmans@gmail.com](mailto:jonas.poelmans@gmail.com) instead of using the issue tracker.

## Postcardware

You're free to use this package, but if it makes it to your production environment I would highly appreciate if you send me a text:-) I reply to all messages!

## Credits

- [Jonas Poelmans](https://github.com/jonaspoelmans)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
