<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_id',
        'user_id',
        'comentario',
        'estrelas',
    ];

    /** Um comentário pertence a um local */
    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    /** Um comentário pertence a um usuário */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
