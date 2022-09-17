<?php

declare(strict_types=1);

namespace App\Encoder;

use App\Encoder\TinyTomlEncoder\Dumper;
use App\Encoder\TinyTomlEncoder\Parser;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;

class TinyTomlEncoder implements EncoderInterface, DecoderInterface
{
    public const FORMAT = 'toml';

    private Dumper $dumper;
    private Parser $parser;

    public function __construct(Dumper $dumper = null, Parser $parser = null)
    {
        $this->dumper = $dumper ?? new Dumper();
        $this->parser = $parser ?? new Parser();
    }

    /**
     * {@inheritdoc}
     * @phpstan-ignore-next-line
     */
    public function encode(mixed $data, string $format, array $context = []): string
    {
        return $this->dumper->dump($data);
    }

    /**
     * {@inheritdoc}
     * @phpstan-ignore-next-line
     */
    public function supportsEncoding(string $format, array $context = []): bool
    {
        return self::FORMAT === $format;
    }

    /**
     * {@inheritdoc}
     * @phpstan-ignore-next-line
     */
    public function decode(string $data, string $format, array $context = [])
    {
        return $this->parser->parse($data);
    }

    /**
     * {@inheritdoc}
     * @phpstan-ignore-next-line
     */
    public function supportsDecoding(string $format, array $context = [])
    {
        return self::FORMAT === $format;
    }
}
