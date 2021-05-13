<?php


namespace LaravelLoqate;

use LaravelLoqate\APIs\AbstractAPI;
use LaravelLoqate\APIs\CaptureInteractiveFind;
use LaravelLoqate\APIs\CaptureInteractiveRetrieve;

class LoqateApi
{
    protected string $key;

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
     * Initialise api class
     *
     * @param string $abstract - Class name
     * @param string|null $key - Optional api key if you need override default key
     *
     * @return AbstractAPI
     */
    public function api(string $abstract, ?string $key = null): AbstractAPI
    {
        if (! is_subclass_of($abstract, AbstractAPI::class)) {
            throw new LoqateException('$abstract should be child of AbstractAPI');
        }

        return new $abstract($key ?? $this->key);
    }

    /**
     * @param string|null $key
     *
     * @return CaptureInteractiveFind
     */
    public function captureInteractiveFind(?string $key = null): CaptureInteractiveFind
    {
        return $this->api(CaptureInteractiveFind::class, $key);
    }

    /**
     * @param string|null $key
     *
     * @return CaptureInteractiveRetrieve
     */
    public function captureInteractiveRetrieve(?string $key = null): CaptureInteractiveRetrieve
    {
        return $this->api(CaptureInteractiveRetrieve::class, $key);
    }
}
