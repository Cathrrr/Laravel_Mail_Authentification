<?php

// App\Models\Movie.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['image_path', 'name', 'release_year', 'description'];
    // atau
    // protected $guarded = []; // Membolehkan semua kolom untuk diisi
}

