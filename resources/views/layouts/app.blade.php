<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/accessibility.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/accessibility.png') }}">


    <meta name="description" content="Acesso Fácil - Descubra locais acessíveis em Manaus.">
    <meta name="keywords" content="acessibilidade, Manaus, inclusão, locais acessíveis, deficiência">
    <meta name="author" content="Acesso Fácil">


    @foreach (['success', 'error', 'warning', 'info'] as $type)
        @if (session($type))
            <meta name="swal-{{ $type }}" content="{{ session($type) }}">
        @endif
    @endforeach

    <title>@yield('title', 'Acesso Fácil - Uma cidade mais acessível para todos | Manaus')</title>

    <script src="https://cdn.tailwindcss.com"></script>


    <script src="https://unpkg.com/lucide@latest"></script>


    <link href="https://unpkg.com/sweet-icons/dist/sweet-icons.css" rel="stylesheet">



    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>


    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap">


    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>



    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        :root {
            --primary: 221 83% 53%;
            --secondary: 160 60% 45%;
        }

        .gradient-hero {
            background: linear-gradient(135deg, hsl(var(--primary)), hsl(var(--secondary)));
        }

        .transition-smooth {
            transition: .3s ease;
        }

        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height .3s ease;
        }

        .mobile-menu.active {
            max-height: 500px;
        }
    </style>
</head>

<body class="antialiased bg-gray-50">


    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">


                <a href="/" class="flex items-center space-x-3">
                    <div class="w-10 h-10 gradient-hero rounded-lg flex items-center justify-center">
                        <i data-lucide="accessibility" class="w-6 h-6 text-white"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-900">Acesso Fácil</span>
                </a>


                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="nav-link">Início</a>
                    <a href="{{ route('places.public.index') }}" class="nav-link">Locais</a>
                    <a href="/#faq" class="nav-link">FAQ</a>
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
                    <a href="/" class="mobile-link">Início</a>
                    <a href="{{ route('places.public.index') }}" class="mobile-link">Locais</a>
                    <a href="/#faq" class="mobile-link">FAQ</a>

                    <div class="pt-4 space-y-2">
                        @auth
                            <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="w-full px-4 py-2 text-blue-600 bg-blue-50 rounded-lg">Sair</button>
                        @else
                            <a href="{{ route('login') }}" class="mobile-btn">Entrar</a>
                            <a href="{{ route('register') }}" class="mobile-btn bg-blue-600 text-white">Cadastrar</a>
                        @endauth
                    </div>
                </div>
            </div>

        </div>
    </nav>


    @if (!empty($full))
        @yield('content')
    @else
        <div class="container mx-auto mt-6 px-4">
            @yield('content')
        </div>
    @endif


    <script>
        lucide.createIcons();

        document.getElementById('mobile-menu-btn').addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.toggle('active');
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            ['success', 'error', 'warning', 'info'].forEach(type => {
                const meta = document.querySelector(`meta[name="swal-${type}"]`);
                if (meta) Swal.fire({ icon: type, title: meta.content });
            });
        });
    </script>


    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>

    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>



</body>

</html>