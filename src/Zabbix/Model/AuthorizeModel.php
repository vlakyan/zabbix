<?php

declare(strict_types=1);

namespace App\Zabbix\Model;

class AuthorizeModel implements ParamInterface
{
    private const METHOD = 'user.login';

    /**
     * @var string
     */
    public $user;

    /**
     * @var string
     */
    public $password;

    public static function method(): string
    {
        return self::METHOD;
    }
}
