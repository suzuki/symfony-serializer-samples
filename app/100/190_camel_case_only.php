<?php

declare(strict_types=1);

use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;

require_once __DIR__ . '/../../vendor/autoload.php';

$converter = new CamelCaseToSnakeCaseNameConverter();

$snake_case = $converter->normalize('ImageUrl');
echo $snake_case . "\n";

$camelCase = $converter->denormalize('image_url');
echo $camelCase . "\n";

// output
// image_url
// imageUrl
