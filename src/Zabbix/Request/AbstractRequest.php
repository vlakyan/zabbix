<?php

declare(strict_types=1);

namespace App\Zabbix\Request;

use App\Zabbix\Model\BaseModel;
use GuzzleHttp\RequestOptions;

abstract class AbstractRequest implements RequestInterface
{
    /**
     * @var array
     */
    protected $options = [
        RequestOptions::HEADERS => [
            'Content-Type' => 'application/json',
        ],
    ];

    /**
     * @var BaseModel
     */
    protected $model;

    public function getMethod(): string
    {
        return self::METHOD_POST;
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
