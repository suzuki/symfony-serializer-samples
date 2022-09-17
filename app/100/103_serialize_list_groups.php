<?php

declare(strict_types=1);

use App\Model\v103\Cat;
use App\Repository\CatRepository;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

require_once __DIR__ . '/../../vendor/autoload.php';

$repo = new CatRepository(Cat::class);
$mugi = $repo->find(1);
$sora = $repo->find(2);

$classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

$normalizers = [new ObjectNormalizer($classMetadataFactory)];
$encoders = [new JsonEncoder()];
$serializer = new Serializer($normalizers, $encoders);

$data = [$mugi, $sora];

$output = $serializer->serialize($data, 'json', [
    AbstractNormalizer::GROUPS => ['list'],
]);

echo $output;

// output
// [{"id":1,"name":"Mugi","imageUrl":"mugi.jpg"},{"id":2,"name":"Sora","imageUrl":"sora.jpg"}]
