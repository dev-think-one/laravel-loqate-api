<?php


namespace LaravelLoqate\APIs;

use LaravelLoqate\Responses\CaptureInteractiveResponse;

/**
 * Uses a text search to find addresses and places.
 * @see https://www.loqate.com/resources/support/apis/Capture/Interactive/Find/1.1/
 * Class CaptureInteractiveFind
 * @package LaravelLoqate\APIs
 */
class CaptureInteractiveFind extends AbstractAPI
{

    /**
     * @inheritDoc
     */
    public function basePath(): string
    {
        return 'Capture/Interactive/Find/v1.1';
    }

    /**
     * @inheritDoc
     */
    protected function responseClass(): string
    {
        return CaptureInteractiveResponse::class;
    }

    /**
     * The search text to find. Ideally a postcode or the start of the address.
     *
     * @param string $text
     *
     * @return $this
     */
    public function setText(string $text): self
    {
        return $this->setRequestField('Text', $text);
    }

    /**
     * Whether the API is being called from a middleware implementation
     * (and therefore the calling IP address should not be used for biasing)
     *
     * @param bool $isMiddleware
     *
     * @return $this
     */
    public function setIsMiddleware(bool $isMiddleware = true): self
    {
        return $this->setRequestField('IsMiddleware', $isMiddleware);
    }

    /**
     * A container for the search. This should only be another Id previously returned from this service when the Type of the result was not 'Address'.
     *
     * @param string $text
     *
     * @return $this
     */
    public function setContainer(string $text): self
    {
        return $this->setRequestField('Container', $text);
    }
}
