<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class GntDirectorio extends Model
{
    use HasFactory;
    protected $table = 'gntDirectorio';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'celular',
        'telefono',
        'website',
        'ci',
        'nit',
        'razonsocial',
        'direccion',
    ];
    public function user(){
        return $this->hasOne(User::class);
    }
}