<?php

declare(strict_types=1);

namespace App\Zabbix;

use App\Zabbix\Exception\ResponseException;
use App\Zabbix\Request\RequestInterface;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

class Connection
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $url;

    public function __construct(Client $client, string $url)
    {
        $this->client = $client;
        $this->url    = $url;
    }

    /**
     * @param RequestInterface $request
     * @param null|string      $json
     *
     * @throws ResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return string
     */
    public function send(RequestInterface $request, string $json = null): string
    {
        $options = [
            RequestOptions::BODY => $json,
        ];

        $response = $this->client->request($request->getMethod(), $this->url, \array_merge($options, $request->getOptions()));

        if ($response instanceof ResponseInterface) {
            $code    = $response->getStatusCode();
            $content = $response->getBody()->getContents();
            switch (true) {
                case $code > 500:
                case $code < 200:
                    throw new ResponseException($content);
                default:
                    return $content;
            }
        }
    }
}
