<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compensation extends Model
{
    use HasFactory;
    /**
     * The name table.
     *
     * @var string[]
     */
    protected $table = 'compensation';
     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'id_advance',
        'id_legalization',
        'mensaje'        
    ];
}
