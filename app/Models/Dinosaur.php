<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dinosaur extends Model
{
    use HasFactory;

     protected $fillable = [
        'name',
        'living_era',
        'type_of_eat',
        'best_known',
    ];
}
