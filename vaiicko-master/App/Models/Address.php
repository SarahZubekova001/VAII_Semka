<?php

namespace App\Models;

use App\Core\Model;
use Exception;

class Address extends Model
{
    protected ?int $id = null;
    protected ?string $street = null;
    protected ?string $city = null;
    protected ?int $postal_code = null;
    protected ?int $descriptive_number = null;

    //protected static string $tableName = 'addresses';

    public function getPostalCode(): int
    {
        return $this->postal_code;
    }

    public function setPostalCode(int $postal_code): void
    {
        $this->postal_code = $postal_code;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDescriptiveNumber(): ?int
    {
        return $this->descriptive_number;
    }

    public function setDescriptiveNumber(?int $descriptive_number): void
    {
        $this->descriptive_number = $descriptive_number;
    }

    public static function findOrCreate(string $street, string $city, int $postalCode, int $descriptiveNumber): Address
    {
        $existingAddresses = self::getAll(
            "street = ? AND city = ? AND postal_code = ? AND descriptive_number = ?",
            [$street, $city, $postalCode, $descriptiveNumber]
        );

        if (!empty($existingAddresses)) {
            return $existingAddresses[0];
        }

        $newAddress = new self();
        $newAddress->setStreet($street);
        $newAddress->setCity($city);
        $newAddress->setPostalCode($postalCode);
        $newAddress->setDescriptiveNumber($descriptiveNumber);
        $newAddress->save();

        if (!$newAddress->getId()) {
            throw new Exception("Failed to generate primary key for address.", 500);
        }

        return $newAddress;
    }
}
