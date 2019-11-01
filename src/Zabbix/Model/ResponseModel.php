<?php

declare(strict_types=1);

namespace App\Zabbix\Model;

use App\Zabbix\ValueObject\Version;

class ResponseModel
{
    /**
     * @var null|Version
     */
    public $jsonrpc;

    /**
     * @var string
     */
    public $method;

    /**
     * @var int
     */
    public $id;

    /**
     * @var null|string
     */
    public $auth;

    /**
     * @var null|ErrorModel
     */
    public $error;

    /**
     * @var null|string
     */
    public $result;

    /**
     * @param null|ErrorModel $error
     */
    public function setError(?ErrorModel $error): void
    {
        $this->error = $error;
    }

    public function isError(): bool
    {
        return null !== $this->error;
    }

    /**
     * @param null|string $result
     */
    public function setResult($result): void
    {
        $this->result = $result;
    }
}
