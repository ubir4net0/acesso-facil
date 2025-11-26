@extends('layouts.app')

@section('title', 'Explorar Locais - Acesso Fácil')

@section('content')

{{-- Incluir FontAwesome para ícones --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="min-h-screen bg-gradient-to-br from-background via-muted to-background">

    {{-- Hero Header com Teatro Amazonas --}}
    <div class="relative h-[400px] lg:h-[500px] overflow-hidden">
        <div class="absolute inset-0">
            <img
                src="{{ asset('images/teatro-amazonas.jpg') }}"
                alt="Teatro Amazonas"
                class="w-full h-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/50 to-background"></div>
        </div>

        <div class="relative h-full flex flex-col items-center justify-center text-center px-4 z-10">
            <div class="animate-fade-in-up">
                <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-6 drop-shadow-2xl">
                    Explorar Locais
                </h1>
                <p class="text-xl md:text-2xl text-white/90 mb-8 max-w-2xl mx-auto drop-shadow-lg">
                    Descubra lugares incríveis perto de você com filtros avançados!
                </p>
                <div class="flex justify-center gap-6 text-white text-4xl">
                    <i class="fas fa-map-marker-alt text-green-400 animate-bounce"></i>
                    <i class="fas fa-compass text-blue-400 animate-pulse"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 py-8 -mt-20 relative z-10">

        {{-- Filtro e busca --}}
        <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl p-8 mb-12 border border-green-200 transition-all hover:shadow-3xl hover:bg-white">
            <form method="GET" class="flex flex-col lg:flex-row gap-6 items-end">
                {{-- Campo de busca --}}
                <div class="flex-1 relative">
                    <label for="busca" class="block text-lg font-semibold text-gray-800 mb-2 flex items-center gap-2">
                        <i class="fas fa-search text-green-500"></i> Pesquisar Locais
                    </label>
                    <input type="text" id="busca" name="busca" value="{{ request('busca') }}" 
                           placeholder="Digite o nome do local, cidade ou palavra-chave..." 
                           class="w-full border-2 border-gray-300 rounded-xl p-4 pl-12 focus:ring-4 focus:ring-green-400 focus:border-green-500 transition-all shadow-md hover:shadow-lg">
                    <i class="fas fa-search absolute left-4 top-12 text-gray-400 text-xl"></i>
                </div>

                {{-- Filtro de categoria --}}
                <div class="lg:w-1/3">
                    <label for="categoria_id" class="block text-lg font-semibold text-gray-800 mb-2 flex items-center gap-2">
                        <i class="fas fa-filter text-blue-500"></i> Filtrar por Categoria
                    </label>
                    <select id="categoria_id" name="categoria_id" 
                            class="w-full border-2 border-gray-300 rounded-xl p-4 focus:ring-4 focus:ring-blue-400 focus:border-blue-500 transition-all shadow-md hover:shadow-lg">
                        <option value="">Todas as categorias</option>
                        @foreach ($categorias as $cat)
                            <option value="{{ $cat->id }}" {{ request('categoria_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Botões --}}
                <div class="flex gap-4">
                    <button type="submit" class="bg-gradient-to-r from-green-500 to-green-600 text-white px-8 py-4 rounded-xl hover:from-green-600 hover:to-green-700 hover:scale-110 transition-all flex items-center gap-3 shadow-lg">
                        <i class="fas fa-filter text-xl"></i> Aplicar Filtros
                    </button>
                    <a href="{{ route('places.public.index') }}" class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-8 py-4 rounded-xl hover:from-gray-600 hover:to-gray-700 hover:scale-110 transition-all flex items-center gap-3 shadow-lg">
                        <i class="fas fa-times text-xl"></i> Limpar Tudo
                    </a>
                </div>
            </form>
        </div>

        {{-- Lista de locais --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse ($places as $place)
                <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl hover:shadow-3xl hover:scale-105 transition-all duration-500 overflow-hidden group animate-fade-in-up" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                    {{-- Imagem principal --}}
                    @if ($place->images->first())
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('storage/' . $place->images->first()->path) }}" 
                                 alt="Imagem de {{ $place->nome }}" 
                                 class="w-full h-56 object-cover transition-transform duration-700 group-hover:scale-125">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                    @else
                        <div class="w-full h-56 bg-gradient-to-br from-gray-200 to-gray-400 flex items-center justify-center rounded-t-2xl text-gray-500">
                            <i class="fas fa-image text-5xl animate-pulse"></i>
                            <span class="ml-2">Sem imagem</span>
                        </div>
                    @endif

                    {{-- Conteúdo do card --}}
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-green-600 transition-colors">{{ $place->nome }}</h3>
                        <p class="text-gray-600 text-base mb-4 leading-relaxed">{{ Str::limit($place->descricao, 150) }}</p>

                        {{-- Categoria e média --}}
                        <div class="flex items-center justify-between mb-4">
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium flex items-center gap-1">
                                <i class="fas fa-tag"></i> {{ $place->categoria?->nome ?? 'Sem categoria' }}
                            </span>
                            @php $media = $place->comentarios->avg('estrelas'); @endphp
                            <div class="flex items-center gap-2 bg-yellow-100 px-3 py-1 rounded-full">
                                <span class="text-yellow-700 text-sm font-semibold">{{ number_format($media ?? 0, 1) }}/5</span>
                                <div class="flex">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= round($media ?? 0) ? 'text-yellow-500' : 'text-gray-300' }} text-sm"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('places.public.show', $place) }}" 
                           class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-xl hover:from-blue-600 hover:to-blue-700 hover:scale-105 transition-all shadow-lg">
                            <i class="fas fa-eye text-lg"></i> Ver Detalhes
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <i class="fas fa-search text-8xl text-gray-300 mb-6 animate-bounce"></i>
                    <h3 class="text-2xl font-semibold text-gray-600 mb-4">Ops! Nenhum local encontrado.</h3>
                    <p class="text-gray-500 text-lg">Tente ajustar os filtros ou explore outras categorias.</p>
                    <a href="{{ route('places.public.index') }}" class="mt-4 inline-block bg-green-500 text-white px-6 py-3 rounded-xl hover:bg-green-600 transition-all">
                        <i class="fas fa-refresh"></i> Recarregar
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Paginação --}}
        <div class="mt-12 flex justify-center">
            <div class="bg-white/90 backdrop-blur-md rounded-xl shadow-lg p-4">
                {{ $places->links() }}
            </div>
        </div>
    </div>
</div>

{{-- Animações customizadas --}}
<style>
    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
        opacity: 0;
        transform: translateY(30px);
    }
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .hover\:shadow-3xl:hover {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
</style>

@endsection
