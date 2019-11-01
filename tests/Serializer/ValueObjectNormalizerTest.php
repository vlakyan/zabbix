<?php

declare(strict_types=1);

namespace Tests\Serializer;

use App\Zabbix\Serializer\ValueObjectNormalizer;
use App\Zabbix\ValueObject\Version;
use PHPStan\Testing\TestCase;
use stdClass;

class ValueObjectNormalizerTest extends TestCase
{
    /**
     * @var ValueObjectNormalizer
     */
    private $normolizer;

    public function setUp(): void
    {
        $this->normolizer = new ValueObjectNormalizer();
    }

    public function testSupportsNormalization(): void
    {
        self::assertTrue($this->normolizer->supportsNormalization(new Version('1')));
        self::assertFalse($this->normolizer->supportsNormalization(new stdClass()));
        self::assertFalse($this->normolizer->supportsNormalization('asdasd'));
    }

    public function testDenormalize(): void
    {
        self::assertEquals('1', $this->normolizer->denormalize('1', Version::class));
        self::assertNotEquals('1', $this->normolizer->denormalize('2', Version::class));
        self::assertInstanceOf(Version::class, $this->normolizer->denormalize('2', Version::class));
    }

    /**
     * @expectedException \Symfony\Component\Serializer\Exception\NotNormalizableValueException
     */
    public function testDenormalizeFail(): void
    {
        $this->normolizer->denormalize(' ', Version::class);
    }

    public function testNormalize(): void
    {
        self::assertEquals('1', $this->normolizer->normalize(new Version('1')));
        self::assertEquals('2', $this->normolizer->normalize(new Version('2')));
        self::assertNotEquals('1', $this->normolizer->normalize(new Version('2')));
    }

    /**
     * @expectedException \Symfony\Component\Serializer\Exception\InvalidArgumentException
     */
    public function testNormalizeFail(): void
    {
        $this->normolizer->normalize('2');
    }

    public function testSupportsDenormalization(): void
    {
        self::assertTrue($this->normolizer->supportsDenormalization(null, Version::class));
        self::assertFalse($this->normolizer->supportsDenormalization(null, '2'));
    }

    public function testHasCacheableSupportsMethod(): void
    {
        self::assertTrue($this->normolizer->hasCacheableSupportsMethod());
    }
}
