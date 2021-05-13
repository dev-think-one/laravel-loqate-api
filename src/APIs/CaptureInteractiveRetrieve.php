<?php


namespace LaravelLoqate\APIs;

use LaravelLoqate\Responses\CaptureInteractiveResponse;

/**
 * Returns the full address details based on the Id.
 * @see https://www.loqate.com/resources/support/apis/Capture/Interactive/Retrieve/1/
 * Class CaptureInteractiveRetrieve
 * @package LaravelLoqate\APIs
 */
class CaptureInteractiveRetrieve extends AbstractAPI
{

    /**
     * @inheritDoc
     */
    public function basePath(): string
    {
        return 'Capture/Interactive/Retrieve/v1';
    }

    /**
     * @inheritDoc
     */
    protected function responseClass(): string
    {
        return CaptureInteractiveResponse::class;
    }

    /**
     * The Id from a Find method to retrieve the details for.
     *
     * @param string $id
     *
     * @return $this
     */
    public function setId(string $id): self
    {
        return $this->setRequestField('Id', $id);
    }
}
