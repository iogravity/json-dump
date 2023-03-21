# Json Dump

![Latest Version on Packagist](https://img.shields.io/packagist/v/iogravity/json-dump.svg)
![Build](https://img.shields.io/github/actions/workflow/status/iogravity/json-dump/run-tests-phpunit.yml)
![License](https://img.shields.io/github/license/iogravity/json-dump)
![Releases](https://img.shields.io/github/v/release/iogravity/json-dump?include_prereleases)

Whether you are a developer or not, Json Dump makes storing and manipulating json data effortless.

## Support us

[<img src="https://iogravity.com/logo.png" width="419px" />](https://iogravity.com)

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://iogravity.com/contact-us).

## Installation

You can install the package via composer:

```bash
composer require iogravity/json-dump
```

## Usage

```php
$dump = JsonDump\JsonDumpClient::init($secret);
$dump->create(json_encode(["hello" => "Iogravity"], "json_one");
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.


## Credits

- [Iogravity](https://github.com/iogravity)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
