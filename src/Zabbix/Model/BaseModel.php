<?php

declare(strict_types=1);

namespace App\Zabbix\Model;

class BaseModel
{
    /**
     * @var string
     */
    public $jsonrpc = '2.0';

    /**
     * @var string
     */
    public $method;

    /**
     * @var ParamInterface
     */
    public $params;

    /**
     * @var int
     */
    public $id = 1;

    /**
     * @var null|string
     */
    public $auth;

    /**
     * BaseModel constructor.
     *
     * @param ParamInterface $params
     */
    public function __construct(ParamInterface $params)
    {
        $this->method = $params::METHOD;
        $this->params = $params;
    }
}
