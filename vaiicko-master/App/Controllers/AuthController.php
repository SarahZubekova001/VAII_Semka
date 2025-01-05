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
        $existingAdmin = User::getAll('username = ?', ['admin']);
        if (empty($existingAdmin)) {
            $user = new User();
            $user->setUsername('admin');
            $user->setPasswordHash(password_hash('admin123', PASSWORD_DEFAULT));
            $user->save();

            echo "Admin používateľ bol úspešne vytvorený.<br>";
        }

        $formData = $this->app->getRequest()->getPost();
        $logged = null;

        if (isset($formData['submit'])) {
            // Použitie `DatabaseAuthenticator` na prihlásenie
            $logged = $this->app->getAuth()->login($formData['login'], $formData['password']);
            if ($logged) {
                return $this->redirect($this->url("home.index")); // Presmerovanie na dashboard
            }
        }

        // Vrátenie pohľadu s chybovou správou
        $data = ($logged === false ? ['message' => 'Zlý login alebo heslo!'] : []);
        return $this->html($data);
    }


    public function logout(): Response
    {
        session_destroy();
        return $this->redirect(Configuration::LOGIN_URL);
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