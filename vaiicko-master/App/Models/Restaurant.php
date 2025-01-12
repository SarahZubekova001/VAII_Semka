<?php

namespace App\Models;

use App\Core\Model;

class Restaurant extends Model
{
    protected ?int $id = null;
    protected ?string $name;
    protected ?int $id_address = null;
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

    public function getImagePath(): ?Image
    {
        $images = Image::getAll("restaurant_id  = ?", [$this->id]);
        return end($images) ?: null;
    }


    public function setImagePath(string $path): void {
        $existingImage = $this->getImagePath();
        if ($existingImage) {
            $existingImage->delete();
        }

        // Pridaj nový obrázok
        $image = new Image();
        $image->setPath($path);
        $image->setRestaurant($this);
        $image->save();
    }


    public function getAddressId(): ?int
    {
        return $this->id_address;
    }

    public function setAddressId(?int $id): void
    {
        $this->id_address = $id;
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
    public function getAddressDetails(): ?Address
    {
        return Address::getOne($this->id_address);
    }

    public static function filterByName(string $query): array
    {
        $likeQuery = '%' . $query . '%';
        return self::getAll("name LIKE ?", [$likeQuery]);
    }

}
