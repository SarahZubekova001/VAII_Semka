<?php

namespace App\Models;

use App\Core\Model;

class Restaurant extends Model
{
    protected ?int $id = null;
    protected ?string $name;
    protected ?string $image_path;
    protected ?string $address;
    protected ?string $opening_hours;
    protected ?string $author;
    protected ?int $phone_number;
    protected static string $tableName = 'restaurants';

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getImagePath(): ?string
    {
        return $this->image_path;
    }

    public function setImagePath(string $image_path): void
    {
        $this->image_path = $image_path;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getOpeningHours(): ?string
    {
        return $this->opening_hours;
    }

    public function setOpeningHours(string $opening_hours): void
    {
        $this->opening_hours = $opening_hours;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }
    public function getPhoneNumber(): ?int
    {
        return $this->phone_number;
    }
    public function setPhoneNumber(int $phone_number): void
    {
        $this->phone_number = $phone_number;
    }

}
