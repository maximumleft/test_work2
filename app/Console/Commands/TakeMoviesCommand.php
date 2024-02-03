<?php

namespace App\Console\Commands;

use App\Components\TakeMovieClient;
use App\Models\Movie;
use Illuminate\Console\Command;

class TakeMoviesCommand extends Command
{
    protected $signature = 'import:Movies';

    protected $description = 'Take movies from one-api';

    public function handle()
    {
        $import = new TakeMovieClient();
        $page = 1;
        $movies = [];

        while (count($movies) < 3 && $page <= 3) {
            $response = $import->client->request('GET','movie', [
                'query' => [
                    'page' => $page
                ],
                'headers' => [
                    'Authorization' => 'Bearer _vkURH8Pmkkfv65ja07u'
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            foreach ($data['docs'] as $movieData) {
                $movies[] = $movieData;
            }

            $page++;
        }

        foreach ($movies as $movieData) {
            $existingMovie = Movie::where('name', $movieData['name'])->first();
            if (!$existingMovie) {
                $movie = new Movie();
                $movie->name = $movieData['name'];
                $movie->budgetInMillions = $movieData['budgetInMillions'];
                $movie->save();

            }
        }
        $this->info('Successfully fetched ' . count($movies) . ' movies.');
    }
}
