<nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 gradient-hero rounded-lg flex items-center justify-center">
                    <i data-lucide="accessibility" class="w-6 h-6 text-white"></i>
                </div>
                <span class="text-xl font-bold text-gray-900">Acesso Fácil</span>
            </div>


            <div class="hidden md:flex items-center space-x-8">
                <a href="#home" class="text-gray-700 hover:text-blue-600 transition-smooth">Início</a>
                <a href="#como-funciona" class="text-gray-700 hover:text-blue-600 transition-smooth">Como Funciona</a>
                <a href="#categorias" class="text-gray-700 hover:text-blue-600 transition-smooth">Categorias</a>
                <a href="#mapa" class="text-gray-700 hover:text-blue-600 transition-smooth">Mapa</a>
                <a href="#faq" class="text-gray-700 hover:text-blue-600 transition-smooth">FAQ</a>
            </div>


            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-smooth">
                        Sair
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-smooth">
                        Entrar
                    </a>

                    <a href="{{ route('register') }}"
                        class="px-6 py-2 gradient-hero text-white rounded-lg hover:opacity-90 transition-smooth">
                        Cadastrar
                    </a>
                @endauth
            </div>

            <button id="mobile-menu-btn" class="md:hidden p-2">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>


        <div id="mobile-menu" class="mobile-menu md:hidden">
            <div class="py-4 space-y-4">
                <a href="#home" class="block text-gray-700 hover:text-blue-600 transition-smooth">Início</a>
                <a href="#como-funciona" class="block text-gray-700 hover:text-blue-600 transition-smooth">Como
                    Funciona</a>
                <a href="#categorias" class="block text-gray-700 hover:text-blue-600 transition-smooth">Categorias</a>
                <a href="#mapa" class="block text-gray-700 hover:text-blue-600 transition-smooth">Mapa</a>
                <a href="#faq" class="block text-gray-700 hover:text-blue-600 transition-smooth">FAQ</a>

                <div class="pt-4 space-y-2">
                    @auth
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                            class="w-full block px-4 py-2 text-blue-600 bg-blue-50 rounded-lg text-center">
                            Sair
                        </a>

                        <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="w-full block px-4 py-2 text-blue-600 bg-blue-50 rounded-lg text-center">
                            Entrar
                        </a>

                        <a href="{{ route('register') }}"
                            class="w-full block px-6 py-2 gradient-hero text-white rounded-lg text-center">
                            Cadastrar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>