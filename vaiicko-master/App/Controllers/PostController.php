<?php
namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Helpers\FileStorage;
use App\Models\Address;
use App\Models\Image;
use App\Models\Post;
use Exception;

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
        return $this->html(['post' => $post], 'detail');
    }

    public function add(): Response
    {
        if (!$this->app->getAuth()->isLogged()) {
            return $this->redirect($this->url('auth.loginForm'));
        }

        return $this->html([
            'category' => $this->request()->getValue('category') ?? '',
            'season' => $this->request()->getValue('season') ?? ''
        ], 'add');
    }

    public function store(): Response
    {
        if (!$this->app->getAuth()->isLogged()) {
            return $this->redirect($this->url('auth.loginForm'));
        }

        $id = $this->request()->getValue('id');
        $post = $id ? Post::getOne($id) : new Post();

        $errors = $this->validateForm();

        if (!empty($errors)) {
            return $this->html([
                'errors' => $errors,
                'post' => $post,
                'return_url' => $this->request()->getValue('return_url')
            ], $id ? 'edit' : 'add');
        }


        $post->setName($this->request()->getValue('name'));
        $post->setDescription($this->request()->getValue('description'));
        $post->setCategory($this->request()->getValue('category'));
        $post->setSeason($this->request()->getValue('season'));
        $post->setOpeningHours($this->request()->getValue('opening_hours'));

        $address = Address::findOrCreate(
            $this->request()->getValue('street'),
            $this->request()->getValue('city'),
            $this->request()->getValue('postal_code'),
            $this->request()->getValue('descriptive_number')
        );
        $post->setIdAddress($address->getId());

        $imageFiles = $this->request()->getFiles()['image'] ?? [];

        if (isset($imageFiles['tmp_name'])) {
            if (is_array($imageFiles['tmp_name'])) {
                foreach ($imageFiles['tmp_name'] as $index => $tmpName) {
                    if (!empty($imageFiles['name'][$index]) && is_string($tmpName)) {
                        $fileMimeType = mime_content_type($tmpName);
                        if (!in_array($fileMimeType, ['image/jpeg', 'image/png'])) {
                            continue;
                        }
                        $newFileName = FileStorage::saveFile([
                            'name' => $imageFiles['name'][$index],
                            'tmp_name' => $tmpName
                        ]);
                        $post->addImageToGallery($newFileName);
                    }
                }
            } elseif (!empty($imageFiles['name']) && is_string($imageFiles['tmp_name'])) {
                $fileMimeType = mime_content_type($imageFiles['tmp_name']);
                if (in_array($fileMimeType, ['image/jpeg', 'image/png'])) {
                    $newFileName = FileStorage::saveFile($imageFiles);
                    $post->setImagePath($newFileName);
                }
            }
        }

        if ($mainImage = $this->request()->getValue('main_image')) {
            if ($image = Image::getOne($mainImage)) {
                $post->setMainImage($image->getId());
            }
        }

        $post->save();
        $returnUrl = $this->request()->getValue('return_url') ?? $this->url($post->getCategory(), ['season' => $post->getSeason()]);

        return new RedirectResponse(urldecode($returnUrl));

    }


    private function validateForm(): array
    {
        $errors = [];
        $requiredFields = ['name', 'description', 'category', 'season', 'opening_hours', 'street', 'city', 'postal_code', 'descriptive_number'];

        foreach ($requiredFields as $field) {
            if (empty($this->request()->getValue($field))) {
                $errors[] = "Pole '$field' je povinné!";
            }
        }

        $postalCode = $this->request()->getValue('postal_code');
        if (!is_numeric($postalCode)) {
            $errors[] = "PSČ musí byť číslo!";
        } elseif ($postalCode < 1 || $postalCode > 2147483647) {
            $errors[] = "Popisné číslo je príliš veľke";
        }

        $descriptiveNumber = $this->request()->getValue('descriptive_number');
        if (!is_numeric($descriptiveNumber)) {
            $errors[] = "Popisné číslo musí byť číslo!";
        } elseif ($descriptiveNumber < 1 || $descriptiveNumber > 2147483647) {
            $errors[] = "Popisné číslo je príliš veľke";
        }

        $allowedMimeTypes = ['image/jpeg', 'image/png'];
        $imageFiles = $this->request()->getFiles()['image'] ?? [];

        if (isset($imageFiles['tmp_name'])) {
            if (is_array($imageFiles['tmp_name'])) {
                foreach ($imageFiles['tmp_name'] as $tmpName) {
                    if (!empty($tmpName)) {
                        $fileMimeType = mime_content_type($tmpName);
                        if (!in_array($fileMimeType, $allowedMimeTypes)) {
                            $errors[] = "Obrázok musí byť vo formáte JPG alebo PNG!";
                        }
                    }
                }
            } elseif (!empty($imageFiles['tmp_name'])) {
                $fileMimeType = mime_content_type($imageFiles['tmp_name']);
                if (!in_array($fileMimeType, $allowedMimeTypes)) {
                    $errors[] = "Obrázok musí byť vo formáte JPG alebo PNG!";
                }
            }
        }
        return $errors;
    }

    public function edit(): Response
    {
        if (!$this->app->getAuth()->isLogged()) {
            return $this->redirect($this->url('auth.loginForm'));
        }

        $id = $this->request()->getValue('id');
        $post = Post::getOne($id);

        if (!$post) {
            throw new HTTPException(404, "Príspevok nenájdený");
        }

        return $this->html([
            'post' => $post,
            'return_url' => $this->request()->getValue('return_url') ?? $_SERVER['HTTP_REFERER'] ?? null
        ]);
    }


    public function delete(): Response
    {
        if (!$this->app->getAuth()->isLogged()) {
            return $this->redirect($this->url('auth.loginForm'));
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
        return $this->filterByCategory($this->request()->getValue('category'));
    }

    public function activity(): Response
    {
        return $this->filterByCategory('activity');
    }

    public function relax(): Response
    {
        return $this->filterByCategory('relax');
    }

    public function sport(): Response
    {
        return $this->filterByCategory('sport');
    }

    private function filterByCategory(string $category): Response
    {
        if (!in_array($category, ['activity', 'relax', 'sport'])) {
            throw new HTTPException(404, "Kategória nenájdená");
        }

        $season = $this->request()->getValue('season') ?? 'zima';
        $posts = Post::where(['category' => $category, 'season' => ['celorocne', $season]]);

        return $this->html(['posts' => $posts, 'season' => $season, 'category' => $category], 'post');
    }

}