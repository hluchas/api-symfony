<?php

namespace App\Tests\Api;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CarTest extends TestCase
{
    /**
     * @var Client
     */
    private $httpClient;

    protected function setUp(): void
    {
        $this->httpClient = new Client(
            [
                'base_uri' => 'http://nginx:81/api/car',
                // Disable thowing exceptions on non 200 OK status codes to be able check response
                'http_errors' => false,
            ]
        );
    }

    public function testGetAllEmpty()
    {
        $response = $this->httpClient->request(
            Request::METHOD_GET,
            ''
        );

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());

        self::assertEquals(
            'application/json',
            $response->getHeaders()['Content-Type'][0]
        );

        self::assertEquals('[]', (string) $response->getBody());
    }

    public function testGetByIdNotFound(): void
    {
        $response = $this->httpClient->request(
            Request::METHOD_GET,
            '/1'
        );

        self::assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }
}
