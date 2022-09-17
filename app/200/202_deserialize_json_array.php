<?php

declare(strict_types=1);

use App\Model\v200\Cat;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

require_once __DIR__ . '/../../vendor/autoload.php';

$normalizers = [new ObjectNormalizer(), new ArrayDenormalizer()];
$encoders = [new JsonEncoder()];

$serializer = new Serializer($normalizers, $encoders);

$json = '[
  {"id":1,"name":"Mugi","imageUrl":"mugi.jpg","gender":"Female","weight":1.8},
  {"id":2,"name":"Sora","imageUrl":"sora.jpg","gender":"Male","weight":2.4}
]';

$list = $serializer->deserialize($json, Cat::class.'[]', 'json');

print_r($list);

// output
// Array
// (
//     [0] => App\Model\v200\Cat Object
//         (
//             [id:App\Model\v200\Cat:private] => 1
//             [name:App\Model\v200\Cat:private] => Mugi
//             [imageUrl:App\Model\v200\Cat:private] => mugi.jpg
//             [gender:App\Model\v200\Cat:private] => Female
//             [weight:App\Model\v200\Cat:private] => 1.8
//         )
//
//     [1] => App\Model\v200\Cat Object
//         (
//             [id:App\Model\v200\Cat:private] => 2
//             [name:App\Model\v200\Cat:private] => Sora
//             [imageUrl:App\Model\v200\Cat:private] => sora.jpg
//             [gender:App\Model\v200\Cat:private] => Male
//             [weight:App\Model\v200\Cat:private] => 2.4
//         )
//
// )
