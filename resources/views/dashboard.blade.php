@extends('layouts.app')

@section('title', 'Dashboard - Estatísticas do Sistema')

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="min-h-screen bg-gradient-to-br from-background via-muted to-background">


        <div class="relative h-[350px] md:h-[450px] overflow-hidden">
            <img src="{{ asset('images/teatro-amazonas.jpg') }}" alt="Dashboard" class="w-full h-full object-cover">

            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/50 to-transparent"></div>

            <div class="absolute inset-0 flex flex-col justify-center items-center text-center px-6 animate-fade-in-up">
                <h1 class="text-5xl md:text-6xl font-extrabold text-white drop-shadow-2xl">
                    Dashboard Estatístico
                </h1>
                <p class="text-xl md:text-2xl text-white/90 mt-4 max-w-2xl">
                    Visualize insights, avaliações e informações importantes sobre os locais cadastrados!
                </p>

                <div class="flex gap-6 text-4xl text-white mt-6">
                    <i class="fa-solid fa-chart-pie animate-pulse text-blue-400"></i>
                    <i class="fa-solid fa-chart-line animate-bounce text-green-400"></i>
                </div>
            </div>
        </div>


        <div class="px-6 md:px-10 lg:px-20 -mt-20 relative z-10 mb-20">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-10">


                <div class="bg-white/95 backdrop-blur-xl p-8 rounded-2xl shadow-2xl border border-blue-200 
                            animate-fade-in-up hover:shadow-3xl hover:scale-[1.02] transition-all duration-500">

                    <div class="flex items-center gap-3 mb-6">
                        <i class="fa-solid fa-star text-yellow-500 text-3xl"></i>
                        <h2 class="text-2xl font-bold text-gray-800">Top 5 Melhores Avaliações</h2>
                    </div>

                    <canvas id="topRatedChart" height="140"></canvas>
                </div>



                <div class="bg-white/95 backdrop-blur-xl p-8 rounded-2xl shadow-2xl border border-green-200 
                            animate-fade-in-up hover:shadow-3xl hover:scale-[1.02] transition-all duration-500"
                    style="animation-delay:0.15s">

                    <div class="flex items-center gap-3 mb-6">
                        <i class="fa-solid fa-comments text-green-500 text-3xl"></i>
                        <h2 class="text-2xl font-bold text-gray-800">Locais com Mais Comentários</h2>
                    </div>

                    <canvas id="mostCommentedChart" height="140"></canvas>
                </div>



                <div class="bg-white/95 backdrop-blur-xl p-8 rounded-2xl shadow-2xl border border-purple-200 
                            animate-fade-in-up hover:shadow-3xl hover:scale-[1.02] transition-all duration-500"
                    style="animation-delay:0.25s">

                    <div class="flex items-center gap-3 mb-6">
                        <i class="fa-solid fa-layer-group text-purple-500 text-3xl"></i>
                        <h2 class="text-2xl font-bold text-gray-800">Categorias Mais Bem Avaliadas</h2>
                    </div>

                    <canvas id="categoryAverageRatingsChart" height="140"></canvas>
                </div>



                <div class="bg-white/95 backdrop-blur-xl p-8 rounded-2xl shadow-2xl border border-red-200  
                            animate-fade-in-up hover:shadow-3xl hover:scale-[1.02] transition-all duration-500"
                    style="animation-delay:0.35s">

                    <div class="flex items-center gap-3 mb-6">
                        <i class="fa-solid fa-chart-column text-red-500 text-3xl"></i>
                        <h2 class="text-2xl font-bold text-gray-800">Total de Avaliações por Categoria</h2>
                    </div>

                    <canvas id="categoryTotalRatingsChart" height="140"></canvas>
                </div>

            </div>
        </div>
    </div>


    <style>
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(40px);
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

<script>
async function loadChart(id, url, type, options = {}) {
    const ctx = document.getElementById(id);
    if (!ctx) return;

    try {
        const response = await fetch(url);
        const data = await response.json();

        new Chart(ctx, {
            type: type,
            data: {
                labels: data.labels ?? [],
                datasets: [{
                    label: options.label ?? '',
                    data: data.values ?? [],
                    backgroundColor: options.backgroundColor ?? "rgba(59,130,246,0.6)",
                    borderColor: options.borderColor ?? "#3b82f6",
                    borderWidth: 2,
                    fill: options.fill ?? false,
                    tension: options.tension ?? 0.4
                }]
            },
            options: options.chartOptions ?? {}
        });
    } catch (error) {
        console.error("Erro ao carregar gráfico:", error);
    }
}

document.addEventListener("DOMContentLoaded", () => {

    // 1) Radar – Top Avaliações
    loadChart(
        "topRatedChart",
        "/api/charts/top-rated",
        "radar",
        { label: "Média de Avaliação" }
    );

    // 2) Barras horizontais – Mais comentados
    loadChart(
        "mostCommentedChart",
        "/api/charts/most-commented",
        "bar",
        {
            label: "Comentários",
            chartOptions: {
                indexAxis: 'y',
                scales: { x: { beginAtZero: true } }
            }
        }
    );

    // 3) Linha – Média das categorias
    loadChart(
        "categoryAverageRatingsChart",
        "/api/charts/category-average",
        "line",
        {
            label: "Média por Categoria",
            fill: true,
            backgroundColor: "rgba(139,92,246,0.25)",
            borderColor: "#8b5cf6",
            tension: 0.6
        }
    );

    // 4) Doughnut – Total de avaliações por categoria
    loadChart(
        "categoryTotalRatingsChart",
        "/api/charts/category-total",
        "doughnut",
        {
            label: "Quantidade",
            backgroundColor: [
                "#ef4444","#3b82f6","#10b981","#f59e0b","#a855f7",
                "#06b6d4","#84cc16","#f472b6"
            ]
        }
    );

});
</script>







@endsection