<?php

namespace App\Models;

use App\Core\Model;

class Post extends Model
{
    protected ?int $id = null;
    protected ?string $name = null;
    protected ?string $description = null;
    protected ?string $season = null; // "Summer" alebo "Winter"
    protected ?string $category = null; // "Activity", "Relax" alebo "Sport"
    protected ?int $id_address = null;
    protected ?string $opening_hours = null;
    protected static string $tableName = 'posts';

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getSeason(): ?string
    {
        return $this->season;
    }

    public function setSeason(string $season): void
    {
        $this->season = $season;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function getIdAddress(): ?int
    {
        return $this->id_address;
    }

    public function setIdAddress(?int $id_address): void
    {
        $this->id_address = $id_address;
    }

    public function getOpeningHours(): ?string
    {
        return $this->opening_hours;
    }

    public function setOpeningHours(?string $opening_hours): void
    {
        $this->opening_hours = $opening_hours;
    }

    /**
     * Získanie adresy priradenej k príspevku
     *
     * @return Address|null
     * @throws \Exception
     */
    public function getAddressDetails(): ?Address
    {
        return $this->id_address ? Address::getOne($this->id_address) : null;
    }

    /**
     * Získanie všetkých obrázkov priradených k príspevku
     *
     * @return Image[]
     * @throws \Exception
     */
    public function getImages(): array
    {
        return Image::getAll("post_id = ?", [$this->id]);
    }
}
