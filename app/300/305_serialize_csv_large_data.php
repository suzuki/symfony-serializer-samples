<?php

declare(strict_types=1);

use App\Model\v300\Cat;
use App\Repository\CatRepository;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

require_once __DIR__ . '/../../vendor/autoload.php';

$repo = new CatRepository(Cat::class);

$classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
$metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);

$normalizers = [new ObjectNormalizer($classMetadataFactory, $metadataAwareNameConverter)];
$encoders = [new CsvEncoder()];
$serializer = new Serializer($normalizers, $encoders);

$file = fopen('php://temp', 'w');
if (false === $file) {
    die;
}

$header = "id,name,image_url,gender,weight\n";
fwrite($file, $header);

foreach ($repo->iterateAll() as $cat) {
    $csv = $serializer->serialize($cat, 'csv', [
        CsvEncoder::NO_HEADERS_KEY => true,
    ]);
    fwrite($file, $csv);
}

fseek($file, 0);
while ($line = fgets($file)) {
    echo $line;
}

// output
// id,name,image_url,gender,weight
// 1,Mugi,mugi.jpg,Female,1.8
// 2,Sora,sora.jpg,Male,2.4
// 3,Leo,leo.jpg,Male,2.2
// 4,Coco,coco.jpg,Female,3.1
