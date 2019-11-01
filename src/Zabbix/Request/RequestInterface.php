<?php

declare(strict_types=1);

namespace App\Zabbix\Request;

use App\Zabbix\Model\BaseModel;

interface RequestInterface
{
    public const METHOD_GET = 'GET';

    public const METHOD_POST = 'POST';

    public function getMethod(): string;

    public function getOptions(): array;

    public function getModel(): BaseModel;
}
