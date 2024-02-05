<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class FavoriteMovieController extends BaseController
{
    public function addToFavorites(Request $request, Movie $movie)
    {
        return $this->movieService->addFavor($request, $movie);
    }

    public function removeFromFavorites(Request $request, Movie $movie)
    {
        return $this->movieService->removeFavor($request, $movie);
    }

    public function notFavorites(Request $request)
    {
        $loaderType = $request->query('loaderType');

        if ($loaderType == 'sql') {

            return $this->movieService->sqlLoader();

        } elseif ($loaderType == 'inMemory') {

            return $this->movieService->memoryLoader($request);

        } else
            return response(['error' => 'INTERNAL_ERROR'], 500);
    }
}
