<?php

namespace App\Zabbix\Request;

use App\Zabbix\Model\BaseModel;

interface RequestInterface
{
    public function getMethod(): string;

    public function getOptions(): array;

    public function getModel(): BaseModel;

}