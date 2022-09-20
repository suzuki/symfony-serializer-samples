<?php

declare(strict_types=1);

use App\Model\v000\Cat;
use App\Repository\CatRepository;
use App\ViewModel\DetailView;

require_once __DIR__ . '/../../vendor/autoload.php';

$repo = new CatRepository(Cat::class);
$mugi = $repo->find(1);

$view = new DetailView($mugi); // @phpstan-ignore-line

$output = json_encode($view);

echo $output;

// output
// {"id":1,"name":"Mugi","image_url":"mugi.jpg","gender":"Female","weight":1.8}
