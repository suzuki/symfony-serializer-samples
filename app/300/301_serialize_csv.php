<?php

declare(strict_types=1);

use App\Model\v300\Cat;
use App\Repository\CatRepository;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

require_once __DIR__ . '/../../vendor/autoload.php';

$repo = new CatRepository(Cat::class);
$mugi = $repo->find(1);
$sora = $repo->find(2);

$normalizers = [new ObjectNormalizer()];
$encoders = [new CsvEncoder()];
$serializer = new Serializer($normalizers, $encoders);

$data = [$mugi, $sora];

$output = $serializer->serialize($data, 'csv');

echo $output;

// output
// id,name,imageUrl,gender,weight
// 1,Mugi,mugi.jpg,Female,1.8
// 2,Sora,sora.jpg,Male,2.4
