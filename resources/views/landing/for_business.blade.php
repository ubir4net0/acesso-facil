
<section class="py-24 gradient-subtle scroll-animate">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <div class="relative">
                <div class="bg-white rounded-3xl shadow-xl p-8 overflow-hidden">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Recursos do Dashboard</h3>
                    <div class="space-y-6">
                       
                        <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl hover:shadow-md transition-shadow">
                            <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <i data-lucide="medal" class="w-8 h-8 text-white"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900">Ranking Acessível</h4>
                                <p class="text-gray-600 text-sm">Top locais avaliados pela comunidade</p>
                            </div>
                        </div>

                     
                        <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-xl hover:shadow-md transition-shadow">
                            <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <i data-lucide="map" class="w-8 h-8 text-white"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900">Locais com Mais Comentários</h4>
                                <p class="text-gray-600 text-sm">Veja os locais mais avaliados em tempo real</p>
                            </div>
                        </div>

                     
                        <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-purple-50 to-purple-100 rounded-xl hover:shadow-md transition-shadow">
                            <div class="w-16 h-16 bg-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <i data-lucide="bar-chart-3" class="w-8 h-8 text-white"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900">Estatísticas Reais</h4>
                                <p class="text-gray-600 text-sm">Dados atualizados em tempo real</p>
                            </div>
                        </div>
                    </div>

                    
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-gradient-to-br from-blue-200 to-purple-200 rounded-full opacity-50"></div>
                </div>
            </div>

         
            <div>
                <span class="px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-semibold">
                    Para Usuários
                </span>

                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mt-4 mb-6 leading-tight">
                    Acompanhe os locais mais acessíveis e descubra novas experiências
                </h2>

                <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                    Veja quais empresas possuem as melhores avaliações,
                    acompanhe estatísticas reais de acessibilidade e descubra os lugares
                    mais recomendados pela comunidade do Acesso Fácil.
                </p>

                <div class="space-y-6">

                  
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 gradient-secondary rounded-xl flex items-center justify-center flex-shrink-0">
                            <i data-lucide="medal" class="w-6 h-6 text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                Ranking das Empresas Mais Acessíveis
                            </h3>
                            <p class="text-gray-600">
                                Veja quais locais têm as melhores avaliações de acessibilidade feitas por usuários reais.
                            </p>
                        </div>
                    </div>

                  
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 gradient-secondary rounded-xl flex items-center justify-center flex-shrink-0">
                            <i data-lucide="map" class="w-6 h-6 text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                Mapa Inteligente Personalizado
                            </h3>
                            <p class="text-gray-600">
                                Receba recomendações e visualize os pontos de acessibilidade mais próximos a você.
                            </p>
                        </div>
                    </div>

                 
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 gradient-secondary rounded-xl flex items-center justify-center flex-shrink-0">
                            <i data-lucide="bar-chart-3" class="w-6 h-6 text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                Estatísticas em Tempo Real
                            </h3>
                            <p class="text-gray-600">
                                Acompanhe notas médias, avaliações recentes e a evolução da acessibilidade em cada local.
                            </p>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        @auth
                            <a href="{{ route('dashboard') }}"
                                class="px-8 py-4 gradient-hero text-white rounded-lg hover:opacity-90 transition-smooth flex items-center justify-center group">
                                Acessar Dashboard
                                <i data-lucide="arrow-right"
                                    class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-8 py-4 gradient-hero text-white rounded-lg hover:opacity-90 transition-smooth flex items-center justify-center group">
                                Entrar para Acessar Dashboard
                                <i data-lucide="arrow-right"
                                    class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        @endauth
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
