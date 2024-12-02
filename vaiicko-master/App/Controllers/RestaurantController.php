<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Models\Restaurant;
use App\Helpers\FileStorage;
use App\Core\DB\Connection;

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
     */
    public function store(): Response
    {
        $id = $this->request()->getValue('id'); // Získaj ID z požiadavky
        $oldFileName = null;

        if ($id > 0) {

            $restaurant = Restaurant::getOne($id);
            if (!$restaurant) {
                throw new \Exception("Reštaurácia nenájdená");
            }
            $oldFileName = $restaurant->getImagePath(); // Získaj cestu k starému obrázku
        } else {
            $restaurant = new Restaurant();
        }

        $restaurant->setName($this->request()->getValue('name'));
        $restaurant->setAddress($this->request()->getValue('address'));
        $restaurant->setOpeningHours($this->request()->getValue('opening_hours'));


        $formErrors = $this->formErrors();
        if (count($formErrors) > 0) {
            // Ak sú chyby, vráť používateľovi formulár s chybami
            return $this->html(['errors' => $formErrors, 'restaurant' => $restaurant], $id > 0 ? 'edit' : 'add');
        }


        $imageFile = $this->request()->getFiles()['image'] ?? null;
        if (!empty($imageFile['name'])) {

            if ($oldFileName) {
                FileStorage::deleteFile($oldFileName);
            }
            $newFileName = FileStorage::saveFile($imageFile);
            $restaurant->setImagePath($newFileName);
        } elseif ($id > 0) {
            $restaurant->setImagePath($oldFileName);
        } else {
            // Nastav prázdnu hodnotu, ak nejde o úpravu a obrázok nebol nahraný
            $restaurant->setImagePath('');
        }

        $restaurant->save();

        return new RedirectResponse($this->url('restaurant.restaurants'));
    }



    private function formErrors(): array
    {
        $errors = [];
        $allowedMimeTypes = ['image/jpeg', 'image/png'];

        $imageFile = $this->request()->getFiles()['image'] ?? null;

        if (!empty($imageFile['name'])) {
            // Kontrola MIME typu
            if (!in_array($imageFile['type'], $allowedMimeTypes)) {
                $errors[] = "Obrázok musí byť vo formáte JPG alebo PNG!";
            }
        }

        if (empty($this->request()->getValue('name'))) {
            $errors[] = "Pole Názov musí byť vyplnené!";
        }
        if (empty($this->request()->getValue('address'))) {
            $errors[] = "Adresa musí byť vyplnená!";
        }
        if (empty($this->request()->getValue('opening_hours'))) {
            $errors[] = "Otváracie hodiny musia byť vyplnené!";
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
        return $this->html(
            [
                'restaurants' => Restaurant::getAll()
            ]
        );
    }
    public function edit(): Response
    {
        $id = $this->request()->getValue('id');
        $restaurant = Restaurant::getOne($id);

        if (!$restaurant) {
            throw new \Exception("Reštaurácia nenájdená");
        }

        return $this->html(['restaurant' => $restaurant]);
    }
    public function delete(): Response
    {
        $id = $this->request()->getValue('id');
        $restaurant = Restaurant::getOne($id);

        if (is_null($restaurant)) {
            throw new HTTPException(404);
        } else {
            FileStorage::deleteFile($restaurant->getImagePath());
            $restaurant->delete();
            return new RedirectResponse($this->url('restaurant.restaurants'));
        }
    }


}
