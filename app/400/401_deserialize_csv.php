<?php

declare(strict_types=1);

use App\Model\v400\Cat;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

require_once __DIR__ . '/../../vendor/autoload.php';

$normalizers = [new ObjectNormalizer(), new ArrayDenormalizer()];
$encoders = [new CsvEncoder()];

$serializer = new Serializer($normalizers, $encoders);

$csv = 'id,name,imageUrl,gender,weight
1,Mugi,mugi.jpg,Female,1.8
2,Sora,sora.jpg,Male,2.4';

$list = $serializer->deserialize($csv, Cat::class.'[]', 'csv');

print_r($list);

// output
// Array
// (
//     [0] => App\Model\v400\Cat Object
//         (
//             [id:App\Model\v400\Cat:private] => 1
//             [name:App\Model\v400\Cat:private] => Mugi
//             [imageUrl:App\Model\v400\Cat:private] => mugi.jpg
//             [gender:App\Model\v400\Cat:private] => Female
//             [weight:App\Model\v400\Cat:private] => 1.8
//         )
//
//     [1] => App\Model\v400\Cat Object
//         (
//             [id:App\Model\v400\Cat:private] => 2
//             [name:App\Model\v400\Cat:private] => Sora
//             [imageUrl:App\Model\v400\Cat:private] => sora.jpg
//             [gender:App\Model\v400\Cat:private] => Male
//             [weight:App\Model\v400\Cat:private] => 2.4
//         )
//
// )
