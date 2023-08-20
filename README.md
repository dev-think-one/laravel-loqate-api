# Laravel: [Loqate](https://www.loqate.com/) API integration

![Packagist License](https://img.shields.io/packagist/l/think.studio/laravel-loqate-api?color=%234dc71f)
[![Packagist Version](https://img.shields.io/packagist/v/think.studio/laravel-loqate-api)](https://packagist.org/packages/think.studio/laravel-loqate-api)
[![Total Downloads](https://img.shields.io/packagist/dt/think.studio/laravel-loqate-api)](https://packagist.org/packages/think.studio/laravel-loqate-api)
[![Build Status](https://scrutinizer-ci.com/g/dev-think-one/laravel-loqate-api/badges/build.png?b=main)](https://scrutinizer-ci.com/g/dev-think-one/laravel-loqate-api/build-status/main)
[![Code Coverage](https://scrutinizer-ci.com/g/dev-think-one/laravel-loqate-api/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/dev-think-one/laravel-loqate-api/?branch=main)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dev-think-one/laravel-loqate-api/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/dev-think-one/laravel-loqate-api/?branch=main)

## Installation

You can install the package via composer:

```bash
composer require think.studio/laravel-loqate-api
```

Configuration in *.env*
```
// config/services.php
'loqate' => [
    'key'    => env('LOQATE_API_KEY'),
],
```
```dotenv
LOQATE_API_KEY="AA11-AA11-AA11-AA11"
```

## Usage

Simple call

```injectablephp
LaravelLoqate\Loqate::captureInteractiveFind()->setText('CT15 5LS')->setIsMiddleware()->call()->json();
```

Set you api class

```injectablephp
use LaravelLoqate\APIs\AbstractAPI;

class MyCaptureInteractiveFind extends AbstractAPI {

    /**
     * @inheritDoc
     */
    public function basePath(): string {
        return 'Capture/Interactive/Find/v1.1';
    }
}

$response = LaravelLoqate\Loqate::api(MyCaptureInteractiveFind::class)->setRequestField('Text', 'CT15 5LS')->setRequestField('IsMiddleware', true)->call();

$response->json('Items');
```

You can also specify your response wrapper (extends AbstractResponse)

## Credits

- [![Think Studio](https://yaroslawww.github.io/images/sponsors/packages/logo-think-studio.png)](https://think.studio/)
