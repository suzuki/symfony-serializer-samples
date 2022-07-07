<?php
declare(strict_types=1);

namespace App\Model;

use DateTimeImmutable;
use App\Enum\Gender;

final class Cat
{
    private int $id;

    private string $name;

    private Gender $gender = Gender::Unknown;

    private ?float $weight = null;

    private ?DateTimeImmutable $birthDay = null;

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

    public function setGender(Gender $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getGender(): Gender
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

    public function setBirthDay(?DateTimeImmutable $birthDay): self
    {
        $this->birthDay = $birthDay;

        return $this;
    }

    public function getBirthDay(): ?DateTimeImmutable
    {
        return $this->birthDay;
    }
}
