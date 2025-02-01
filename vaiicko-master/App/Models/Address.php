<?php

namespace App\Models;

class Address extends \App\Core\Model {
    protected ?int $id_address = null;
    protected ?string $street ;
    protected ?string $city = null;
    protected ?int $postal_code = null;
    protected ?int $descriptive_number = null;

    protected static string $tableName = 'addresses';


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
        return $this->id_address;
    }

    public function setId(int $id): void
    {
        $this->id_address = $id;
    }


    /**
     * @throws \Exception
     */
    /**
     * @throws \Exception
     */
    public static function findOrCreate(string $street, string $city, int $postalCode, int $descriptive_number): Address
    {
        // Hľadanie existujúcej adresy
        $existingAddresses = self::getAll("street = ? AND city = ? AND postal_code = ? AND descriptive_number = ?", [
            $street, $city, $postalCode, $descriptive_number
        ]);

        // Ak existuje, vráťte prvú nájdenú adresu
        if (!empty($existingAddresses)) {
            return $existingAddresses[0];
        }

        // Ak neexistuje, vytvorte novú
        $newAddress = new self();
        $newAddress->setStreet($street);
        $newAddress->setCity($city);
        $newAddress->setPostalCode($postalCode);
        $newAddress->setDescriptiveNumber($descriptive_number);


        $newAddress->save();
        if (!$newAddress->getId()) {
            throw new \Exception("Failed to generate primary key for address.");
        }

        return $newAddress;
    }




    public function getDescriptiveNumber(): ?int
    {
        return $this->descriptive_number;
    }

    public function setDescriptiveNumber(?int $descriptive_number): void
    {
        $this->descriptive_number = $descriptive_number;
    }
    public static function getPkColumnName(): string
    {
        return 'id';
    }
    public function __get(string $name)
    {
        if ($name === 'id') {
            error_log("Accessing alias for id_address: " . $this->id_address);
            return $this->id_address;
        }

        throw new \Exception("Attribute `$name` doesn't exist in the model " . get_called_class() . ".");
    }

    public function __set(string $name, $value): void
    {
        if ($name === 'id') {
            error_log("Setting alias for id_address to: " . $value);
            $this->id_address = $value;
            return;
        }

        throw new \Exception("Attribute `$name` doesn't exist in the model " . get_called_class() . ".");
    }


}
