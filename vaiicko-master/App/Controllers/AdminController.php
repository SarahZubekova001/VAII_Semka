<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\User;

class AdminController extends AControllerBase
{
    public function authorize($action)
    {
        return $this->app->getAuth()->isLogged();
    }
    public function index(): Response
    {
        return $this->html();
    }

}
