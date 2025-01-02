<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Models\Image;
use App\Helpers\FileStorage;

class ImageController extends AControllerBase
{
    /**
     * Zobrazenie zoznamu obrázkov
     * @return Response
     */
    public function index(): Response
    {
        $images = Image::getAll();
        return $this->html(['images' => $images]);
    }

    /**
     * Zobrazenie detailu konkrétneho obrázka
     * @return Response
     * @throws \Exception
     */
    public function detail(): Response
    {
        $id = $this->request()->getValue('id');
        $image = Image::getOne($id);

        if (!$image) {
            throw new HTTPException(404, "Obrázok nenájdený");
        }

        return $this->html(['image' => $image]);
    }

    /**
     * Pridanie nového obrázka
     * @return Response
     */
    public function add(): Response
    {
        return $this->html();
    }

    /**
     * Uloženie nového alebo aktualizácia existujúceho obrázka
     * @return Response
     * @throws \Exception
     */
    public function store(): Response
    {
        $id = $this->request()->getValue('id');
        $imageFile = $this->request()->getFiles()['image'] ?? null;
        $restaurantId = $this->request()->getValue('restaurant_id');
        $postId = $this->request()->getValue('post_id');
        $image = $id ? Image::getOne($id) : new Image();

        if (!$image) {
            throw new \Exception("Obrázok nenájdený");
        }

        if (!empty($imageFile['name'])) {
            if ($image->getPath()) {
                FileStorage::deleteFile($image->getPath());
            }

            $newFileName = FileStorage::saveFile($imageFile);
            $image->setPath($newFileName);
        }

        $image->setRestaurantId($restaurantId ? (int)$restaurantId : null);
        $image->setPostId($postId ? (int)$postId : null);

        $image->save();

        return new RedirectResponse($this->url('image.index'));
    }

    /**
     * Úprava obrázka
     * @return Response
     * @throws \Exception
     */
    public function edit(): Response
    {
        $id = $this->request()->getValue('id');
        $image = Image::getOne($id);

        if (!$image) {
            throw new HTTPException(404, "Obrázok nenájdený");
        }

        return $this->html(['image' => $image]);
    }

    /**
     * Mazanie obrázka
     * @return Response
     * @throws \Exception
     */
    public function delete(): Response
    {
        $id = $this->request()->getValue('id');
        $image = Image::getOne($id);

        if (!$image) {
            throw new HTTPException(404, "Obrázok nenájdený");
        }

        if ($image->getPath()) {
            FileStorage::deleteFile($image->getPath());
        }

        $image->delete();

        return new RedirectResponse($this->url('image.index'));
    }
}
