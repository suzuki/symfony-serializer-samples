<?php

declare(strict_types=1);

use App\Model\v102\Cat;
use App\Repository\CatRepository;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

require_once __DIR__ . '/../../vendor/autoload.php';

$repo = new CatRepository(Cat::class);
$mugi = $repo->find(1);
$sora = $repo->find(2);

$normalizers = [new ObjectNormalizer()];
$encoders = [new JsonEncoder()];
$serializer = new Serializer($normalizers, $encoders);

$data = [$mugi, $sora];

$output = $serializer->serialize($data, 'json');

echo $output;

// output
// [{"id":1,"name":"Mugi","imageUrl":"mugi.jpg","gender":"Female","weight":1.8},{"id":2,"name":"Sora","imageUrl":"sora.jpg","gender":"Male","weight":2.4}]
