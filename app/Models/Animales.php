<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animales extends Model
{
    use HasFactory;
    /**
     * The name table.
     *
     * @var string[]
     */
    protected $table = 'animales';
}
