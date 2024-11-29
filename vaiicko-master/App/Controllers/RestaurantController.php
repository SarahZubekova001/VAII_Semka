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
            // Načítaj existujúcu reštauráciu podľa ID
            $restaurant = Restaurant::getOne($id);
            if (!$restaurant) {
                throw new \Exception("Reštaurácia nenájdená");
            }
            $oldFileName = $restaurant->getImagePath();
        } else {
            // Ak ID nie je zadané, ide o nový príspevok
            $restaurant = new Restaurant();
        }

        // Nastav údaje pre reštauráciu
        $restaurant->setName($this->request()->getValue('name'));
        $restaurant->setAddress($this->request()->getValue('address'));
        $restaurant->setOpeningHours($this->request()->getValue('opening_hours'));

        if (!empty($this->request()->getFiles()['image']['name'])) {
            // Spracuj nový obrázok
            if ($oldFileName) {
                FileStorage::deleteFile($oldFileName); // Vymaž starý obrázok
            }
            $newFileName = FileStorage::saveFile($this->request()->getFiles()['image']);
            $restaurant->setImagePath($newFileName);
        } elseif ($oldFileName) {
            // Zachovaj existujúci obrázok
            $restaurant->setImagePath($oldFileName);
        } else {
            // Nastav prázdnu hodnotu, ak nie je obrázok
            $restaurant->setImagePath('');
        }

        // Ulož reštauráciu (bude to INSERT alebo UPDATE podľa nastavenia _dbId)
        $restaurant->save();

        return new RedirectResponse($this->url('restaurant.restaurants'));
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
