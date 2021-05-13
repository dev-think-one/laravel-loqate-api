<?php

namespace LaravelLoqate\APIs;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use LaravelLoqate\Responses\AbstractResponse;
use LaravelLoqate\Responses\LoqateResponse;

abstract class AbstractAPI
{

    /**
     * Http client
     * @var PendingRequest|null
     */
    protected ?PendingRequest $http = null;

    /**
     * Api key
     * @var string
     */
    protected string $key;

    /**
     * Request Fields
     * @var array
     */
    protected array $requestParams = [];

    /**
     * LoqateApi constructor.
     *
     * @param string $key
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * Get api base path for uri
     * @return string
     * @example "Capture/Interactive/Find"
     */
    abstract public function basePath(): string;

    /**
     * Get locator for api uri
     * @return string
     */
    public function url(): string
    {
        return rtrim(config('services.loqate.url', 'https://api.addressy.com/'), '/') . '/';
    }

    /**
     * Get json endpoint for api uri
     * @return string
     */
    public function jsonEndpoint(): string
    {
        return '/' . ltrim(config('services.loqate.jsonEndpoint', '/json3.ws'), '/');
    }

    /**
     * Get api uri
     * @return string
     */
    public function uri(): string
    {
        return $this->url() . trim($this->basePath(), '/') . $this->jsonEndpoint();
    }

    /**
     * @return PendingRequest
     */
    protected function http(): PendingRequest
    {
        if (! $this->http) {
            $this->http = Http::acceptJson();
        }

        return $this->http;
    }

    /**
     * Get Response class
     * @return string
     */
    protected function responseClass(): string
    {
        return LoqateResponse::class;
    }

    /**
     * Dynamically proxy other methods to the underlying response.
     *
     * @param string $method
     * @param array $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->http()->{$method}(...$parameters);
    }

    /**
     * @param string $key
     * @param $value
     *
     * @return $this
     */
    public function setRequestField(string $key, $value): self
    {
        $this->requestParams[ $key ] = $value;

        return $this;
    }

    /**
     * @return AbstractResponse
     */
    public function call(): AbstractResponse
    {
        $class = $this->responseClass();

        return new $class($this->rawCall());
    }

    /**
     * @return Response
     */
    public function rawCall(): Response
    {
        return $this->http()->get(
            $this->uri(),
            array_merge($this->requestParams, [
                'Key' => $this->key,
            ])
        );
    }
}
