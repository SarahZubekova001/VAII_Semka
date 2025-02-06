<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Address;
use Exception;

class AddressController extends AControllerBase
{
    public function index(): Response
    {
        return $this->html(['address' => Address::getAll()]);
    }

    /**
     * @throws Exception
     */
    public function store(): Response
    {
        $street = $this->request()->getValue('street');
        $city = $this->request()->getValue('city');
        $postalCode = $this->request()->getValue('postal_code');
        $descriptiveNumber = $this->request()->getValue('descriptive_number');

        $data = [$street, $city, $postalCode, $descriptiveNumber];

        if (in_array(null, array_map('trim', $data), true)) {
            throw new Exception("All address fields are required.", 400);
        }

        $address = Address::findOrCreate($street, $city, (int)$postalCode, (int)$descriptiveNumber);
        return $this->html(['address' => $address]);

    }

}