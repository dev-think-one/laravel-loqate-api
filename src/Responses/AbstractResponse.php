<?php


namespace LaravelLoqate\Responses;

use Illuminate\Http\Client\Response;

abstract class AbstractResponse
{
    protected Response $response;

    /**
     * LoqateResponse constructor.
     *
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @return Response
     */
    public function getRawResponse(): Response
    {
        return $this->response;
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
        return $this->response->{$method}(...$parameters);
    }
}
