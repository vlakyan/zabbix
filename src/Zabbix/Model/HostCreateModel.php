<?php

declare(strict_types=1);

namespace App\Zabbix\Model;

class HostCreateModel implements ParamInterface
{
    private const METHOD = 'host.create';

    /**
     * @var string
     */
    public $host;

    /**
     * @var InterfaceModel[]
     */
    public $interfaces = [];

    /**
     * @var GroupModel[]
     */
    public $groups = [];

    /**
     * @var TemplateModel[]
     */
    public $templates = [];

    public static function method(): string
    {
        return self::METHOD;
    }
}
