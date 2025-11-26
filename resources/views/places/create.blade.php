@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Cadastrar Novo Local</h2>

    {{-- Mensagens de sucesso/erro --}}
    @if(session('success'))
        <div class="mb-4 text-green-600 font-medium">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('places.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Nome</label>
            <input type="text" name="nome" class="w-full border border-gray-300 rounded-md p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Endereço</label>
            <input type="text" name="endereco" class="w-full border border-gray-300 rounded-md p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Categoria</label>
            <select name="categoria_id" class="w-full border border-gray-300 rounded-md p-2" required>
                <option value="">Selecione</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Fotos (pode selecionar várias)</label>
            <input type="file" name="fotos[]" class="w-full border border-gray-300 rounded-md p-2" multiple accept="image/*">
        </div>

        {{-- Botões de ação --}}
        <div class="flex gap-3">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                Salvar
            </button>
            <a href="{{ route('places.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Voltar
            </a>
        </div>
    </form>
</div>
@endsection
