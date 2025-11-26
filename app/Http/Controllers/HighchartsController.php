<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Categoria;

class HighchartsController extends Controller
{

    public function topRated()
    {
        $top = Place::withAvg('comentarios', 'estrelas')
            ->orderByDesc('comentarios_avg_estrelas')
            ->take(5)
            ->get();

        return response()->json([
            'labels' => $top->pluck('nome'),
            'values' => $top->pluck('comentarios_avg_estrelas')->map(fn($v) => round($v, 2)),
        ]);
    }


    public function mostCommented()
    {
        $top = Place::withCount('comentarios')
            ->orderByDesc('comentarios_count')
            ->take(5)
            ->get();

        return response()->json([
            'labels' => $top->pluck('nome'),
            'values' => $top->pluck('comentarios_count'),
        ]);
    }


    public function categoryAverage()
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
                    'media' => $media,
                ];
            });

        return response()->json([
            'labels' => $categories->pluck('categoria'),
            'values' => $categories->pluck('media'),
        ]);
    }


    public function categoryTotal()
    {
        $categories = Categoria::with(['places.comentarios'])
            ->get()
            ->map(function ($cat) {
                return [
                    'categoria' => $cat->nome,
                    'total' => $cat->places->flatMap->comentarios->count(),
                ];
            });

        return response()->json([
            'labels' => $categories->pluck('categoria'),
            'values' => $categories->pluck('total'),
        ]);
    }
}
