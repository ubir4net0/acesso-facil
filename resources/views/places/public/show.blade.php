@extends('layouts.app')

@section('title', $place->nome . ' - Detalhes')

@section('content')

{{-- Incluir FontAwesome para ícones --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="min-h-screen bg-gradient-to-br from-background via-muted to-background">

    {{-- Hero Header com imagem principal do lugar --}}
    <div class="relative h-[400px] lg:h-[500px] overflow-hidden">
        <div class="absolute inset-0">
            @if ($place->images->first())
                <img
                    src="{{ asset('storage/' . $place->images->first()->path) }}"
                    alt="{{ $place->nome }}"
                    class="w-full h-full object-cover"
                >
            @else
                <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-400 flex items-center justify-center">
                    <i class="fas fa-image text-8xl text-gray-500 animate-pulse"></i>
                </div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/50 to-background"></div>
        </div>

        <div class="relative h-full flex flex-col items-center justify-center text-center px-4 z-10">
            <div class="animate-fade-in-up">
                <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-6 drop-shadow-2xl">
                    {{ $place->nome }}
                </h1>
                <p class="text-xl md:text-2xl text-white/90 mb-4 max-w-2xl mx-auto drop-shadow-lg">
                    {{ $place->endereco }}
                </p>
                <p class="text-lg text-white/80 mb-8 flex items-center justify-center gap-2">
                    <i class="fas fa-tag text-green-400"></i> {{ $place->categoria->nome }}
                </p>
                <div class="flex justify-center gap-6 text-white text-4xl">
                    <i class="fas fa-map-marker-alt text-green-400 animate-bounce"></i>
                    <i class="fas fa-compass text-blue-400 animate-pulse"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 py-8 -mt-20 relative z-10">

        {{-- Conteúdo principal --}}
        <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl p-8 mb-12 border border-green-200 transition-all hover:shadow-3xl hover:bg-white">

            {{-- Galeria --}}
            @if ($place->images->count())
                <div class="mb-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-images text-green-500"></i> Galeria de Imagens
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($place->images as $img)
                            <div class="relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all group">
                                <img src="{{ asset('storage/' . $img->path) }}" 
                                     alt="Imagem de {{ $place->nome }}" 
                                     class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Descrição --}}
            <div class="mb-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-info-circle text-blue-500"></i> Sobre o Local
                </h3>
                <p class="text-gray-700 text-lg leading-relaxed">{{ $place->descricao }}</p>
            </div>

            {{-- Média de avaliações --}}
            @php
                $media = $place->comentarios->avg('estrelas');
            @endphp
            <div class="mb-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-star text-yellow-500"></i> Avaliações
                </h3>
                <div class="bg-yellow-50 p-6 rounded-xl border border-yellow-200">
                    <div class="flex items-center gap-4">
                        <div class="text-4xl text-yellow-500">
                            ⭐
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-800">{{ number_format($media ?? 0, 1) }} / 5</p>
                            <p class="text-gray-600">Média de {{ $place->comentarios->count() }} avaliação{{ $place->comentarios->count() !== 1 ? 'ões' : 'ão' }}</p>
                        </div>
                    </div>
                    <div class="flex mt-4">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= round($media ?? 0) ? 'text-yellow-500' : 'text-gray-300' }} text-xl"></i>
                        @endfor
                    </div>
                </div>
            </div>

            <hr class="my-8 border-gray-300">

            {{-- Comentários --}}
            <div class="mb-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                    <i class="fas fa-comments text-purple-500"></i> Comentários
                </h3>
                @forelse ($place->comentarios as $coment)
                    <div class="bg-gray-50 p-6 rounded-xl mb-4 shadow-md hover:shadow-lg transition-all">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="flex">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $coment->estrelas ? 'text-yellow-500' : 'text-gray-300' }} text-lg"></i>
                                @endfor
                            </div>
                            <p class="text-gray-600 text-sm">{{ $coment->estrelas }} / 5</p>
                        </div>
                        <p class="font-semibold text-gray-800 mb-2">{{ $coment->user->name }}</p>
                        <p class="text-gray-700">{{ $coment->comentario }}</p>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <i class="fas fa-comment-slash text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-lg">Nenhum comentário ainda. Seja o primeiro a avaliar!</p>
                    </div>
                @endforelse
            </div>

            <hr class="my-8 border-gray-300">

            {{-- Novo comentário --}}
            @auth
                <div>
                    <h4 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-edit text-green-500"></i> Deixe seu Feedback
                    </h4>

                    @if(session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded-xl mb-4 border border-green-200 flex items-center gap-2">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('places.public.comentar', $place) }}" class="space-y-6">
                        @csrf
                        <div>
                            <label for="comentario" class="block text-lg font-medium text-gray-700 mb-2">Comentário</label>
                            <textarea name="comentario" id="comentario" placeholder="Escreva um comentário..." 
                                      class="w-full border-2 border-gray-300 rounded-xl p-4 focus:ring-4 focus:ring-green-400 focus:border-green-500 transition-all shadow-md hover:shadow-lg resize-none" rows="4" required></textarea>
                        </div>

                        {{-- Avaliação com estrelas interativas --}}
                        <div>
                            <label class="block text-lg font-medium text-gray-700 mb-2">Avaliação</label>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-gray-600">Clique nas estrelas para avaliar:</span>
                                <div id="star-rating" class="flex gap-1 cursor-pointer">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star text-3xl text-gray-300 hover:text-yellow-400 transition-colors star" data-value="{{ $i }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <p id="rating-text" class="text-sm text-gray-500">Nenhuma avaliação selecionada</p>
                            <input type="hidden" name="estrelas" id="estrelas" required>
                        </div>

                        <button type="submit" class="bg-gradient-to-r from-green-500 to-green-600 text-white px-8 py-4 rounded-xl hover:from-green-600 hover:to-green-700 hover:scale-105 transition-all flex items-center gap-3 shadow-lg">
                            <i class="fas fa-paper-plane text-xl"></i> Enviar Comentário
                        </button>
                    </form>
                </div>
            @else
                <div class="text-center py-8 bg-gray-50 rounded-xl">
                    <i class="fas fa-sign-in-alt text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-600 text-lg mb-4">
                        Faça login para comentar e avaliar este local.
                    </p>
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-xl hover:from-blue-600 hover:to-blue-700 hover:scale-105 transition-all shadow-lg">
                        <i class="fas fa-user text-lg"></i> Fazer Login
                    </a>
                </div>
            @endauth
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

{{-- JavaScript para estrelas interativas --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('#star-rating .star');
        const ratingText = document.getElementById('rating-text');
        const hiddenInput = document.getElementById('estrelas');
        let selectedRating = 0;

        stars.forEach(star => {
            star.addEventListener('click', function() {
                selectedRating = parseInt(this.dataset.value);
                updateStars(selectedRating);
                hiddenInput.value = selectedRating;
                updateRatingText(selectedRating);
            });

            star.addEventListener('mouseover', function() {
                const hoverValue = parseInt(this.dataset.value);
                updateStars(hoverValue);
            });

            star.addEventListener('mouseout', function() {
                updateStars(selectedRating);
            });
        });

        function updateStars(rating) {
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-yellow-500');
                } else {
                    star.classList.remove('text-yellow-500');
                    star.classList.add('text-gray-300');
                }
            });
        }

        function updateRatingText(rating) {
            const texts = [
                'Nenhuma avaliação selecionada',
                '1 estrela - Muito ruim',
                '2 estrelas - Ruim',
                '3 estrelas - Regular',
                '4 estrelas - Bom',
                '5 estrelas - Excelente'
            ];
            ratingText.textContent = texts[rating];
        }
    });
</script>

@endsection