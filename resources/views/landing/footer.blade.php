<!-- Footer -->
    <footer class="py-20 gradient-hero border-t border-white/10">
        <div class="container mx-auto px-4">

            <!-- Grid superior -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">

                <!-- Logo + descrição -->
                <div>
                    <div class="flex items-center space-x-3 mb-5">
                        <div class="w-12 h-12 bg-white/90 rounded-xl flex items-center justify-center shadow-lg">
                            <i data-lucide="accessibility" class="w-7 h-7 text-blue-600"></i>
                        </div>
                        <span class="text-2xl font-extrabold text-white tracking-tight">
                            Acesso Fácil
                        </span>
                    </div>

                    <p class="text-white/85 leading-relaxed text-lg">
                        Tornando Manaus mais acessível,<br>
                        uma avaliação por vez.
                    </p>
                </div>

                <!-- Navegação -->
                <div>
                    <h3 class="text-white font-semibold text-lg mb-4 border-b border-white/20 pb-2">
                        Plataforma
                    </h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('places.public.index') }}"
                                class="text-white/80 hover:text-white transition-smooth">Explorar Locais</a></li>
                        <li><a href="#categorias"
                                class="text-white/80 hover:text-white transition-smooth">Categorias</a></li>
                        <li><a href="#mapa" class="text-white/80 hover:text-white transition-smooth">Mapa Interativo</a>
                        </li>
                        <li><a href="#" class="text-white/80 hover:text-white transition-smooth">Para Empresas</a></li>
                    </ul>
                </div>




                <div>
                    <h3 class="text-white font-semibold text-lg mb-4 border-b border-white/20 pb-2">
                        Siga-nos
                    </h3>
                    <div class="flex space-x-5">
                        <a href="https://github.com/ubir4net0"
                            class="p-3 bg-white/10 rounded-xl hover:bg-white/20 transition-smooth block">
                            <i data-lucide="github" class="w-6 h-6 text-white"></i>
                        </a>
                        <a href="https://www.instagram.com/tucandeiratech/"
                            class="p-3 bg-white/10 rounded-xl hover:bg-white/20 transition-smooth block">
                            <i data-lucide="instagram" class="w-6 h-6 text-white"></i>
                        </a>
                    </div>
                </div>
            </div>


            <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center">

                <p class="text-white/80 text-sm text-center md:text-left">
                    © 2025 TucandeiraTech — Todos os direitos reservados.
                </p>


                <a href="mailto:tucandeiratech@gmail.com"
                    class="text-white/85 hover:text-white transition-smooth text-sm mt-4 md:mt-0">
                    tucandeiratech@gmail.com
                </a>
            </div>

        </div>
    </footer>

<!-- 
    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
        });

        // Accordion functionality
        function toggleAccordion(button) {
            const content = button.nextElementSibling;
            const icon = button.querySelector('[data-lucide="chevron-down"]');
            const isActive = content.classList.contains('active');

            // Close all accordions
            document.querySelectorAll('.accordion-content').forEach(item => {
                item.classList.remove('active');
            });

            document.querySelectorAll('.accordion-trigger [data-lucide="chevron-down"]').forEach(item => {
                item.style.transform = 'rotate(0deg)';
            });

            // Toggle current accordion
            if (!isActive) {
                content.classList.add('active');
                icon.style.transform = 'rotate(180deg)';
            }
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    // Close mobile menu if open
                    mobileMenu.classList.remove('active');
                }
            });
        });

        // Scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.scroll-animate').forEach(el => {
            observer.observe(el);
        });
    </script> -->