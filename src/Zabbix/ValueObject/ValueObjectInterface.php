<?php

namespace App\Zabbix\ValueObject;

interface ValueObjectInterface
{
    public function getValue();

    public function __toString(): string;
}