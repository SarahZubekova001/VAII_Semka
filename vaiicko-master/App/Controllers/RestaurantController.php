<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Restaurant;

class RestaurantController extends AControllerBase
{
    public function index(): Response
    {

    }

    public function add(): Response
    {
        return $this->html([], 'add');
    }

    public function store(): Response
    {
        $restaurant = new Restaurant();
        $restaurant->setName($this->request()->getValue('name'));
        $restaurant->setAddress($this->request()->getValue('address'));
        $restaurant->setOpeningHours($this->request()->getValue('opening_hours'));

        if ($this->request()->getFiles()['image']['name']) {
            $filePath = \App\Helpers\FileStorage::saveFile($this->request()->getFiles()['image']);
            $restaurant->setImagePath($filePath);
        }

        $restaurant->save();
        return $this->redirect($this->url('restaurant.index'));
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
}
