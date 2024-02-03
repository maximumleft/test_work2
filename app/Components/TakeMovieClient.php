<?php

namespace App\Components;

use GuzzleHttp\Client;

class TakeMovieClient
{
    public $client;

    /**
     * @param $client
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://the-one-api.dev/v2/',
        ]);
    }
}
