<?php

declare(strict_types=1);

namespace App\ViewModel;

use App\Model\v000\Cat;
use PHPUnit\Framework\TestCase;

final class DetailViewTest extends TestCase
{
    public function testBase(): void
    {
        $cat = (new Cat())
            ->setId(1)
            ->setName('Mugi')
            ->setImageUrl('mugi.jpg')
            ->setGender('Female')
            ->setWeight(1.8);

        $model = new DetailView($cat);

        $data = $model->jsonSerialize();

        if (!is_array($data)) {
            $this->fail('Unexpected serialize');
        }

        $this->assertSame(1, $data['id']);
        $this->assertSame('Mugi', $data['name']);
        $this->assertSame('mugi.jpg', $data['image_url']);
        $this->assertSame('Female', $data['gender']);
        $this->assertSame(1.8, $data['weight']);

        $this->assertSame('{"id":1,"name":"Mugi","image_url":"mugi.jpg","gender":"Female","weight":1.8}', json_encode($model));
    }
}
