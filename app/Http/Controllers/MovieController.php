<?php

namespace App\Http\Controllers;

use App\Http\Resources\Movie\Resource;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(10);

        return Resource::collection($movies);
    }
}
