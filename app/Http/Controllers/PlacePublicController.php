<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlacePublicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('comentar');
    }

    public function index(Request $request)
    {
        $categorias = Categoria::all();

        $query = Place::with(['categoria', 'images', 'comentarios']);

        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        if ($request->filled('busca')) {
            $query->where(function ($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->busca . '%')
                  ->orWhere('descricao', 'like', '%' . $request->busca . '%');
            });
        }

        $places = $query->latest()->paginate(9);

        return view('places.public.index', compact('places', 'categorias'));
    }

    public function show(Place $place)
    {
        $place->load(['images', 'categoria', 'comentarios.user']);
        return view('places.public.show', compact('place'));
    }

    public function comentar(Request $request, Place $place)
    {
        $request->validate([
            'comentario' => 'nullable|string|max:2000',
            'estrelas' => 'required|integer|min:1|max:5',
        ]);

        $place->comentarios()->create([
            'user_id' => Auth::id(),
            'comentario' => $request->comentario,
            'estrelas' => $request->estrelas,
        ]);

        return back()->with('success', 'Comentário enviado com sucesso,sua opnião conta muito!😁');
    }
}
