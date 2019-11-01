<?php

declare(strict_types=1);

namespace App\Zabbix\ValueObject;

use Webmozart\Assert\Assert;

class Version implements ValueObjectInterface
{
    /**
     * @var string
     */
    private $value;

    /**
     * Version constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        Assert::digits($value);
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
