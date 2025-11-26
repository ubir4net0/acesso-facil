<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Acesso Fácil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-green-50 via-blue-50 to-green-50 min-h-screen">

    <div class="flex min-h-screen">


        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
            <img src="{{ asset('images/b2ap3_large_teatro-amazonas-divulg.jpg') }}"
                alt="Teatro Amazonas - Manaus" class="object-cover w-full h-full">
            <div
                class="absolute inset-0 bg-gradient-to-br from-green-600/90 to-blue-600/90 flex items-center justify-center">
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


        <div class="flex-1 flex items-center justify-center p-8">
            <div class="w-full max-w-md">


                <div class="lg:hidden text-center mb-8">
                    <i class="fas fa-universal-access text-6xl text-green-600 mb-4"></i>
                    <h1 class="text-3xl font-bold text-gray-800">Acesso Fácil</h1>
                </div>

                <div class="bg-white rounded-2xl shadow-2xl p-8 border border-gray-100">

                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Criar Conta</h2>
                        <p class="text-gray-600">Junte-se à nossa comunidade!</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf


                        <div class="mb-6">
                            <label for="name"
                                class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fas fa-user text-green-600"></i> Nome Completo
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl 
                                focus:ring-4 focus:ring-green-400 focus:border-green-500 transition-all outline-none"
                                placeholder="Seu nome completo">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-6">
                            <label for="email"
                                class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fas fa-envelope text-green-600"></i> E-mail
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl 
                                focus:ring-4 focus:ring-green-400 focus:border-green-500 transition-all outline-none"
                                placeholder="seu@email.com">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-6">
                            <label for="password"
                                class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fas fa-lock text-green-600"></i> Senha
                            </label>
                            <input type="password" id="password" name="password" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl 
                                focus:ring-4 focus:ring-green-400 focus:border-green-500 transition-all outline-none"
                                placeholder="Mínimo 8 caracteres">
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-6">
                            <label for="password_confirmation"
                                class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fas fa-lock text-green-600"></i> Confirmar Senha
                            </label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl 
                                focus:ring-4 focus:ring-green-400 focus:border-green-500 transition-all outline-none"
                                placeholder="Digite a senha novamente">
                            @error('password_confirmation')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <button type="submit"
                            class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white font-bold py-4 rounded-xl 
                            hover:from-green-600 hover:to-green-700 hover:scale-105 transition-all shadow-lg flex items-center justify-center gap-3">
                            <i class="fas fa-user-plus text-xl"></i>
                            Criar Conta
                        </button>


                        <div class="mt-6 text-center">
                            <p class="text-gray-600">
                                Já tem uma conta?
                                <a href="{{ route('login') }}"
                                    class="text-green-600 font-semibold hover:text-green-700 hover:underline transition-colors">
                                    Faça login aqui
                                </a>
                            </p>
                        </div>

                    </form>
                </div>

                <div class="mt-6 text-center text-sm text-gray-500">
                    <p>© 2025 Acesso Fácil. Todos os direitos reservados.</p>
                </div>

            </div>
        </div>

    </div>

</body>

</html>