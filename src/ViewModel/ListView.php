<?php

declare(strict_types=1);

namespace App\ViewModel;

use App\Model\v000\Cat;

final class ListView implements \JsonSerializable
{
    public function __construct(
        private Cat $cat,
    ) {
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->cat->getId(),
            'name' => $this->cat->getName(),
            'image_url' => $this->cat->getImageUrl(),
        ];
    }
}
