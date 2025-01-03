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
        $id = $this->request()->getValue('id');
        $post = $id ? Post::getOne($id) : new Post();

        $name = $this->request()->getValue('name');
        $description = $this->request()->getValue('description');
        $category = $this->request()->getValue('category');
        $season = $this->request()->getValue('season');
        $opening_hours = $this->request()->getValue('opening_hours');
        $street = $this->request()->getValue('street');
        $city = $this->request()->getValue('city');
        $postalCode = $this->request()->getValue('postal_code');
        $descriptiveNumberValue = $this->request()->getValue('descriptive_number');

        // Pridanie validačných chýb
        $formErrors = [];

        if (empty($name)) {
            $formErrors[] = "Pole 'Názov' je povinné!";
        }
        if (empty($description)) {
            $formErrors[] = "Pole 'Popis' je povinné!";
        }
        if (!is_numeric($descriptiveNumberValue)) {
            $formErrors[] = "Popisné číslo musí byť číselné!";
        } else {
            $descriptiveNumber = (int) $descriptiveNumberValue;
        }
        if (!is_numeric($postalCode)) {
            $formErrors[] = "PSC číslo musí byť číselné!";
        } else {
            $postalCode = (int) $postalCode;
        }

        // Ak sú chyby, vrátiť formulár s chybami
        if (!empty($formErrors)) {
            return $this->html([
                'errors' => $formErrors,
                'post' => $post
            ], $id ? 'edit' : 'add');
        }

        // Pokračovanie v spracovaní
        $post->setName($name);
        $post->setDescription($description);
        $post->setCategory($category);
        $post->setSeason($season);
        $post->setOpeningHours($opening_hours);

        $address = Address::findOrCreate($street, $city, $postalCode, $descriptiveNumber);
        $post->setIdAddress($address->getId());

        $post->save();

        return new RedirectResponse($this->url('post.category', ['category' => $category]));
    }

    private function formErrors(): array
    {
        $errors = [];

        // Overenie názvu
        if (empty($this->request()->getValue('name'))) {
            $errors[] = "Pole 'Názov' je povinné!";
        }

        // Overenie popisu
        if (empty($this->request()->getValue('description'))) {
            $errors[] = "Pole 'Popis' je povinné!";
        }

        // Overenie kategórie
        if (empty($this->request()->getValue('category'))) {
            $errors[] = "Pole 'Kategória' je povinné!";
        }

        // Overenie sezóny
        if (empty($this->request()->getValue('season'))) {
            $errors[] = "Pole 'Sezóna' je povinné!";
        }

        // Overenie otváracích hodín
        if (empty($this->request()->getValue('opening_hours'))) {
            $errors[] = "Pole 'Otváracie hodiny' je povinné!";
        }

        // Overenie ulice
        if (empty($this->request()->getValue('street'))) {
            $errors[] = "Pole 'Ulica' je povinné!";
        }

        // Overenie mesta
        if (empty($this->request()->getValue('city'))) {
            $errors[] = "Pole 'Mesto' je povinné!";
        }

        // Overenie PSČ
        $postalCode = $this->request()->getValue('postal_code');
        if (empty($postalCode)) {
            $errors[] = "Pole 'PSČ' je povinné!";
        } elseif (!is_numeric($postalCode)) {
            $errors[] = "PSČ musí byť číselné!";
        }

        // Overenie popisného čísla
        $descriptiveNumber = $this->request()->getValue('descriptive_number');
        if (empty($descriptiveNumber)) {
            $errors[] = "Pole 'Popisné číslo' je povinné!";
        } elseif (!is_numeric($descriptiveNumber)) {
            $errors[] = "Popisné číslo musí byť číselné!";
        }

        // Overenie obrázka
        $allowedMimeTypes = ['image/jpeg', 'image/png'];
        $imageFile = $this->request()->getFiles()['image'] ?? null;
        if (!empty($imageFile['name'])) {
            if (!in_array($imageFile['type'], $allowedMimeTypes)) {
                $errors[] = "Obrázok musí byť vo formáte JPG alebo PNG!";
            }

            if ($imageFile['size'] > 5 * 1024 * 1024) { // 5 MB limit
                $errors[] = "Obrázok je príliš veľký! Maximálna povolená veľkosť je 5 MB.";
            }
        }

        return $errors;
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
        ], 'post');
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
