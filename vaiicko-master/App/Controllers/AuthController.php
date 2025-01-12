<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\JsonResponse;
use App\Core\Responses\Response;
use App\Core\Responses\ViewResponse;
use App\Models\User;
use JsonException;

/**
 * Class AuthController
 * Controller for authentication actions
 * @package App\Controllers
 */
class AuthController extends AControllerBase
{
    /**
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->redirect('/auth/login');
    }

    /**
     * Login a user
     * @return JsonResponse
     * @throws JsonException
     */
    public function login(): Response
    {
        $formData = $this->app->getRequest()->getPost();

        if (isset($formData['login'], $formData['password'])) {
            $logged = $this->app->getAuth()->login($formData['login'], $formData['password']);

            if ($logged) {
                return $this->json([
                    'success' => true,
                    'redirect' => $this->url("home.home")
                ]);
            } else {
                return $this->json([
                    'success' => false,
                    'message' => 'Zlý login alebo heslo!'
                ]);
            }
        }

        return $this->json([
            'success' => false,
            'message' => 'Neplatná požiadavka alebo chýbajúce údaje.'
        ]);
    }

    public function logout(): Response {
        session_destroy();
        return $this->redirect('/?c=home&a=home');
    }
    public function showLoginForm(): Response
    {
        return $this->html(null, 'login');
    }
//    /**
//     * Logout a user
//     * @return Response
//     */

}