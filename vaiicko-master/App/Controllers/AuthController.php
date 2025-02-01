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

        if (!isset($formData['login'], $formData['password'])) {
            return $this->json([
                'success' => false,
                'message' => 'Neplatná požiadavka alebo chýbajúce údaje.'
            ]);
        }

        $logged = $this->app->getAuth()->login($formData['login'], $formData['password']);
        $redirect = $formData['redirect'] ?? $this->url("home.home");
        return $this->json([
            'success' => $logged,
            'redirect' => $logged ? $redirect : null,
            'message' => $logged ? null : 'Zlý login alebo heslo!'
        ]);
    }
    public function register(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        $errors = [];

        if (empty($formData['login'])) {
            $errors['login'] = "Používateľské meno je povinné.";
        }
        if (empty($formData['password'])) {
            $errors['password'] = "Heslo je povinné.";
        }

        $existingUsers = User::getAll("username = ?", [$formData['login']], null, 1);
        if (!empty($existingUsers)) {
            $errors['login'] = "Používateľ s týmto menom už existuje.";
        }

        // Ak sú chyby, vrátime formulár s chybami
        if (!empty($errors)) {
            return $this->html(['errors' => $errors, 'formData' => $formData], 'register');
        }

        $user = new User();
        $user->setUsername($formData['login']);
        $user->setPassword($formData['password']);
        $user->save(); // Uloženie do DB

        return $this->html(['successMessage' => "Úspešne pridaný do databázy!"], 'register');
    }


    public function logout(): Response {
        session_destroy();
        $redirect = $_GET['redirect'] ?? $this->url("home.home");
        $redirect = urldecode($redirect);

        return $this->redirect($redirect);
    }
    public function showLoginForm(): Response
    {
        return $this->html(null, 'login');
    }
    public function showRegisterForm() : Response
    {
        if (!$this->app->getAuth()->isLogged()) {
            return $this->redirect($this->url('auth.showLoginForm'));
        }
        return $this->html(['errors' => [], 'successMessage' => null], 'register');
    }


}