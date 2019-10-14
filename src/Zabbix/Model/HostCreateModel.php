<?php

namespace App\Zabbix\Model;

class HostCreateModel implements ParamInterface
{
    public const METHOD = 'host.create';

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
}