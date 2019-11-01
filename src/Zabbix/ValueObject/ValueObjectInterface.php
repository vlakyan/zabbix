<?php

declare(strict_types=1);

namespace App\Zabbix\ValueObject;

interface ValueObjectInterface
{
    /**
     * @return mixed
     */
    public function getValue();

    public function __toString(): string;
}
