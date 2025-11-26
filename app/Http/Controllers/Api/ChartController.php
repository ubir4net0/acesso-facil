<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Comment;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{

    public function topRatedPlaces()
    {
        $top = Place::withAvg('comentarios', 'estrelas')
            ->orderByDesc('comentarios_avg_estrelas')
            ->take(5)
            ->get();

        return [
            'labels' => $top->pluck('nome'),
            'values' => $top->pluck('comentarios_avg_estrelas')->map(fn($v) => round($v, 2)),
        ];
    }


    public function mostCommentedPlaces()
    {
        $top = Place::withCount('comentarios')
            ->orderByDesc('comentarios_count')
            ->take(5)
            ->get();

        return [
            'labels' => $top->pluck('nome'),
            'values' => $top->pluck('comentarios_count'),
        ];
    }

 
  
public function categoryAverageRatings()
{
    $categories = Categoria::with(['places.comentarios'])
        ->get()
        ->map(function ($cat) {
            $comentarios = $cat->places->flatMap->comentarios;

            $media = $comentarios->count() > 0
                ? round($comentarios->avg('estrelas'), 2)
                : 0;

            return [
                'categoria' => $cat->nome,
                'media' => $media
            ];
        });

    return [
        'labels' => $categories->pluck('categoria'),
        'values' => $categories->pluck('media'),
    ];
}


public function categoryTotalRatings()
{
    $categories = Categoria::with(['places.comentarios'])
        ->get()
        ->map(function ($cat) {
            $total = $cat->places->flatMap->comentarios->count();
            return [
                'categoria' => $cat->nome,
                'total' => $total
            ];
        });

    return [
        'labels' => $categories->pluck('categoria'),
        'values' => $categories->pluck('total'),
    ];
}

}
