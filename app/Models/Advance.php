<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advance extends Model
{
    use HasFactory;

    /**
     * The name table.
     *
     * @var string[]
     */
    protected $table = 'advance';
     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'fechadoc',
        'fecha_contabilizacion',
        'id_sociedad',
        'moneda',
        'referencia',
        'textocab',
        'cuenta',
        'cmeindicator',
        'fecha_vencimiento',
        'bloqueo_pago',
        'importe',
        'via_pago',
        'texto',
        'estatus'
    ];
}
