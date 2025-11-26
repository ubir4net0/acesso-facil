<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Acesso Fácil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-green-50 via-blue-50 to-green-50 min-h-screen">

    <div class="flex min-h-screen">

        <!-- Imagem lateral -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
            <img src="{{ asset('images/desktop-wallpaper-arena-da-amazonia-besthq-manaus.jpg') }}"
                alt="Arena da Amazônia - Manaus" class="object-cover w-full h-full">

            <div class="absolute inset-0 bg-gradient-to-br from-green-600/90 to-blue-600/90 flex items-center justify-center">
                <div class="text-center text-white px-12">
                    <i class="fas fa-universal-access text-7xl mb-6 animate-pulse"></i>
                    <h1 class="text-5xl font-bold mb-4">Acesso Fácil</h1>
                    <p class="text-xl opacity-90">Descubra locais acessíveis em Manaus</p>
                    <div class="mt-8 flex justify-center gap-4">
                        <i class="fas fa-wheelchair text-3xl animate-bounce"></i>
                        <i class="fas fa-map-marked-alt text-3xl animate-pulse"></i>
                        <i class="fas fa-heart text-3xl animate-bounce"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulário -->
        <div class="flex-1 flex items-center justify-center p-8">
            <div class="w-full max-w-md">

                <!-- Logo mobile -->
                <div class="lg:hidden text-center mb-8">
                    <i class="fas fa-universal-access text-6xl text-green-600 mb-4"></i>
                    <h1 class="text-3xl font-bold text-gray-800">Acesso Fácil</h1>
                </div>

                <!-- Card -->
                <div class="bg-white rounded-2xl shadow-2xl p-8 border border-gray-100">

                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Entrar</h2>
                        <p class="text-gray-600">Bem-vindo de volta!</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-6">
                            <label for="email"
                                class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fas fa-envelope text-blue-600"></i> E-mail
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl 
                                focus:ring-4 focus:ring-blue-400 focus:border-blue-500 transition-all outline-none"
                                placeholder="seu@email.com">

                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Senha -->
                        <div class="mb-6">
                            <label for="password"
                                class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fas fa-lock text-blue-600"></i> Senha
                            </label>
                            <input type="password" id="password" name="password" required
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl 
                                focus:ring-4 focus:ring-blue-400 focus:border-blue-500 transition-all outline-none"
                                placeholder="Sua senha">

                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lembrar senha -->
                        <div class="mb-6 flex items-center justify-between">
                            <label class="flex items-center gap-2 text-gray-700 text-sm">
                                <input type="checkbox" name="remember"
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-400">
                                Lembrar-me
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-sm text-blue-600 hover:text-blue-700 hover:underline">
                                    Esqueci minha senha
                                </a>
                            @endif
                        </div>

                        <!-- Botão -->
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold py-4 rounded-xl 
                            hover:from-blue-600 hover:to-blue-700 hover:scale-105 transition-all shadow-lg flex items-center justify-center gap-3">
                            <i class="fas fa-sign-in-alt text-xl"></i>
                            Entrar
                        </button>

                        <!-- Link para registro -->
                        <div class="mt-6 text-center">
                            <p class="text-gray-600">
                                Ainda não tem uma conta?
                                <a href="{{ route('register') }}"
                                    class="text-blue-600 font-semibold hover:text-blue-700 hover:underline transition-all">
                                    Criar conta
                                </a>
                            </p>
                        </div>

                    </form>
                </div>

                <!-- Footer -->
                <div class="mt-6 text-center text-sm text-gray-500">
                    <p>© 2025 Acesso Fácil. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>

    </div>

</body>

</html>
