@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>{{ $place->nome }}</h1>
    <p class="text-muted">{{ $place->categoria->nome ?? 'Sem categoria' }}</p>
    <p><strong>Endereço:</strong> {{ $place->endereco }}</p>

    <div class="d-flex flex-wrap gap-3 mb-4">
        @foreach ($place->images as $image)
            <img src="{{ asset('storage/'.$image->path) }}" width="250" class="rounded">
        @endforeach
    </div>

    <a href="{{ route('places.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
