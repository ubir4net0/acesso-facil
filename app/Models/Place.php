<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria_id',
        'nome',
        'descricao',
        'endereco',
        'cidade',
        'estado',
    ];

    /** Um local pertence a uma categoria */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    /** Um local possui vários comentários */
    public function comentarios()
    {
        return $this->hasMany(Comment::class);
    }

    /** Média das estrelas */
public function feedbacks()
{
    return $this->hasMany(Comment::class, 'place_id');
}


    /** Fotos do local */
    public function images()
    {
        return $this->hasMany(PlaceImage::class, 'place_id');
    }
}
