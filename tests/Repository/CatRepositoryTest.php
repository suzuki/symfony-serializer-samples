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
use PHPUnit\Framework\TestCase;

final class CatRepositoryTest extends TestCase
{
    /**
     * @dataProvider catModelProvider
     */
    public function testFind(string $model_class): void
    {
        $repo = new CatRepository($model_class);

        $cat = $repo->find(1);

        if (null === $cat) {
            $this->fail('Unexpected value of null');
        }

        $this->assertSame(1, $cat->getId());
        $this->assertSame('Mugi', $cat->getName());
        $this->assertSame('mugi.jpg', $cat->getImageUrl());
        $this->assertSame('Female', $cat->getGender());
        $this->assertSame(1.8, $cat->getWeight());

        $unknown_cat = $repo->find(0);
        $this->assertNull($unknown_cat);
    }

    public function testIterateAll(): void
    {
        $repo = new CatRepository(Cat000::class);

        $idList = [];
        foreach ($repo->iterateAll() as $cat) {
            $idList[] = $cat->getId();
        }
        sort($idList);

        $this->assertSame([1, 2, 3, 4], $idList);
    }

    /**
     * @return array<array<string>>
     */
    public function catModelProvider(): array
    {
        return [
            [Cat000::class],
            [Cat101::class],
            [Cat102::class],
            [Cat103::class],
            [Cat104::class],
            [Cat105::class],
            [Cat200::class],
            [Cat300::class],
            [Cat400::class],
            [Cat500::class],
        ];
    }
}
