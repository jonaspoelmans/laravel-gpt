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

The parameters for the LLMs can be configured through the laravbelgpt.php config class.

```php
$user->can('edit articles');
```

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-permission.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-permission)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

### Testing

``` bash
composer test
```

### Security

If you discover any security-related issues, please email [security@spatie.be](mailto:security@spatie.be) instead of using the issue tracker.

## Postcardware

You're free to use this package, but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Kruikstraat 22, 2018 Antwerp, Belgium.

We publish all received postcards [on our company website](https://spatie.be/en/opensource/postcards).

## Credits

- [Chris Brown](https://github.com/drbyte)
- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

This package is heavily based on [Jeffrey Way](https://twitter.com/jeffrey_way)'s awesome [Laracasts](https://laracasts.com) lessons
on [permissions and roles](https://laracasts.com/series/whats-new-in-laravel-5-1/episodes/16). His original code
can be found [in this repo on GitHub](https://github.com/laracasts/laravel-5-roles-and-permissions-demo).

Special thanks to [Alex Vanderbist](https://github.com/AlexVanderbist) who greatly helped with `v2`, and to [Chris Brown](https://github.com/drbyte) for his longtime support  helping us maintain the package.

And a special thanks to [Caneco](https://twitter.com/caneco) for the logo ✨

## Alternatives

- [Povilas Korop](https://twitter.com/@povilaskorop) did an excellent job listing the alternatives [in an article on Laravel News](https://laravel-news.com/two-best-roles-permissions-packages). In that same article, he compares laravel-permission to [Joseph Silber](https://github.com/JosephSilber)'s [Bouncer]((https://github.com/JosephSilber/bouncer)), which in our book is also an excellent package.
- [santigarcor/laratrust](https://github.com/santigarcor/laratrust) implements team support
- [ultraware/roles](https://github.com/ultraware/roles) (archived) takes a slightly different approach to its features.
- [zizaco/entrust](https://github.com/zizaco/entrust) offers some wildcard pattern matching

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
