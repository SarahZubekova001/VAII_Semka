<?php
namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Helpers\FileStorage;
use App\Models\Post;
class PostController extends AControllerBase {

    public function index(): Response
    {
        return $this->html(['posts' => Post::getAll()]);
    }
    public function detail(): Response
    {
        $id = $this->request()->getValue('id');
        $post = Post::getOne($id);

        if (!$post) {
            throw new HTTPException(404, "Príspevok nenájdený");
        }

        return $this->html(['post' => $post]);
    }

    /**
     * Zobrazenie formulára na pridanie nového príspevku
     * @return Response
     */
    public function add(): Response
    {
        return $this->html();
    }

    /**
     * Uloženie nového alebo aktualizácia existujúceho príspevku
     * @return Response
     * @throws \Exception
     */
    public function store(): Response
    {
        $oldImage = null;
        $id = $this->request()->getValue('id');

        if ($id > 0) {

            $post = Post::getOne($id);
            if (!$post) {
                throw new \Exception("Príspevok  nenájdeny");
            }
            $oldImage = $post->getImagePath(); // Získaj cestu k starému obrázku
        } else {
            $post = new Post();
        }

        $name = $this->request()->getValue('name');
        $description = $this->request()->getValue('description');
        $category = $this->request()->getValue('category');
        $season = $this->request()->getValue('season');
        $id_address = $this->request()->getValue('id_address');
        $opening_hours = $this->request()->getValue('opening_hours');
        //$post = $id ? Post::getOne($id) : new Post();

        if (!$post) {
            throw new HTTPException(404, "Príspevok nenájdený");
        }

        $post->setName($name);
        $post->setDescription($description);
        $post->setCategory($category);
        $post->setSeason($season);
        $post->setIdAddress($id_address);
        $post->setOpeningHours($opening_hours);

        $post->save();

        $imageFile = $this->request()->getFiles()['image'] ?? null;
        if (!empty($imageFile['name'])) {
            if ($oldImage) {
                FileStorage::deleteFile($oldImage->getPath());
            }
            $newFileName = FileStorage::saveFile($imageFile);
            $post->setImagePath($newFileName);
        }


        return new RedirectResponse($this->url('post.activity'));
    }

    /**
     * Zobrazenie formulára na úpravu existujúceho príspevku
     * @return Response
     * @throws \Exception
     */
    public function edit(): Response
    {
        $id = $this->request()->getValue('id');
        $post = Post::getOne($id);

        if (!$post) {
            throw new HTTPException(404, "Príspevok nenájdený");
        }

        return $this->html(['post' => $post]);
    }

    /**
     * Vymazanie príspevku
     * @return Response
     * @throws \Exception
     */
    public function delete(): Response
    {
        $id = $this->request()->getValue('id');
        $post = Post::getOne($id);

        if (!$post) {
            throw new HTTPException(404, "Príspevok nenájdený");
        }

        $post->delete();

        return new RedirectResponse($this->url('post.activity'));
    }
    public function activity(): Response
    {
        $posts = Post::where('category', 'activity');
        return $this->html(['posts' => $posts]);
    }
    public function relax(): Response
    {
        return $this->html();
    }

    public function sport(): Response
    {
        return $this->html();
    }
}
