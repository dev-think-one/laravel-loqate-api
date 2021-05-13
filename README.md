# Laravel: [Loqate](https://www.loqate.com/) API integration

## Installation

You can install the package via composer:

```bash
composer require yaroslawww/laravel-loqate-api
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
