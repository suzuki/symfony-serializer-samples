<?php

declare(strict_types=1);

namespace App\Model\v000;

use PHPUnit\Framework\TestCase;

final class CatTest extends TestCase
{
    public function testBase(): void
    {
        $cat = (new Cat())
            ->setId(1)
            ->setName('Mugi')
            ->setImageUrl('mugi.jpg')
            ->setGender('Female')
            ->setWeight(1.8);

        $this->assertSame(1, $cat->getId());
        $this->assertSame('Mugi', $cat->getName());
        $this->assertSame('mugi.jpg', $cat->getImageUrl());
        $this->assertSame('Female', $cat->getGender());
        $this->assertSame(1.8, $cat->getWeight());
    }
}
