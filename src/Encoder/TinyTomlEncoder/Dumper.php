<?php

declare(strict_types=1);

namespace App\Encoder\TinyTomlEncoder;

class Dumper
{
    public function dump(mixed $input): string
    {
        $output = '';

        if (is_array($input)) {
            /** @var array<string, bool|float|int|string|null> $input */
            foreach ($input as $key => $value) {
                if ('' !== $output && "\n" !== $output[-1]) {
                    $output .= "\n";
                }

                $output_value = $value;
                do {
                    if (is_string($value)) {
                        $output_value = sprintf('"%s"', $value);
                        break;
                    }
                } while (false); // @phpstan-ignore-line

                $output .= sprintf('%s = %s', $key, $output_value);
            }
        }

        if ("\n" !== $output[-1]) {
            $output .= "\n";
        }

        return $output;
    }
}
