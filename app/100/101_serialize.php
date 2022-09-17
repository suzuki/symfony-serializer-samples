<?php

declare(strict_types=1);

use App\Model\v101\Cat;
use App\Repository\CatRepository;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

require_once __DIR__ . '/../../vendor/autoload.php';

$repo = new CatRepository(Cat::class);
$mugi = $repo->find(1);

$normalizers = [new ObjectNormalizer()];
$encoders = [new JsonEncoder()];
$serializer = new Serializer($normalizers, $encoders);

$output = $serializer->serialize($mugi, 'json');

echo $output;

// output
// {"id":1,"name":"Mugi","imageUrl":"mugi.jpg","gender":"Female","weight":1.8}
