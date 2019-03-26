<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 26.03.2019
 * Time: 20:50
 */

namespace App\Queries\Datasources;


use GuzzleHttp\Psr7\Request;

class ExampleSource implements DatasourceInterface
{

    /**
     * @param array $context
     * @return \GuzzleHttp\Psr7\Request
     */
    public function request(array $context): \GuzzleHttp\Psr7\Request
    {
        $headers = ['X-Foo' => 'Bar'];
        return new Request('GET', 'http://httpbin.org/get?foo=bar', $headers);
    }

    public function process(\GuzzleHttp\Psr7\Response $response): array
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}