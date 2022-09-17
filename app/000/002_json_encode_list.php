<?php

declare(strict_types=1);

use App\Model\v000\Cat;
use App\Repository\CatRepository;
use App\ViewModel\ListView;

require_once __DIR__ . '/../../vendor/autoload.php';

$repo = new CatRepository(Cat::class);
$mugi = $repo->find(1);
$sora = $repo->find(2);

$data = [
    new ListView($mugi), // @phpstan-ignore-line
    new ListView($sora), // @phpstan-ignore-line
];

$output = json_encode($data);

echo $output;

// output
// [{"id":1,"name":"Mugi","image_url":"mugi.jpg"},{"id":2,"name":"Sora","image_url":"sora.jpg"}]
