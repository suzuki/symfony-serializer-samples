<?php

namespace App\Encoder\TinyTomlEncoder;

class Parser
{
    public function parse(string $value): mixed
    {
        $lines = explode("\n", $value);

        $data = [];
        foreach ($lines as $line) {
            if (preg_match('/\A\s+\z/', $line)) {
                continue;
            }

            if (preg_match('/\A([\w\.]+)\s*=\s*("*[\w\.]+"*)/', $line, $matches)) {
                $key = $matches[1];
                $value = $this->convertValueType($matches[2]);

                $data[$key] = $value;
            }
        }

        return $data;
    }

    private function convertValueType(string $value): mixed
    {
        if (preg_match('/^"(.+)"$/', $value, $matches)) {
            return (string) $matches[1];
        }

        if (preg_match('/^(\d+\.\d+)$/', $value)) {
            return (float) $value;
        }

        if (preg_match('/^(\d+)$/', $value)) {
            return (int) $value;
        }

        return $value;
    }
}
