<?php

namespace App\Encoder\TinyTomlEncoder;

use PHPUnit\Framework\TestCase;

final class ParserTest extends TestCase
{
    private Parser $parser;

    protected function setUp(): void
    {
        $this->parser = new Parser();
    }

    public function testParser(): void
    {
        $toml = file_get_contents(__DIR__ . '/fixture_001.toml');
        if (false === $toml) {
            $this->fail('Can not read the fixture');
        }

        $data = $this->parser->parse($toml);

        $expected = [
            'id' => 1,
            'name' => 'Mugi',
            'imageUrl' => 'mugi.jpg',
            'gender' => 'Female',
            'weight' => 1.8,
        ];

        $this->assertSame($expected, $data);
    }
}
