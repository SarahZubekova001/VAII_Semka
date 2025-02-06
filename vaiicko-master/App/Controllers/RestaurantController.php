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
        if (!$this->app->getAuth()->isLogged()) {
            return $this->redirect($this->url('auth.loginForm'));
        }
        return $this->html();
    }

    public function store(): Response
    {
        if (!$this->app->getAuth()->isLogged()) {
            return $this->redirect($this->url('auth.loginForm'));
        }

        $id = $this->request()->getValue('id');
        $restaurant = $id ? Restaurant::getOne($id) : new Restaurant();

        if ($id && !$restaurant) {
            throw new \Exception("Reštaurácia nenájdená");
        }

        $errors = $this->validateForm();
        if (!empty($errors)) {
            return $this->html(['errors' => $errors, 'restaurant' => $restaurant], $id ? 'edit' : 'add');
        }

        $restaurant->setName($this->request()->getValue('name'));
        $restaurant->setOpeningHours($this->request()->getValue('opening_hours'));
        $restaurant->setPhoneNumber($this->request()->getValue('phone_number'));
        $restaurant->setUrlAddress($this->request()->getValue('url_address'));

        $address = Address::findOrCreate(
            $this->request()->getValue('street'),
            $this->request()->getValue('city'),
            $this->request()->getValue('postal_code'),
            $this->request()->getValue('descriptive_number')
        );
        $restaurant->setAddressId($address->getId());


        $imageFile = $this->request()->getFiles()['image'] ?? null;
        $allowedMimeTypes = ['image/jpeg', 'image/png'];

        if (!empty($imageFile['tmp_name']) && is_string($imageFile['tmp_name'])) {
            $fileMimeType = mime_content_type($imageFile['tmp_name']);
            if (in_array($fileMimeType, $allowedMimeTypes)) {
                if ($oldImage = $restaurant->getImagePath()) {
                    FileStorage::deleteFile($oldImage->getPath());
                }
                $newFileName = FileStorage::saveFile($imageFile);
                $restaurant->setImagePath($newFileName);
            }
        }

        $restaurant->save();
        return new RedirectResponse($this->url('restaurant.restaurants'));
    }

    private function validateForm(): array
    {
        $errors = [];
        $requiredFields = ['name', 'opening_hours', 'phone_number', 'street', 'city', 'postal_code', 'url_address'];

        foreach ($requiredFields as $field) {
            if (empty($this->request()->getValue($field))) {
                $errors[] = "Pole '$field' musí byť vyplnené!";
            }
        }



        $postalCode = $this->request()->getValue('postal_code');
        if (!is_numeric($postalCode)) {
            $errors[] = "PSČ musí byť číslo!";
        } elseif ($postalCode < 1 || $postalCode > 2147483647) {
            $errors[] = "Popisné číslo je príliš veľke";
        }

        $descriptiveNumber = $this->request()->getValue('descriptive_number');
        if (!is_numeric($descriptiveNumber)) {
            $errors[] = "Popisné číslo musí byť číslo!";
        } elseif ($descriptiveNumber < 1 || $descriptiveNumber > 2147483647) {
            $errors[] = "Popisné číslo je príliš veľke";
        }
        $telephone = $this->request()->getValue('phone_number');
        if (!is_numeric($telephone)) {
            $errors[] = "Telefónne číslo musí byť číslo!";
        } elseif ($telephone < 1 || $telephone > 2147483647) {
            $errors[] = "Telefónne číslo je príliš veľke";
        }

        $allowedMimeTypes = ['image/jpeg', 'image/png'];
        $imageFiles = $this->request()->getFiles()['image'] ?? [];

        if (isset($imageFiles['tmp_name'])) {
            if (is_array($imageFiles['tmp_name'])) {
                foreach ($imageFiles['tmp_name'] as $tmpName) {
                    if (!empty($tmpName)) {
                        $fileMimeType = mime_content_type($tmpName);
                        if (!in_array($fileMimeType, $allowedMimeTypes)) {
                            $errors[] = "Obrázok musí byť vo formáte JPG alebo PNG!";
                        }
                    }
                }
            } elseif (!empty($imageFiles['tmp_name'])) {
                $fileMimeType = mime_content_type($imageFiles['tmp_name']);
                if (!in_array($fileMimeType, $allowedMimeTypes)) {
                    $errors[] = "Obrázok musí byť vo formáte JPG alebo PNG!";
                }
            }
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
        if (!$this->app->getAuth()->isLogged()) {
            return $this->redirect($this->url('auth.loginForm'));
        }
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
        if (!$this->app->getAuth()->isLogged()) {
            return $this->redirect($this->url('auth.loginForm'));
        }
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
