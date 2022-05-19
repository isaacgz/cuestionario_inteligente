<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legalization extends Model
{
    use HasFactory;
    /**
     * The name table.
     *
     * @var string[]
     */
    protected $table = 'legalization';
     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'archivo_xml',
        'archivo_pdf',
        'archivo_zip'        
    ];
}
