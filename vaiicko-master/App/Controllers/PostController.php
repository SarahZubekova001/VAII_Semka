<?php
namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Helpers\FileStorage;
use App\Models\Address;
use App\Models\Post;
use Exception;

class PostController extends AControllerBase {

    public function index(): Response
    {
        return $this->html(['posts' => Post::getAll()]);
    }

    /**
     * @throws HTTPException
     * @throws Exception
     */
    public function detail(): Response
    {
        $id = $this->request()->getValue('id');
        error_log("Načítané ID: $id");

        $post = Post::getOne($id);
        if (!$post) {
            error_log("Príspevok s ID $id nebol načítaný.");
            throw new HTTPException(404, "Príspevok nenájdený");
        }

        error_log("Načítaný príspevok: " . print_r($post, true));

        return $this->html(['post' => $post], 'detail');
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
     * @throws Exception
     */
    public function store(): Response
    {
        $oldImage = null;
        $id = $this->request()->getValue('id');

        if ($id > 0) {

            $post = Post::getOne($id);
            if (!$post) {
                throw new Exception("Príspevok  nenájdeny");
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
        $street = $this->request()->getValue('street');
        $city = $this->request()->getValue('city');
        $postalCode = (int)$this->request()->getValue('postal_code');
        $descriptiveNumber = (int)$this->request()->getValue('descriptive_number');

        $address = Address::findOrCreate($street, $city, $postalCode, $descriptiveNumber);

        $post->setIdAddress($address->getId());

        $post->setName($name);
        $post->setDescription($description);
        $post->setCategory($category);
        $post->setSeason($season);
        $post->setOpeningHours($opening_hours);

        $post->save();

        $imageFile = $this->request()->getFiles()['image'] ?? null;
        if (!empty($imageFile['name'])) {
            if ($oldImage) {
                FileStorage::deleteFile($oldImage->getPath());
                $oldImage->delete();
            }
            $newFileName = FileStorage::saveFile($imageFile);
            $post->setImagePath($newFileName);
        }

        $returnUrl = $this->request()->getValue('return_url') ?? $_SERVER['HTTP_REFERER'] ?? $this->url('post.activity', ['season' => 'zima']);
        return new RedirectResponse($returnUrl);


    }

    /**
     * Zobrazenie formulára na úpravu existujúceho príspevku
     * @return Response
     * @throws Exception
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
     * @throws Exception
     */
    public function delete(): Response
    {
        $id = $this->request()->getValue('id');
        $post = Post::getOne($id);

        if (!$post) {
            throw new HTTPException(404, "Príspevok nenájdený");
        }

        $post->delete();

        $returnUrl = $this->request()->getValue('return_url');
        if (!$returnUrl) {
            $returnUrl = $this->url('post.activity', ['season' => 'zima']);
        }

        return new RedirectResponse($returnUrl);
    }

    public function category(): Response
    {
        $category = $this->request()->getValue('category');

        if (!in_array($category, ['activity', 'relax', 'sport'])) {
            throw new HTTPException(404, "Kategória nenájdená");
        }

        $posts = Post::where('category', $category);
        return $this->html([
            'posts' => $posts,
            'category' => $category
        ], 'Post/post');
    }



    public function activity(): Response
    {
        $season = $this->request()->getValue('season') ?? 'zima'; // Predvolená sezóna
        $posts = Post::where([
            'category' => 'activity',
            'season' => ['celorocne', $season] // Hľadaj "celoročné" alebo aktuálnu sezónu
        ]);

        return $this->html(['posts' => $posts, 'season' => $season, 'category' => 'activity'], 'post');
    }

    public function relax(): Response
    {
        $season = $this->request()->getValue('season') ?? 'zima'; // Predvolená sezóna
        $posts = Post::where([
            'category' => 'relax',
            'season' => ['celorocne', $season] // Hľadaj "celoročné" alebo aktuálnu sezónu
        ]);

        return $this->html(['posts' => $posts, 'season' => $season, 'category' => 'relax'], 'post');
    }

    public function sport(): Response
    {
        $season = $this->request()->getValue('season') ?? 'zima'; // Predvolená sezóna
        $posts = Post::where([
            'category' => 'sport',
            'season' => ['celorocne', $season] // Hľadaj "celoročné" alebo aktuálnu sezónu
        ]);

        return $this->html(['posts' => $posts, 'season' => $season, 'category' => 'sport'], 'post');
    }

}
