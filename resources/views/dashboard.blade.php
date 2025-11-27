@extends('layouts.app')

@section('title', 'Dashboard - Estatísticas do Sistema')

@section('content')


<div class="relative w-full py-24 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 text-white overflow-hidden">

   
    <div class="absolute top-[-80px] right-[-80px] w-[260px] h-[260px] bg-white/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-[-80px] left-[-80px] w-[260px] h-[260px] bg-white/20 rounded-full blur-3xl"></div>

    <div class="relative z-10 text-center px-8">
        <h1 class="text-5xl md:text-6xl font-extrabold drop-shadow-lg animate-fade">
            Dashboard Analítico
        </h1>

        <p class="text-xl md:text-2xl mt-4 opacity-90 max-w-3xl mx-auto animate-fade-delay">
            Métricas completas sobre avaliações, comentários e categorias cadastradas.
        </p>

        <div class="flex justify-center gap-6 text-4xl mt-8 animate-fade-delay-2">
            <i class="fa-solid fa-chart-line animate-pulse"></i>
            <i class="fa-solid fa-chart-simple"></i>
            <i class="fa-solid fa-chart-pie animate-bounce"></i>
        </div>
    </div>
</div>




<div class="px-6 md:px-12 lg:px-24 mt-16 mb-28">

    <h2 class="text-3xl font-bold text-gray-800 mb-10 text-center">
        Estatísticas Gerais
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">


      
        <div class="glass-stat">
            <div class="title-stat">
                <i class="fa-solid fa-star text-yellow-400"></i>
                Top 5 Melhores Avaliações
            </div>
            <div id="topRatedChart" class="chart-box"></div>
        </div>


      
        <div class="glass-stat">
            <div class="title-stat">
                <i class="fa-solid fa-comments text-green-500"></i>
                Locais com Mais Comentários
            </div>
            <div id="mostCommentedChart" class="chart-box"></div>
        </div>


        
        <div class="glass-stat">
            <div class="title-stat">
                <i class="fa-solid fa-layer-group text-purple-500"></i>
                Categorias Mais Bem Avaliadas
            </div>
            <div id="categoryAverageRatingsChart" class="chart-box"></div>
        </div>


        <div class="glass-stat">
            <div class="title-stat">
                <i class="fa-solid fa-chart-column text-red-500"></i>
                Total de Avaliações por Categoria
            </div>
            <div id="categoryTotalRatingsChart" class="chart-box"></div>
        </div>

    </div>
</div>




<style>
    .glass-stat {
        @apply bg-white/40 backdrop-blur-xl p-8 rounded-2xl shadow-2xl border border-white/50
        hover:shadow-3xl hover:scale-[1.02] transition-all duration-500;
    }

    .title-stat {
        @apply flex items-center gap-3 text-2xl font-bold text-gray-800 mb-5;
    }

    .chart-box {
        height: 320px;
    }

    @keyframes fade {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-fade { animation: fade 0.8s ease-out forwards; }
    .animate-fade-delay { animation: fade 1.2s ease-out forwards; }
    .animate-fade-delay-2 { animation: fade 1.6s ease-out forwards; }
</style>





<script>
async function loadChart(element, url, params = {}) {
    const res = await fetch(url);
    let data = await res.json();

    
    if (params.type === "pie") {
        data = data.labels.map((label, i) => ({
            name: label,
            y: data.values[i]
        }));
    }

    Highcharts.chart(element, {
        chart: {
            type: params.type ?? "line",
            backgroundColor: "transparent",
            style: { fontFamily: "Inter, sans-serif" }
        },

        title: { text: params.title ?? "" },

        xAxis: params.type === "pie" ? null : {
            categories: data.labels,
            labels: { style: { color: "#555", fontWeight: "600" } }
        },

        yAxis: params.type === "pie" ? null : {
            title: { text: null },
            labels: { style: { color: "#444" } },
            gridLineColor: "#ddd"
        },

        legend: { enabled: true },

        series: [
            params.type === "pie"
                ? { name: "Total", data: data }
                : { name: params.label, data: data.values, color: params.color ?? "#3b82f6", lineWidth: 3 }
        ],

        credits: { enabled: false },

        plotOptions: {
            pie: {
                innerSize: "60%",
                dataLabels: {
                    enabled: true,
                    style: { fontSize: "14px", fontWeight: "600" }
                }
            },
            series: {
                animation: { duration: 900 },
                shadow: true
            }
        },

        ...params.extra
    });
}


document.addEventListener("DOMContentLoaded", () => {

    loadChart("topRatedChart", "/highcharts/top-rated", {
        label: "Média de Avaliação",
        color: "#facc15"
    });

    loadChart("mostCommentedChart", "/highcharts/most-commented", {
        type: "bar",
        label: "Comentários",
        color: "#22c55e"
    });

    loadChart("categoryAverageRatingsChart", "/highcharts/category-average", {
        type: "spline",
        color: "#8b5cf6",
        label: "Média"
    });

    loadChart("categoryTotalRatingsChart", "/highcharts/category-total", {
        type: "pie"
    });

});
</script>

@endsection
