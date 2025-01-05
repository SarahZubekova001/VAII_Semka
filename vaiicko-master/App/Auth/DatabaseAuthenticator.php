<?php

namespace App\Auth;

use App\Core\IAuthenticator;
use App\Core\Responses\JsonResponse;
use App\Models\User;

class DatabaseAuthenticator implements IAuthenticator
{
    public function __construct()
    {

        session_start();

    }

    public function login($login, $password): bool
    {
        $users = User::getAll('username = ?', [$login]);
        $user = $users[0] ?? null;

        if (!$user) {
            return false; // Používateľ nenájdený
        }

        // Overenie hesla
        if (password_verify($password, $user->getPasswordHash())) {
            // Uloženie používateľa do relácie
            $_SESSION['user'] = [
                'id' => $user->getId(),
                'username' => $user->getUsername(),
            ];
            return true;
        }

        return false; // Nesprávne heslo
    }


    public function logout(): void
    {
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
            session_destroy();
        }
    }

    /**
     * @throws \Exception
     */
    public function isLogged(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user'] != null;
    }

    /**
     * @throws \Exception
     */
    public function getLoggedUserName(): string
    {
        return $_SESSION['user'] ?? throw new \Exception("User not logged in");
    }

    public function getLoggedUserId(): mixed
    {
        return $_SESSION['user'] ?? null;
    }

    public function getLoggedUserContext(): mixed
    {
        return null;
    }

}
