<?php

namespace App\Services\Movie;

use App\Models\Movie;
use App\Models\MovieUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Service
{

    public function addFavor($request, $movie)
    {
        $userId = $request->header('User-Id');

        MovieUser::firstOrCreate([
            'user_id' => $userId,
            'movie_id' => $movie->id
        ]);


        return response()->json(['message' => 'Movie added to favorites']);
    }

    public function removeFavor($request, $movie)
    {
        $userId = $request->header('User-Id');

        MovieUser::where('user_id', $userId)
            ->where('movie_id', $movie->id)
            ->delete();

        return response()->json(['message' => 'Movie removed from favorites']);
    }

    public function sqlLoader()
    {
        $notFavorite = DB::table('movies')->whereNotIn('id', function ($query) use ($userId) {
            $query->select('movie_id as id')
                ->from('movie_users')
                ->where('user_id', $userId);
        })->get();
        return $notFavorite;
    }

    public function memoryLoader($request)
    {
        $userId = $request->header('User-Id');
        $allFilms = Movie::all();
        $favoriteFilms = User::find($userId)->favoriteMovies;

        $notFavorite = $allFilms->diff($favoriteFilms);
        return $notFavorite;
    }
}
