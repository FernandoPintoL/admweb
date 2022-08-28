<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntExistencia extends Model
{
    use HasFactory;
    protected $table = 'intExistencia';
    public $timestamps = false;
    public $incrementing = false;
    // protected $primaryKey = 'artId';
    protected $fillable = [
        'almId',
        'artId',
        'exiExistencia'
    ];
}