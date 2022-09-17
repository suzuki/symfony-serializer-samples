<?php

declare(strict_types=1);

use App\Model\v105\Cat;
use App\Repository\CatRepository;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

require_once __DIR__ . '/../../vendor/autoload.php';

$repo = new CatRepository(Cat::class);
$mugi = $repo->find(1);
$sora = $repo->find(2);

$classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
$metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);

$normalizers = [new ObjectNormalizer($classMetadataFactory, $metadataAwareNameConverter)];
$encoders = [new JsonEncoder()];
$serializer = new Serializer($normalizers, $encoders);

$data = [$mugi, $sora];

$output = $serializer->serialize($data, 'json', [
    AbstractNormalizer::GROUPS => ['list'],
]);

echo $output;

// output
// [{"id":2,"name":"Sora","image_url":"sora.jpg","lower_name":"sora"},{"id":1,"name":"Mugi","image_url":"mugi.jpg","lower_name":"mugi"}]
