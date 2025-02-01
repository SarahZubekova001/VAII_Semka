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
        $post = Post::getOne($id);
        if (!$post) {
            throw new HTTPException(404, "Príspevok nenájdený");
        }
        return $this->html(['post' => $post], 'detail');
    }



    /**
     * Zobrazenie formulára na pridanie nového príspevku
     * @return Response
     */
    public function add(): Response
    {
        // Kontrola prihlásenia
        if (!$this->app->getAuth()->isLogged()) {
            return $this->redirect($this->url('auth.showLoginForm'));
        }
        $category = $this->request()->getValue('category') ?? '';
        $season = $this->request()->getValue('season') ?? '';

        return $this->html([
            'category' => $category,
            'season' => $season
        ], 'add');
    }


    /**
     * Uloženie nového alebo aktualizácia existujúceho príspevku
     * @return Response
     * @throws Exception
     */
    public function store(): Response
    {
        // Kontrola prihlásenia
        if (!$this->app->getAuth()->isLogged()) {
            return $this->redirect($this->url('auth.showLoginForm'));
        }
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
        $descriptiveNumber = $this->request()->getValue('descriptive_number');


        $post->setName($name);
        $post->setDescription($description);
        $post->setCategory($category);
        $post->setSeason($season);
        $post->setOpeningHours($opening_hours);
        $address = Address::findOrCreate($street, $city, $postalCode, $descriptiveNumber);
        $post->setIdAddress($address->getId());

        $imageFiles = $this->request()->getFiles()['image'] ?? [];

        if (is_array($imageFiles['tmp_name'])) {
            foreach ($imageFiles['tmp_name'] as $index => $tmpName) {
                if (!empty($imageFiles['name'][$index]) && is_string($tmpName)) {
                    $newFileName = FileStorage::saveFile([
                        'name' => $imageFiles['name'][$index],
                        'tmp_name' => $tmpName
                    ]);
                    $post->addImageToGallery($newFileName);
                }
            }
        } elseif (!empty($imageFiles['name']) && is_string($imageFiles['tmp_name'])) {
            // Ak je len jeden súbor, nahrá ho normálne
            $newFileName = FileStorage::saveFile($imageFiles);
            $post->setImagePath($newFileName);
        }
////        foreach ($imageFile['tmp_name'] as $index => $tmpName) {
//            if (!empty($imageFile['name'])) {
//                $oldImage = $post->getImagePath();
//                if ($oldImage) {
//                    FileStorage::deleteFile($oldImage->getPath());
//                    $oldImage->delete();
//                }
//
//                $newFileName = FileStorage::saveFile($imageFile);
//                $post->setImagePath($newFileName);
//            }
////            if (!empty($imageFiles['name'][$index])) {
////                $newFileName = FileStorage::saveFile($tmpName);
////                $post->addImageToGallery($newFileName);
////            }
////        }

        $post->save();

        $formErrors = [];
        if (!empty($formErrors)) {
            return $this->html([
                'errors' => $formErrors,
                'post' => $post
            ], $id ? 'edit' : 'add');
        }
        $category = $post->getCategory();

        return new RedirectResponse($this->url( $category,['season' => $post->getSeason()]));
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

        if (empty($postalCode)) {
            $errors[] = "Pole 'PSČ' je povinné!";
        } elseif (!is_numeric($postalCode)) {
            $errors[] = "PSČ musí byť číselné!";
        }

        // Overenie popisného čísla

        if (empty($descriptiveNumber)) {
            $errors[] = "Pole 'Popisné číslo' je povinné!";
        } elseif (!is_numeric($descriptiveNumber)) {
            $errors[] = "Popisné číslo musí byť číselné!";
        }

        // Overenie obrázka
        $allowedMimeTypes = ['image/jpeg', 'image/png'];
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

    public function edit(): Response
    {
        // Kontrola prihlásenia
        if (!$this->app->getAuth()->isLogged()) {
            return $this->redirect($this->url('auth.showLoginForm'));
        }
        $id = $this->request()->getValue('id');
        $post = Post::getOne($id);

        if (!$post) {
            throw new HTTPException(404, "Príspevok nenájdený");
        }

        return $this->html(['post' => $post]);
    }

    public function delete(): Response
    {
        // Kontrola prihlásenia
        if (!$this->app->getAuth()->isLogged()) {
            return $this->redirect($this->url('auth.showLoginForm'));
        }
        $id = $this->request()->getValue('id');
        $post = Post::getOne($id);

        if (!$post) {
            throw new HTTPException(404, "Príspevok nenájdený");
        } else {
            $image = $post->getImagePath();
            if ($image) {
                FileStorage::deleteFile($image->getPath());
                $image->delete();
            }
        } $post->delete();

        $returnUrl = $this->request()->getValue('return_url') ?? $this->url('post.category', ['category' => $post->getCategory()]);

        return new RedirectResponse(urldecode($returnUrl));
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
        $season = $this->request()->getValue('season') ;
        $posts = Post::where([
            'category' => 'activity',
            'season' => ['celorocne', $season]
        ]);

        return $this->html(['posts' => $posts, 'season' => $season, 'category' => 'activity'], 'post');
    }

    public function relax(): Response
    {
        $season = $this->request()->getValue('season') ?? 'zima';
        $posts = Post::where([
            'category' => 'relax',
            'season' => ['celorocne', $season]
        ]);

        return $this->html(['posts' => $posts, 'season' => $season, 'category' => 'relax'], 'post');
    }

    public function sport(): Response
    {
        $season = $this->request()->getValue('season') ?? 'zima';
        $posts = Post::where([
            'category' => 'sport',
            'season' => ['celorocne', $season]
        ]);

        return $this->html(['posts' => $posts, 'season' => $season, 'category' => 'sport'], 'post');
    }

}
