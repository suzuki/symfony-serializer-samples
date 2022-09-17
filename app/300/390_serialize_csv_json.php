<?php

declare(strict_types=1);

use App\Model\v300\Cat;
use App\Repository\CatRepository;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

require_once __DIR__ . '/../../vendor/autoload.php';

$repo = new CatRepository(Cat::class);
$mugi = $repo->find(1);
$sora = $repo->find(2);

$classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
$metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);

$normalizers = [new ObjectNormalizer($classMetadataFactory, $metadataAwareNameConverter)];
$encoders = [new CsvEncoder(), new JsonEncode()];
$serializer = new Serializer($normalizers, $encoders);

$data = [$mugi, $sora];

$csv = $serializer->serialize($mugi, 'csv');
$json = $serializer->serialize($mugi, 'json');

echo $csv;
echo "---\n";
echo $json;

// output
// id,name,image_url,gender,weight
// 1,Mugi,mugi.jpg,Female,1.8
// ---
// {"id":1,"name":"Mugi","image_url":"mugi.jpg","gender":"Female","weight":1.8}
