<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntAlmacen extends Model
{
    use HasFactory;
    // protected $primaryKey = 'artId';
    protected $table = 'intAlmacen';
    public $timestamps = false;
    protected $fillable = [
        'almId',
        'dirId',
        'IprId',
        'galId',
        'almNombre',
        'almFechaCambio',
        'almHabilitado',
        'sucId'
    ];
}