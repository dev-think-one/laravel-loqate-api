<?php


namespace LaravelLoqate\Tests;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use LaravelLoqate\Loqate;
use LaravelLoqate\LoqateException;
use LaravelLoqate\Responses\CaptureInteractiveResponse;

class CaptureInteractiveFindTest extends TestCase
{

    /** @test */
    public function success_call()
    {
        Http::fake(function (\Illuminate\Http\Client\Request $request) {
            $this->assertEquals('testText', $request->data()['Text']);
            $this->assertTrue($request->data()['IsMiddleware']);
            $this->assertEquals('testContainer', $request->data()['Container']);
            $this->assertEquals('FAKE-AA11-AA11-AA11', $request->data()['Key']);

            return Http::response([
                'Items' => [
                    [
                        'Id'          => 'GB|RM|A|5644757',
                        'Type'        => 'Address',
                        'Text'        => 'Flat 3, Waldershare House',
                        'Highlight'   => '',
                        'Description' => 'Waldershare, Dover, CT15 5LS',
                    ],
                ],
            ], 200);
        });

        $pending = Loqate::captureInteractiveFind()
                         ->setText('testText')
                         ->setIsMiddleware()
                         ->setContainer('testContainer');

        /*
         * Simple request
         * */


        /** @var CaptureInteractiveResponse $response */
        $response = $pending->call();

        $this->assertInstanceOf(CaptureInteractiveResponse::class, $response);

        $this->assertTrue($response->success());
        $this->assertFalse($response->failed());

        /*
         * Raw request
         * */

        /** @var Response $response */
        $response = $pending->rawCall();

        $this->assertInstanceOf(Response::class, $response);

        $this->assertTrue($response->successful());
        $this->assertFalse($response->failed());
    }

    /** @test */
    public function error_call()
    {
        Http::fake(function (\Illuminate\Http\Client\Request $request) {
            $this->assertEquals('FAKE-AA11-AA11-AA11', $request->data()['Key']);

            return Http::response([
                'Items' => [
                    [
                        'Error'       => 'testError',
                        'Description' => 'testDescription',
                        'Cause'       => 'testCause',
                        'Resolution'  => 'testResolution',
                    ],
                ],
            ], 200);
        });

        /** @var CaptureInteractiveResponse $response */
        $response = Loqate::captureInteractiveFind()->call();

        $this->assertInstanceOf(CaptureInteractiveResponse::class, $response);
        $this->assertInstanceOf(Response::class, $response->getRawResponse());

        $this->assertEquals('testError', $response->errorCode());
        $this->assertEquals('testDescription', $response->errorDescription());
        $this->assertEquals('testCause', $response->errorCause());
        $this->assertEquals('testResolution', $response->errorResolution());

        /** @var CaptureInteractiveResponse $response */
        $response = Loqate::captureInteractiveRetrieve()->setId('testID')->call();

        $this->assertInstanceOf(CaptureInteractiveResponse::class, $response);
        $this->assertInstanceOf(Response::class, $response->getRawResponse());

        $this->assertEquals('testError', $response->errorCode());
        $this->assertEquals('testDescription', $response->errorDescription());
        $this->assertEquals('testCause', $response->errorCause());
        $this->assertEquals('testResolution', $response->errorResolution());


        $this->expectException(LoqateException::class);
        Loqate::api(CaptureInteractiveResponse::class)->call();
    }
}
