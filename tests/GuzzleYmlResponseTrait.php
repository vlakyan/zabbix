<?php

declare(strict_types=1);

namespace Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

trait GuzzleYmlResponseTrait
{
    public static function createClientByYmlResponse(string $pathFile): Client
    {
        $data = \yaml_parse_file($pathFile);

        $default = [
            'body'   => null,
            'header' => [],
            'code'   => 200,
        ];

        $mock = new MockHandler(\array_map(function (array $item) use ($default) {
            $item = $item + $default;

            return new Response($item['code'], $item['header'], $item['body']);
        }, $data));

        $handler = HandlerStack::create($mock);

        return new Client(['handler' => $handler]);
    }
}
