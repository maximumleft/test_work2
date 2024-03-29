<?php

namespace App\Http\Controllers;

use App\Services\User\Service;

class BaseController extends Controller
{
    public $movieService;
    public $userService;

    public function __construct(Service $userService, \App\Services\Movie\Service $movieService)
    {
        $this->movieService = $movieService;
        $this->userService = $userService;

    }

}
