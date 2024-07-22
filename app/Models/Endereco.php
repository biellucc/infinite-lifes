<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $table = 'endereco';
    protected $fillable = [
        'cep',
        'pais',
        'estado',
        'cidade',
        'bairro',
        'endereco',
        'complemento',
        'user_id'
    ];

    protected $hidden = [
        'user_id'
    ];

    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }
}
