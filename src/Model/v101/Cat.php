<?php

declare(strict_types=1);

namespace App\Model\v101;

final class Cat
{
    private int $id;

    private string $name;

    private string $imageUrl;

    private string $gender;

    private ?float $weight = null;

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }
}
