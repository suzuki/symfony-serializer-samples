<?php

namespace App\Repository;

use App\Model\v000\Cat as Cat000;
use App\Model\v101\Cat as Cat101;
use App\Model\v102\Cat as Cat102;
use App\Model\v103\Cat as Cat103;
use App\Model\v104\Cat as Cat104;
use App\Model\v105\Cat as Cat105;
use App\Model\v200\Cat as Cat200;
use App\Model\v300\Cat as Cat300;
use App\Model\v400\Cat as Cat400;
use App\Model\v500\Cat as Cat500;

final class CatRepository
{
    /**
     * @var array<Cat000|Cat101|Cat102|Cat103|Cat104|Cat105|Cat200|Cat300|Cat400|Cat500>
     */
    private array $cats = [];

    public function __construct(
        private string $className,
    ) {
        $this->initialize();
    }

    public function find(int $id): Cat000|Cat101|Cat102|Cat103|Cat104|Cat105|Cat200|Cat300|Cat400|Cat500|null
    {
        return $this->cats[$id] ?? null;
    }

    /**
     * @return \Generator<Cat000|Cat101|Cat102|Cat103|Cat104|Cat105|Cat200|Cat300|Cat400|Cat500>
     */
    public function iterateAll(): \Generator
    {
        foreach ($this->cats as $cat) {
            yield $cat;
        }
    }

    private function initialize(): void
    {
        $data = [
            ['id' => 1, 'name' => 'Mugi', 'imageUrl' => 'mugi.jpg', 'gender' => 'Female', 'weight' => 1.8],
            ['id' => 2, 'name' => 'Sora', 'imageUrl' => 'sora.jpg', 'gender' => 'Male',   'weight' => 2.4],
            ['id' => 3, 'name' => 'Leo',  'imageUrl' => 'leo.jpg',  'gender' => 'Male',   'weight' => 2.2],
            ['id' => 4, 'name' => 'Coco', 'imageUrl' => 'coco.jpg', 'gender' => 'Female', 'weight' => 3.1],
        ];

        foreach ($data as $d) {
            /** @var Cat000|Cat101|Cat102|Cat103|Cat104|Cat105|Cat200|Cat300|Cat400|Cat500 $cat */
            $cat = (new $this->className());
            $cat
                ->setId($d['id'])
                ->setName($d['name'])
                ->setImageUrl($d['imageUrl'])
                ->setGender($d['gender'])
                ->setWeight($d['weight']);

            $this->cats[$cat->getId()] = $cat;
        }
    }
}
