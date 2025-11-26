<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = ['nome'];

    /** Uma categoria possui vários lugares */
    public function places()
    {
        return $this->hasMany(Place::class, 'categoria_id');
    }
}
