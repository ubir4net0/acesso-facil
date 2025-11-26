 document.addEventListener("DOMContentLoaded", () => {

    function loadChart(id, url, type, label) {
        const el = document.getElementById(id);
        if (!el) return;

        fetch(url)
            .then(res => res.json())
            .then(data => {
                new Chart(el, {
                    type: type,
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: label,
                            data: data.values,
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: type !== "doughnut" ? {
                            y: { beginAtZero: true }
                        } : {}
                    }
                });
            });
    }


    loadChart("topRatedChart", "/api/charts/top-rated", "bar", "Média de avaliações");
    loadChart("mostCommentedChart", "/api/charts/most-commented", "bar", "Comentários");
    loadChart("categoryAverageRatingsChart", "/api/charts/category-avg", "bar", "Média de estrelas");
loadChart("categoryTotalRatingsChart", "/api/charts/category-total", "bar", "Total de avaliações");

});
