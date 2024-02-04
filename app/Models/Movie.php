<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = false;

    public function favoriteUsers()
    {
        return $this->belongsToMany(User::class, 'movie_users');
    }

}
