<section class="py-24 bg-white scroll-animate">
    <div class="container mx-auto px-4">
        <div class="gradient-subtle rounded-3xl shadow-card p-8 md:p-16 border border-gray-200">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-semibold">
                        Comece Agora
                    </span>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mt-4 mb-6">
                        Pronto para explorar uma Manaus mais acessível?
                    </h2>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Junte-se a nós para descobrir e avaliar
                        locais acessíveis. É grátis, fácil e rápido!
                    </p>

                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-gray-900"><strong>100% Gratuito</strong> - Sem taxas escondidas ou período de teste</p>
                        </div>

                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-gray-900"><strong>Cadastro Rápido</strong> - Comece a usar em menos de 1 minuto</p>
                        </div>

                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-gray-900"><strong>Comunidade</strong> - Sua avaliação faz a diferença!</p>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}"
                           class="px-8 py-4 gradient-hero text-white rounded-lg hover:opacity-90 transition-smooth flex items-center justify-center group">
                            Criar Conta Grátis
                            <i data-lucide="arrow-right"
                               class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <div class="relative">
                    <div class="aspect-square gradient-secondary rounded-3xl shadow-glow relative overflow-hidden">
                        
                        <img src="{{ asset('images/app-screenshot.png') }}" alt="Captura de tela do app Acesso Fácil" class="w-full h-full object-cover rounded-3xl">
                        
                    
                        <div class="absolute inset-0 bg-gradient-to-br from-transparent to-gray-900/30 rounded-3xl"></div>

                        <div class="absolute top-8 left-8 bg-white p-4 rounded-xl shadow-elegant border border-gray-200">
                            <div class="flex items-center space-x-2">
                                <i data-lucide="users" class="w-5 h-5 text-blue-600"></i>
                                <span class="text-sm font-semibold text-gray-900">Junte-se à Comunidade</span>
                            </div>
                        </div>

                        <div class="absolute bottom-8 right-8 bg-white p-4 rounded-xl shadow-elegant border border-gray-200">
                            <div class="flex items-center space-x-2">
                                <i data-lucide="star" class="w-5 h-5 text-yellow-500"></i>
                                <span class="text-sm font-semibold text-gray-900">Avaliações Reais</span>
                            </div>
                        </div>

                        <div class="absolute top-1/2 left-4 transform -translate-y-1/2">
                            <div class="w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center animate-bounce">
                                <i data-lucide="wheelchair" class="w-6 h-6 text-blue-600"></i>
                            </div>
                        </div>

                        <div class="absolute top-1/4 right-4">
                            <div class="w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center animate-pulse">
                                <i data-lucide="map-pin" class="w-6 h-6 text-green-600"></i>
                            </div>
                        </div>

                        <div class="absolute bottom-1/4 left-4">
                            <div class="w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center animate-bounce" style="animation-delay: 0.5s;">
                                <i data-lucide="heart" class="w-6 h-6 text-red-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
