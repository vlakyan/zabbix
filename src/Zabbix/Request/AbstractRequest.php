<?php

namespace App\Zabbix\Request;

use App\Zabbix\Model\BaseModel;
use GuzzleHttp\RequestOptions;

abstract class AbstractRequest implements RequestInterface
{
    protected $method = 'POST';

    protected $options = [
        RequestOptions::HEADERS => [
            'Content-Type' => 'application/json',
        ],
    ];

    protected $model;

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getModel(): BaseModel
    {
        return $this->model;
    }
}
