@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">Editar Local</h1>

    <form action="{{ route('places.update', $place) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" value="{{ $place->nome }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Endereço</label>
            <input type="text" name="endereco" value="{{ $place->endereco }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoria</label>
            <select name="categoria_id" class="form-select" required>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $place->categoria_id == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Adicionar novas fotos</label>
            <input type="file" name="fotos[]" class="form-control" multiple accept="image/*">
        </div>

        <h5>Fotos atuais:</h5>
        <div class="d-flex flex-wrap gap-3">
            @foreach($place->images as $image)
                <img src="{{ asset('storage/'.$image->path) }}" width="150" class="rounded">
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary mt-3">Atualizar</button>
        <a href="{{ route('places.index') }}" class="btn btn-secondary mt-3">Voltar</a>
    </form>
</div>
@endsection
