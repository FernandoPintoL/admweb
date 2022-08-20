<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntArticuloCodBarra extends Model
{
    use HasFactory;
    public $table = 'intArticuloCodBarra';
    public $primaryKey = 'tadId';
    public $timestamps = false;
    public $fillable = [
        'artId',
        'codBarra',
        'cbHabilitado',
        'cbFechaCreacion',
        'acbUsuarioCreacion'
    ];
}