<?php

declare(strict_types=1);

use App\Encoder\TinyTomlEncoder;
use App\Model\v500\Cat;
use App\Repository\CatRepository;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

require_once __DIR__ . '/../../vendor/autoload.php';

$repo = new CatRepository(Cat::class);
$mugi = $repo->find(1);

$classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
$metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);

$normalizers = [new ObjectNormalizer($classMetadataFactory, $metadataAwareNameConverter)];
$encoders = [new TinyTomlEncoder()];

$serializer = new Serializer($normalizers, $encoders);

$toml = <<<TOML
id = 1
name = "Mugi"
image_url = "mugi.jpg"
gender = "Female"
weight = 1.8'
TOML;

$object = $serializer->deserialize($toml, Cat::class, 'toml');

print_r($object);

// output
// App\Model\v500\Cat Object
// (
//     [id:App\Model\v500\Cat:private] => 1
//     [name:App\Model\v500\Cat:private] => Mugi
//     [imageUrl:App\Model\v500\Cat:private] => mugi.jpg
//     [gender:App\Model\v500\Cat:private] => Female
//     [weight:App\Model\v500\Cat:private] => 1.8
// )
