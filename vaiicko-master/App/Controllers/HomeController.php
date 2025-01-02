<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Restaurant;

class HomeController extends AControllerBase
{
    public function index(): Response
    {
        return $this->html(
            [
                'restaurants' => Restaurant::getAll()
            ]
        );
    }

    public function info(): Response
    {
        return $this->html();
    }

    public function summer(): Response
    {
        return $this->html();
    }

    public function winter(): Response
    {
        return $this->html();
    }


    public function spalena(): Response
    {
        return $this->html();
    }



}
