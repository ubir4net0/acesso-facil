@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 mt-6">

    {{-- Título + botão --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Locais Cadastrados</h1>

        @can('access')
        <button 
            onclick="openCreateModal()"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
            + Novo Local
        </button>
        @endcan
    </div>

    {{-- Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach ($places as $place)
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">

            {{-- Imagem --}}
            <div class="h-48 bg-gray-200 overflow-hidden">
                @if ($place->images->first())
                    <img src="{{ asset('storage/'.$place->images->first()->path) }}"
                        class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <i data-lucide="image" class="w-12 h-12"></i>
                    </div>
                @endif
            </div>

            <div class="p-4">
                <h2 class="text-xl font-semibold">{{ $place->nome }}</h2>
                <p class="text-gray-500 text-sm">{{ $place->categoria->nome ?? 'Sem categoria' }}</p>
                <p class="text-gray-700 mt-2 text-sm">
                    <i data-lucide="map-pin" class="inline w-4 h-4"></i>
                    {{ $place->endereco }}
                </p>
            </div>

            <div class="p-4 border-t flex justify-between items-center">

                {{-- Ver --}}
                <a href="{{ route('places.show', $place) }}"
                    class="text-blue-600 hover:underline text-sm">
                    Ver
                </a>

                @can('access')
                <div class="flex gap-2">

                    {{-- Editar --}}
                    <button 
                        onclick="openEditModal({{ $place->id }}, '{{ $place->nome }}', '{{ $place->endereco }}', {{ $place->categoria_id }})"
                        class="px-3 py-1 bg-yellow-500 text-white rounded text-sm hover:bg-yellow-600">
                        Editar
                    </button>

                    {{-- Excluir --}}
                    <form action="{{ route('places.destroy', $place) }}" method="POST"
                        onsubmit="return confirm('Deseja excluir este local?')">
                        @csrf @method('DELETE')
                        <button class="px-3 py-1 bg-red-600 text-white rounded text-sm hover:bg-red-700">
                            Excluir
                        </button>
                    </form>

                </div>
                @endcan

            </div>
        </div>
        @endforeach

    </div>

    <div class="mt-6">
        {{ $places->links() }}
    </div>
</div>




{{-- ======================================== --}}
{{--            MODAL DE CRIAÇÃO              --}}
{{-- ======================================== --}}

<div id="createModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden justify-center items-center z-50">
    <div class="bg-white w-full max-w-lg rounded-xl p-6 shadow-xl">

        <h2 class="text-xl font-bold mb-4">Cadastrar Novo Local</h2>

        <form action="{{ route('places.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="font-medium">Nome</label>
                <input type="text" name="nome" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-3">
                <label class="font-medium">Endereço</label>
                <input type="text" name="endereco" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-3">
                <label class="font-medium">Categoria</label>
                <select name="categoria_id" class="w-full border rounded p-2" required>
                    <option value="">Selecione</option>
                    @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="font-medium">Fotos</label>
               <input type="file" name="fotos[]" multiple>

                    class="w-full border rounded p-2">
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeCreateModal()"
                    class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                    Cancelar
                </button>

                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Salvar
                </button>
            </div>

        </form>

    </div>
</div>




{{-- ======================================== --}}
{{--              MODAL DE EDIÇÃO            --}}
{{-- ======================================== --}}

<div id="editModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden justify-center items-center z-50">
    <div class="bg-white w-full max-w-lg rounded-xl p-6 shadow-xl">

        <h2 class="text-xl font-bold mb-4">Editar Local</h2>

        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="font-medium">Nome</label>
                <input id="editNome" type="text" name="nome" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-3">
                <label class="font-medium">Endereço</label>
                <input id="editEndereco" type="text" name="endereco" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-3">
                <label class="font-medium">Categoria</label>
                <select id="editCategoria" name="categoria_id" class="w-full border rounded p-2" required>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="font-medium">Adicionar novas fotos</label>
                <input type="file" name="fotos[]" multiple accept="image/*"
                    class="w-full border rounded p-2">
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeEditModal()"
                    class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                    Cancelar
                </button>

                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Atualizar
                </button>
            </div>

        </form>

    </div>
</div>




{{-- =========================== --}}
{{--        JAVASCRIPT          --}}
{{-- =========================== --}}
<script>
    // Abrir modal de criação
    function openCreateModal() {
        document.getElementById("createModal").classList.remove("hidden");
        document.getElementById("createModal").classList.add("flex");
    }
    function closeCreateModal() {
        document.getElementById("createModal").classList.add("hidden");
        document.getElementById("createModal").classList.remove("flex");
    }

    // Abrir modal de edição
    function openEditModal(id, nome, endereco, categoria_id) {

        document.getElementById("editForm").action = "/places/" + id;
        document.getElementById("editNome").value = nome;
        document.getElementById("editEndereco").value = endereco;
        document.getElementById("editCategoria").value = categoria_id;

        document.getElementById("editModal").classList.remove("hidden");
        document.getElementById("editModal").classList.add("flex");
    }
    function closeEditModal() {
        document.getElementById("editModal").classList.add("hidden");
        document.getElementById("editModal").classList.remove("flex");
    }
</script>

@endsection
