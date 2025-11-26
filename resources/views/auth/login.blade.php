@extends('layouts.app')

@php($full = true)

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="min-h-screen w-full flex items-center justify-center px-4 relative">

    {{-- Fundo full --}}
    <div class="absolute inset-0 overflow-hidden">
        <img src="{{ asset('images/login-background.jpg') }}"
             class="w-full h-full object-cover opacity-20">
        <div class="absolute inset-0 bg-gradient-to-br
            from-blue-500/30 via-purple-500/30 to-pink-500/30">
        </div>
    </div>

    <div class="relative bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl p-8
                w-full max-w-md border border-blue-200 hover:shadow-3xl
                transition-all animate-fade-in-up">

        <div class="text-center mb-8">
            <i class="fas fa-sign-in-alt text-6xl text-blue-500 mb-4 animate-bounce"></i>
            <h1 class="text-3xl font-extrabold text-gray-800 mb-2">Bem-vindo de volta!</h1>
            <p class="text-gray-600">Faça login para acessar sua conta</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            {{-- Email --}}
            <div>
                <label class="block text-lg font-medium text-gray-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-envelope text-blue-500"></i> Email
                </label>

                <input id="email" type="email"
                    class="w-full border-2 border-gray-300 rounded-xl p-4
                    focus:ring-4 focus:ring-blue-400 focus:border-blue-500
                    shadow-md hover:shadow-lg transition"
                    name="email" value="{{ old('email') }}" required autofocus>

                @error('email')
                    <p class="text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Senha --}}
            <div>
                <label class="block text-lg font-medium text-gray-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-lock text-green-500"></i> Senha
                </label>

                <input id="password" type="password"
                    class="w-full border-2 border-gray-300 rounded-xl p-4
                    focus:ring-4 focus:ring-green-400 focus:border-green-500
                    shadow-md hover:shadow-lg transition"
                    name="password" required>

                @error('password')
                    <p class="text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Lembrar --}}
            <div class="flex items-center">
                <input type="checkbox" id="remember_me"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm"
                    name="remember">
                <label for="remember_me" class="ml-2 text-sm text-gray-600">
                    Lembrar de mim
                </label>
            </div>

            {{-- Ações --}}
            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-gray-600 hover:text-gray-900 underline transition">
                        Esqueceu a senha?
                    </a>
                @endif

                <button
                    class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-3 rounded-xl
                    hover:from-blue-600 hover:to-purple-700 hover:scale-105 transition shadow-lg
                    flex items-center gap-2">
                    <i class="fas fa-sign-in-alt"></i> Entrar
                </button>
            </div>
        </form>

        <div class="mt-8 text-center">
            <p class="text-gray-600 text-sm">
                Não tem uma conta?
                <a href="{{ route('register') }}"
                   class="text-blue-600 hover:text-blue-800 underline transition">
                    Cadastre-se
                </a>
            </p>
        </div>

    </div>

</div>

<style>
    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
        opacity: 0;
        transform: translateY(30px);
    }
    @keyframes fadeInUp {
        to { opacity: 1; transform: translateY(0); }
    }
</style>

@endsection
