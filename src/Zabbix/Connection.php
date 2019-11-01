<?php

declare(strict_types=1);

namespace App\Zabbix;

use App\Zabbix\Exception\ResponseException;
use App\Zabbix\Request\RequestInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;

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
     * @throws GuzzleException
     * @throws ResponseException
     *
     * @return string
     */
    public function send(RequestInterface $request, string $json = null): string
    {
        $options = [
            RequestOptions::BODY => $json,
        ];

        try {
            $response = $this->client->request($request->getMethod(), $this->url, \array_merge($options, $request->getOptions()));

            return $response->getBody()->getContents();
        } catch (RequestException $requestException) {
            throw new ResponseException($requestException->getMessage());
        }
    }
}
