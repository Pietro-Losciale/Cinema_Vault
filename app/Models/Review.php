<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
    'user_id',
    'movie_id',
    'vote',
    'content',
];


public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}
}
