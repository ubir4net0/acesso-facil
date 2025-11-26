<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <meta name="description" content="Acesso Fácil - Descubra locais acessíveis em Manaus.">
    <meta name="keywords" content="acessibilidade, Manaus, inclusão, deficiência, locais acessíveis">
    <meta name="author" content="Acesso Fácil">

    <title>Acesso Fácil - Uma cidade mais acessível para todos</title>


    <script src="https://cdn.tailwindcss.com"></script>


    <script src="https://unpkg.com/lucide@latest"></script>


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css">
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>


    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap">

    <style>
        body {
            font-family: "Inter", sans-serif;
        }

        .gradient-hero {
            background: linear-gradient(135deg, hsl(221 83% 53%), hsl(160 60% 45%));
        }

        .scroll-animate {
            opacity: 0;
            transform: translateY(40px);
            transition: all .6s ease-out;
        }

        .scroll-animate.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height .3s ease-out;
        }

        .mobile-menu.active {
            max-height: 400px;
        }


        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height .3s ease-out;
        }

        .accordion-content.active {
            max-height: 300px;
        }
    </style>
</head>

<body class="antialiased bg-gray-50">


    @include('landing.navbar')

    @include('landing.hero')


    @include('landing.features')


    @include('landing.how_it_works')

    @include('landing.categories')


    @include('landing.for_users')


    @include('landing.testimonials')


    @include('landing.for_business')


    @include('landing.cta')

    @include('landing._map')

    @include('landing.faq')


    @include('landing.footer')



    <script>

        lucide.createIcons();


        const mobileBtn = document.getElementById("mobile-menu-btn");
        const mobileMenu = document.getElementById("mobile-menu");

        mobileBtn?.addEventListener("click", () => {
            mobileMenu.classList.toggle("active");
        });


        function toggleAccordion(button) {
            const content = button.nextElementSibling;
            const icon = button.querySelector("[data-lucide='chevron-down']");
            const isOpen = content.classList.contains("active");

            document.querySelectorAll(".accordion-content")
                .forEach(c => c.classList.remove("active"));

            document.querySelectorAll(".accordion-trigger [data-lucide='chevron-down']")
                .forEach(i => i.style.transform = "rotate(0deg)");

            if (!isOpen) {
                content.classList.add("active");
                icon.style.transform = "rotate(180deg)";
            }
        }


        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                }
            });
        }, { threshold: 0.2 });

        document.querySelectorAll(".scroll-animate")
            .forEach(el => observer.observe(el));
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