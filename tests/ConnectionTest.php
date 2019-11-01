<?php

declare(strict_types=1);

namespace Tests;

use App\Zabbix\Connection;
use App\Zabbix\Request\RequestInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ConnectionTest extends TestCase
{
    use GuzzleYmlResponseTrait;

    /**
     * @var Connection
     */
    private $connection;

    protected function setUp(): void
    {
        $client           = self::createClientByYmlResponse(__DIR__ . '/response/testConenction.yml');
        $this->connection = new Connection($client, '');
    }

    /**
     * @expectedException \App\Zabbix\Exception\ResponseException
     */
    public function testSend(): void
    {
        self::assertEquals('', $this->connection->send($this->mockRequest(), ''));
        $this->connection->send($this->mockRequest(), '');
    }

    private function mockRequest(): RequestInterface
    {
        /** @var MockObject|RequestInterface $mock */
        $mock = self::createMock(RequestInterface::class);
        $mock->method('getMethod')->willReturn('POST');
        $mock->method('getOptions')->willReturn([]);

        return $mock;
    }
}
