<?php

declare(strict_types=1);

namespace App\Zabbix\Model;

class ErrorModel implements ParamInterface
{
    /**
     * @var null|string
     */
    public $code;

    /**
     * @var null|string
     */
    public $message;

    /**
     * @var null|string
     */
    public $data;

    public static function method(): string
    {
        return '';
    }
}
