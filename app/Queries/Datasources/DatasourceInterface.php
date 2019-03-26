<?php

namespace App\Queries\Datasources;


interface DatasourceInterface
{
    /**
     * @param array $context
     * @return \GuzzleHttp\Psr7\Request
     */
    public function request(array $context): \GuzzleHttp\Psr7\Request;

    public function process(\GuzzleHttp\Psr7\Response $response): array;

}