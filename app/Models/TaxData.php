<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxData extends Model
{
    use HasFactory;
    /**
     * The name table.
     *
     * @var string[]
     */
    protected $table = 'crud_tax_data';
     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'numdoc',
        'active'
    ];
}
