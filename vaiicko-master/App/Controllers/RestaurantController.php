<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Models\Restaurant;
use App\Helpers\FileStorage;

class RestaurantController extends AControllerBase
{
        public function index(): Response
    {
        $restaurants = Restaurant::getAll(); // Načítanie všetkých reštaurácií
        var_dump($restaurants); // Debug: výpis reštaurácií
        die(); // Ukončenie vykonávania
        return $this->html(['restaurants' => $restaurants], 'Restaurant/restaurants');
    }


    public function add(): Response
    {
        return $this->html([], 'add');
    }

    public function store(): Response
    {
        var_dump("Entering store() method"); // Debug
        $id = $this->request()->getValue('id');
        $oldFileName = "";

        // Kontrola, či je ID nastavené
        if ($id > 0) {
            $restaurant = Restaurant::getOne($id);
            $oldFileName = $restaurant->getImagePath();
        } else {
            $restaurant = new Restaurant();
            var_dump("Creating new Restaurant object"); // Debug
            $restaurant->setAuthor($this->app->getAuth()->getLoggedUserName());
        }

        // Nastavujeme hodnoty do objektu
        $restaurant->setName($this->request()->getValue('name'));
        $restaurant->setAddress($this->request()->getValue('address'));
        $restaurant->setOpeningHours($this->request()->getValue('opening_hours'));
        $restaurant->setImagePath($this->request()->getFiles()['image']['name']);

        var_dump("Restaurant object before validation", $restaurant); // Debug

        // Validácia údajov
        $formErrors = $this->formErrors();

        if (count($formErrors) > 0) {
            var_dump("Form errors", $formErrors); // Debug
            return $this->html(['errors' => $formErrors, 'restaurants' => $restaurant], 'add');
        } else {
            if ($oldFileName != "") {
                var_dump("Deleting old file: " . $oldFileName); // Debug
                FileStorage::deleteFile($oldFileName);
            }
            // Uloženie nového súboru
            $newFileName = FileStorage::saveFile($this->request()->getFiles()['image']);
            $restaurant->setImagePath($newFileName);

            var_dump("Before saving restaurant to DB", $restaurant); // Debug

            // Pokus o uloženie do DB
            try {
                $restaurant->save();
                var_dump("Restaurant saved successfully"); // Debug
            } catch (\Exception $e) {
                var_dump("Error while saving to DB", $e->getMessage()); // Debug
                throw $e;
            }

            return new RedirectResponse($this->url('restaurant.index'));
        }
    }

    private function formErrors(): array
    {
        $errors = [];
        if (empty($this->request()->getFiles()['image']['name'])) {
            $errors[] = "Pole Súbor obrázka musí byť vyplnené!";
        }
        if (empty($this->request()->getValue('name'))) {
            $errors[] = "Pole Názov musí byť vyplnené!";
        }
        if (!empty($this->request()->getFiles()['image']['name']) &&
            !in_array($this->request()->getFiles()['image']['type'], ['image/jpeg', 'image/png'])) {
            $errors[] = "Obrázok musí byť typu JPG alebo PNG!";
        }
        if (empty($this->request()->getValue('address'))) {
            $errors[] = "Adresa musí byť vyplnená!";
        }
        if (empty($this->request()->getValue('opening_hours'))) {
            $errors[] = "Otváracie hodiny musia byť vyplnené!";
        }
        return $errors;
    }




//        $restaurant = new Restaurant();
//        $restaurant->setName($this->request()->getValue('name'));
//        $restaurant->setAddress($this->request()->getValue('address'));
//        $restaurant->setOpeningHours($this->request()->getValue('opening_hours'));
//
//        if ($this->request()->getFiles()['image']['name']) {
//            $filePath = \App\Helpers\FileStorage::saveFile($this->request()->getFiles()['image']);
//            $restaurant->setImagePath($filePath);
//        }
//
//        $restaurant->save();
//        return $this->redirect($this->url('restaurant.index'));


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
        return $this->html(
            [
                'restaurants' => Restaurant::getAll()
            ]
        );
    }
}
