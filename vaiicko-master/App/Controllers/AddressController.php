<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Address;

class AddressController extends AControllerBase
{
    public function index(): Response
    {
        $address = Address::getAll();
        return $this->html(['address' => $address]);
    }

    /**
     * @throws \Exception
     */
    public function store(): Response
    {
        $street = $this->request()->getValue('street');
        $city = $this->request()->getValue('city');
        $postalCode = $this->request()->getValue('postal_code');
        $descriptiveNumber = $this->request()->getValue('descriptive_number');

        // Kontrola vstupov
        if (empty($street) || empty($city) || empty($postalCode) || empty($descriptiveNumber)) {
            throw new \Exception("All address fields are required: street, city, postal_code, descriptive_number.");
        }

        // Vytvorenie alebo získanie adresy
        $address = Address::findOrCreate($street, $city, (int)$postalCode, (int)$descriptiveNumber);

        if (!$address) {
            throw new \Exception("Address creation or retrieval failed.");
        }

        return $this->html(['address' => $address]);

    }

}