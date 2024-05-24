# Connect with LLMs such as OpenAI ChatGPT and Mistral

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jonaspoelmans/laravel-gpt.svg)](https://packagist.org/packages/jonaspoelmans/laravel-gpt)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/jonaspoelmans/laravel-gpt/run-tests-L8.yml?branch=main&label=Tests)](https://github.com/spatie/laravel-permission/actions?query=workflow%3ATests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/jonaspoelmans/laravel-gpt.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-permission)

## Documentation, Installation, and Usage Instructions

### Laravel
Require this package in your composer.json and update composer. This will download the package and the laravel-gpt libraries also.

    composer require jonaspoelmans/laravel-gpt

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

The parameters for the LLMs can be configured through the laravelgpt.php config class.

```php
$user->can('edit articles');
```

## Contributing

Please send me a direct message if yiu would like to contribute..

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
