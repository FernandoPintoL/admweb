<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntArticulo extends Model
{
    use HasFactory;
    protected $table = 'intArticulo';
    public $timestamps = false;
    // protected $primaryKey = 'artId';
    protected $fillable = [
        'artId',
        'uniId',
        'monId',
        'resId',
        'artNombre',
        'artDescripcion',
        'artPrecioVenta',
        'artPrecioVentaDos',
        'artPrecioVentaTres',
        'artFraccionado',
        'artFoto',
        'artHabilitado',
        'artTipo',
        'artPropiedad',
        'artCalculoCosto',
        'artConvertirEnAF',
        'artDepreciable'
    ];
}
