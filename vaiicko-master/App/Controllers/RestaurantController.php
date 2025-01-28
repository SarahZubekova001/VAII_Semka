<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Models\Restaurant;
use App\Helpers\FileStorage;
use App\Core\DB\Connection;
use App\Models\Address;

class RestaurantController extends AControllerBase
{
    public function index(): Response
    {
        return $this->html(['restaurants' => Restaurant::getAll()]);

    }

    public function add(): Response
    {
        return $this->html();
    }

    /**
     * @throws HTTPException
     * @throws \Exception
     */
    public function store(): Response
    {
        $id = $this->request()->getValue('id');
        $oldImage = null;

        if ($id > 0) {

            $restaurant = Restaurant::getOne($id);
            if (!$restaurant) {
                throw new \Exception("Reštaurácia nenájdená");
            }
            $oldImage = $restaurant->getImagePath();
        } else {
            $restaurant = new Restaurant();
        }

        $restaurant->setName($this->request()->getValue('name'));
        $restaurant->setOpeningHours($this->request()->getValue('opening_hours'));

        $street = $this->request()->getValue('street');
        $city = $this->request()->getValue('city');
        $postalCode = (int)$this->request()->getValue('postal_code');
        $descriptiveNumber = (int)$this->request()->getValue('descriptive_number');

        $address = Address::findOrCreate($street, $city, $postalCode, $descriptiveNumber);

        $restaurant->setAddressId($address->getId());
        $restaurant->setUrlAddress($this->request()->getValue('url_address'));


        $formErrors = $this->formErrors();
        if (count($formErrors) > 0) {
            return $this->html(['errors' => $formErrors, 'restaurant' => $restaurant], $id > 0 ? 'edit' : 'add');
        }
        $phoneNumber = $this->request()->getValue('phone_number');
        if (!is_numeric($phoneNumber)) {
            return $this->html(['errors' => ['Telefonne číslo musí byť číslo!'], 'restaurant' => $restaurant], $id > 0 ? 'edit' : 'add');
        }
        $restaurant->setPhoneNumber((int) $phoneNumber);


        $imageFile = $this->request()->getFiles()['image'] ?? null;

        if (!empty($imageFile['name']) && is_string($imageFile['tmp_name'])) {
            $oldImage = $restaurant->getImagePath();
            if ($oldImage) {
                FileStorage::deleteFile($oldImage->getPath());
                $oldImage->delete();
            }

            $newFileName = FileStorage::saveFile($imageFile);
            $restaurant->setImagePath($newFileName);
        }


        $restaurant->save();
        if (count($formErrors) > 0) {
            // Ak sú chyby, vráť používateľovi formulár s chybami
            return $this->html(['errors' => $formErrors, 'restaurant' => $restaurant], $id > 0 ? 'edit' : 'add');
        }

        return new RedirectResponse($this->url('restaurant.restaurants'));
    }

    private function formErrors(): array
    {
        $errors = [];
        $allowedMimeTypes = ['image/jpeg', 'image/png'];

        $imageFile = $this->request()->getFiles()['image'] ?? null;
        if (!empty($imageFile['name'])) {
            if (!in_array($imageFile['type'], $allowedMimeTypes)) {
                $errors[] = "Obrázok musí byť vo formáte JPG alebo PNG!";
            }
        }
        if ($imageFile['size'] > 5 * 1024 * 1024) { // 16 MB v bajtoch
            $errors[] = "Obrázok je príliš veľký! Maximálna povolená veľkosť je 16 MB.";
        }

        if (empty($this->request()->getValue('name'))) {
            $errors[] = "Pole Názov musí byť vyplnené!";
        }
        if (empty($this->request()->getValue('opening_hours'))) {
            $errors[] = "Otváracie hodiny musia byť vyplnené!";
        }
        if (empty($this->request()->getValue('phone_number'))) {
            $errors[] = "Telefonne číslo musí byť vyplnené!";
        }
        if (!is_numeric($this->request()->getValue('phone_number'))) {
            $errors[] = "Telefonne číslo musí byť číslo!";
        }
        if (!$imageFile || empty($imageFile['name'])) {
            $errors[] = "Obrázok musí byť vyplnený!";
        }
        if (empty($this->request()->getValue('street'))) {
            $errors[] = "Ulica musí byť vyplnená!";
        }
        if (empty($this->request()->getValue('city'))) {
            $errors[] = "Mesto musí byť vyplnené!";
        }
        if (empty($this->request()->getValue('postal_code'))) {
            $errors[] = "PSČ musí byť vyplnené!";
        }
        if (!is_numeric($this->request()->getValue('postal_code'))) {
            $errors[] = "PSČ musí byť číslo!";
        }
        if (empty($this->request()->getValue('descriptive_number'))) {
            $errors[] = "Popisne číslo musí byť vyplnené!";
        }
        if (!is_numeric($this->request()->getValue('postal_code'))) {
            $errors[] = "PSČ musí byť číslo!";
        }
        if (empty($this->request()->getValue('url_address'))) {
            $errors[] = "Webová stránka musí byť vyplnená!";
        }

        return $errors;
    }


    public function detail(): Response
    {
        $id = $this->request()->getValue('id');
        $restaurant = Restaurant::getOne($id);

        if (!$restaurant) {
            throw new \Exception("Reštaurácia nenájdená");
        }

        return $this->html(['restaurant' => $restaurant]);
    }
    public function restaurants(): Response
    {
        $restaurants = Restaurant::getAll();
        return $this->html(['restaurants' => $restaurants]);
    }
    public function edit(): Response
    {
        $id = $this->request()->getValue('id');
        $restaurant = Restaurant::getOne($id);

        if (!$restaurant) {
            throw new \Exception("Reštaurácia nenájdená");
        }

        $address = $restaurant->getAddressDetails();

        return $this->html([
            'restaurant' => $restaurant,
            'address' => $address
        ]);
    }
    public function delete(): Response
    {
        $id = $this->request()->getValue('id');
        $restaurant = Restaurant::getOne($id);

        if (is_null($restaurant)) {
            throw new HTTPException(404);
        } else {
            $image = $restaurant->getImagePath();
            if ($image) {
                FileStorage::deleteFile($image->getPath());
                $image->delete();
            }
            $restaurant->delete();
            return new RedirectResponse($this->url('restaurant.restaurants'));
        }
    }
    public function filter(): Response
    {
        $query = $this->request()->getValue('query');
        $restaurants = [];

        if (!empty($query)) {
            $restaurants = Restaurant::getAll("name LIKE ?", ["%$query%"]);
        } else {
            $restaurants = Restaurant::getAll();
        }

        return $this->html(['restaurants' => $restaurants], 'partial');
    }

}
