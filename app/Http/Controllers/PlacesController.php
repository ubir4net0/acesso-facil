<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Categoria;
use App\Models\PlaceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PlacesController extends Controller
{

    private function converterParaJpg($arquivo)
    {
        $ext = strtolower($arquivo->getClientOriginalExtension());
        $temp = $arquivo->getRealPath();

        switch ($ext) {
            case 'jpg':
            case 'jpeg':
                $img = imagecreatefromjpeg($temp);
                break;

            case 'png':
                $img = imagecreatefrompng($temp);
                imagepalettetotruecolor($img);
                break;

            case 'gif':
                $img = imagecreatefromgif($temp);
                break;

            case 'webp':
                $img = imagecreatefromwebp($temp);
                break;

            default:
                return null; 
        }

        $nome = Str::uuid() . '.jpg';
        $destino = storage_path('app/public/places/' . $nome);

        imagejpeg($img, $destino, 85);
        imagedestroy($img);

        return 'places/' . $nome;
    }


    // =====================================================
    public function index(Request $request)
    {
        $query = Place::with(['categoria', 'images']);

        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        $places = $query->paginate(10);
        $categorias = Categoria::all();

        return view('places.index', compact('places', 'categorias'));
    }


    public function create()
    {
        $this->authorize('access');
        $categorias = Categoria::all();
        return view('places.create', compact('categorias'));
    }


 
    public function store(Request $request)
    {
        $this->authorize('access');

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'fotos.*' => 'nullable|file',
        ]);

        $validated['cidade'] = 'Manaus';
        $validated['estado'] = 'AM';
        $validated['user_id'] = Auth::id();

        $place = Place::create($validated);

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {

                $path = $this->converterParaJpg($foto);

                if ($path) {
                    $place->images()->create([
                        'path' => $path,
                        'ordem' => 0
                    ]);
                }
            }
        }

        return redirect()->route('places.index')->with('success', 'Local cadastrado com sucesso!');
    }


    // =====================================================
    public function show(Place $place)
    {
        $place->load(['images' => function($q){
            $q->orderBy('ordem');
        }, 'categoria']);

        return view('places.show', compact('place'));
    }


    public function edit(Place $place)
    {
        $this->authorize('access');
        $categorias = Categoria::all();
        return view('places.edit', compact('place', 'categorias'));
    }


  
    public function update(Request $request, Place $place)
    {
        $this->authorize('access');

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'categoria_id' => 'nullable|exists:categorias,id',
            'fotos.*' => 'nullable|file',
        ]);

        $place->update($validated);

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {

                $path = $this->converterParaJpg($foto);

                if ($path) {
                    $place->images()->create([
                        'path' => $path,
                        'ordem' => 0
                    ]);
                }
            }
        }

        return redirect()->route('places.index')->with('success', 'Local atualizado com sucesso!');
    }



    public function destroy(Place $place)
    {
        $this->authorize('access');

        foreach ($place->images as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }

        $place->delete();

        return redirect()->route('places.index')->with('success', 'Local removido com sucesso!');
    }


  

}
