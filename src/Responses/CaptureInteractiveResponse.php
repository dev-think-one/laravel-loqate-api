<?php


namespace LaravelLoqate\Responses;

class CaptureInteractiveResponse extends AbstractResponse
{
    public function items(): array
    {
        $items = $this->json('Items', []);

        return is_array($items) ? $items : [];
    }

    public function failed(): bool
    {
        $items = $this->items();

        return (! count($items)) || ! empty($items[0]['Error']);
    }

    public function success(): bool
    {
        return ! $this->failed();
    }

    public function errorCode(): string
    {
        return $this->items()[0]['Error'] ?? '';
    }

    public function errorDescription(): string
    {
        return $this->items()[0]['Description'] ?? '';
    }

    public function errorCause(): string
    {
        return $this->items()[0]['Cause'] ?? '';
    }

    public function errorResolution(): string
    {
        return $this->items()[0]['Resolution'] ?? '';
    }
}
