<?php

namespace App\Zabbix\ValueObject;

class Version implements ValueObjectInterface
{
    private $value;

    /**
     * Version constructor.
     *
     * @param $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function getValue()
    {
        return $this->value;
    }
}