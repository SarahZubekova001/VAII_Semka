<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Models\Gallery;
use App\Models\Post;
use Exception;

class GalleryController extends AControllerBase
{
    /**
     * Zobrazenie galérie pre konkrétny príspevok
     * @return Response
     * @throws Exception
     */
    public function index(): Response
    {
        $postId = $this->request()->getValue('post_id');
        if (!$postId) {
            throw new HTTPException(400, "Chýbajúce ID príspevku");
        }

        $post = Post::getOne($postId);
        if (!$post) {
            throw new HTTPException(404, "Príspevok nenájdený");
        }

        $gallery = $post->getGallery();

        return $this->html(['post' => $post, 'gallery' => $gallery], 'gallery/index');
    }

    /**
     * Pridanie nových obrázkov do galérie
     * @return Response
     * @throws Exception
     */
    public function add(): Response
    {
        $postId = $this->request()->getValue('post_id');
        if (!$postId) {
            throw new HTTPException(400, "Chýbajúce ID príspevku");
        }

        $post = Post::getOne($postId);
        if (!$post) {
            throw new HTTPException(404, "Príspevok nenájdený");
        }

        $imageFiles = $this->request()->getFiles()['gallery'] ?? null;

        if ($imageFiles && is_array($imageFiles['name'])) {
            foreach ($imageFiles['name'] as $index => $name) {
                if (!empty($name)) {
                    $tmpPath = $imageFiles['tmp_name'][$index];
                    $newFileName = FileStorage::saveFile(['name' => $name, 'tmp_name' => $tmpPath]);
                    $post->addImageToGallery($newFileName);
                }
            }
        }

        return new RedirectResponse($this->url('gallery.index', ['post_id' => $postId]));
    }

    /**
     * Vymazanie obrázku z galérie
     * @return Response
     * @throws Exception
     */
    public function delete(): Response
    {
        $imageId = $this->request()->getValue('id');
        if (!$imageId) {
            throw new HTTPException(400, "Chýbajúce ID obrázku");
        }

        $galleryItem = Gallery::getOne($imageId);
        if (!$galleryItem) {
            throw new HTTPException(404, "Obrázok nenájdený");
        }

        $postId = $galleryItem->getPostId();

        // Vymazanie súboru zo servera
        FileStorage::deleteFile($galleryItem->getPath());

        // Vymazanie záznamu z databázy
        $galleryItem->delete();

        return new RedirectResponse($this->url('gallery.index', ['post_id' => $postId]));
    }
}
