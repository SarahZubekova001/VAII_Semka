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
    public function index(): Response
    {
        return $this->redirect('/auth/login');
    }

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
            'message' => $logged ? null : 'Nesprávne prihlasovacie údaje'
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

        if (!empty($errors)) {
            return $this->html(['errors' => $errors, 'formData' => $formData], 'register');
        }

        $user = new User();
        $user->setUsername($formData['login']);
        $user->setPassword($formData['password']);
        $user->save();

        return $this->html(['successMessage' => "Úspešne pridaný do databázy!"], 'register');
    }


    public function logout(): Response {
        session_destroy();
        $redirect = $_GET['redirect'] ?? $this->url("home.home");

        return $this->redirect(urldecode($redirect));
    }
    public function loginForm(): Response
    {
        return $this->html(null, 'login');
    }
    public function registerForm() : Response
    {
        if (!$this->app->getAuth()->isLogged()) {
            return $this->redirect($this->url('auth.loginForm'));
        }
        return $this->html(['errors' => [], 'successMessage' => null], 'register');
    }

    public function deleteAccount(): Response
    {
        if (!$this->app->getAuth()->isLogged()) {
            return $this->redirect($this->url("home.home"));
        }

        $userId = $this->app->getAuth()->getLoggedUserId();
        if (is_array($userId) && isset($userId['id'])) {
            $userId = $userId['id']; // Ak je ID v poli, extrahujeme ho
        }

        if (!$userId) {
            return $this->redirect($this->url("home.home"));
        }

        $user = User::getOne($userId);
        if (!$user) {
            return $this->redirect($this->url("home.home"));
        }

        // Vymazanie používateľa
        $user->delete();

        // Odhlásenie a zmazanie session
        $_SESSION = [];
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time() - 3600);

        return $this->redirect($this->url("home.home"));
    }
}