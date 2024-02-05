<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoriteMovieController extends Controller
{
    public function addToFavorites(Movie $movie, User $user)
    {

        dd(auth()->user());
        MovieUser::firstOrCreate([
            'user_id' => $user->id,
            'movie_id' => $movie->id
        ]);


        return response()->json(['message' => 'Movie added to favorites']);
    }

    public function removeFromFavorites(Movie $movie, User $user)
    {
        MovieUser::where('user_id', $user->id)
            ->where('movie_id', $movie->id)
            ->delete();

        return response()->json(['message' => 'Movie removed from favorites']);
    }

    public function notFavorites(Request $request, User $user)
    {
        $userId = $user->id;
        $loaderType = $request->query('loaderType');

        if ($loaderType == 'sql') {
            $notFavorite = DB::table('movies')->whereNotIn('id', function ($query) use ($userId) {
                $query->select('movie_id as id')
                    ->from('movie_users')
                    ->where('user_id', $userId);
            })->get();
            return $notFavorite;
        } elseif ($loaderType == 'inMemory') {
            $allFilms = Movie::all();
            $favoriteFilms = User::find($userId)->favoriteMovies;

            $notFavorite = $allFilms->diff($favoriteFilms);
            return $notFavorite;
        } else
            return response(['error' => 'INTERNAL_ERROR'], 500);

    }
}
