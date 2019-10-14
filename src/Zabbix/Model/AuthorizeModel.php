<?php

namespace App\Zabbix\Model;

class AuthorizeModel implements ParamInterface
{
    public const METHOD = 'user.login';

    /**
     * @var string
     */
    public $user;

    /**
     * @var string
     */
    public $password;
}