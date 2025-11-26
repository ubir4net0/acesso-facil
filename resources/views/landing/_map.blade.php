<!-- Map Section -->
<section id="mapa" class="py-24 bg-white scroll-animate">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <span class="px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-semibold">
                Mapa Interativo
            </span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mt-4 mb-4">
                Explore locais acessíveis em Manaus
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Navegue pelo mapa e descubra estabelecimentos com recursos de acessibilidade próximos a você
            </p>
        </div>

        <!-- Leaflet Map -->
        <div id="map" class="w-full h-[400px] md:h-[600px] rounded-3xl shadow-xl border border-gray-200 overflow-hidden">
        </div>
    </div>
</section>
<script>
document.addEventListener("DOMContentLoaded", () => {
    if (typeof L === "undefined") {
        console.error("❌ LeafletJS não carregou.");
        return;
    }

    try {
        // Inicializa o mapa
        const map = L.map("map", {
            zoomControl: false,
            maxZoom: 18,
            minZoom: 10,
            scrollWheelZoom: true,
        }).setView([-3.1303, -60.0239], 13);

        L.control.zoom({ position: "bottomright" }).addTo(map);

        // Camada base
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19,
            attribution: "&copy; OpenStreetMap contributors"
        }).addTo(map);

        // Cluster padrão
        const markers = L.markerClusterGroup({
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            maxClusterRadius: 50,
        });

        // Popup de carregamento
        const loadingPopup = L.popup({ closeButton: false })
            .setLatLng([-3.1303, -60.0239])
            .setContent("<b>Carregando locais...</b>")
            .openOn(map);

        // Busca locais
        fetch("/api/places")
            .then(res => res.json())
            .then(locais => {
                locais.forEach(place => {
                    if (!place.latitude || !place.longitude) return;

                    // USANDO APENAS O ÍCONE PADRÃO DO LEAFLET
                    const marker = L.marker([
                        parseFloat(place.latitude),
                        parseFloat(place.longitude)
                    ]);

                    marker.bindPopup(`
                        <div style="min-width:230px;">
                            <h3 class="font-bold text-lg">${place.nome}</h3>
                            <p><strong>Categoria:</strong> ${place?.categoria?.nome ?? "Sem categoria"}</p>
                            <p><strong>Endereço:</strong> ${place.endereco ?? "Não informado"}</p>
                            <a href="/locais/${place.id}" 
                               class="bg-blue-600 text-white px-3 py-1 rounded block text-center mt-2">
                                Ver detalhes
                            </a>
                        </div>
                    `);

                    markers.addLayer(marker);
                });

                map.closePopup();
                map.addLayer(markers);

                if (markers.getLayers().length > 0) {
                    map.fitBounds(markers.getBounds(), { padding: [20, 20] });
                }
            })
            .catch(err => {
                console.error("Erro ao carregar locais:", err);
            });

        // Localização do usuário
        let userMarker = null;

        map.locate({ enableHighAccuracy: true });

        map.on("locationfound", e => {
            if (userMarker) map.removeLayer(userMarker);

            userMarker = L.circleMarker(e.latlng, {
                radius: 8,
                color: "#0ea5e9",
                fillColor: "#38bdf8",
                fillOpacity: 0.8,
                weight: 2
            })
            .bindPopup("<b>📍 Você está aqui</b>")
            .addTo(map);
        });

        map.on("locationerror", e => {
            console.warn("GPS não permitido:", e.message);
        });

        // Botão de localizar usuário
        const locateButton = L.control({ position: 'bottomright' });
        locateButton.onAdd = function() {
            const div = L.DomUtil.create('div', 'leaflet-control-locate');
            div.innerHTML = `
                <button class="bg-white border border-gray-300 rounded p-2 shadow hover:bg-gray-50" title="Minha localização" style="margin-top: 10px;">
                    📍
                </button>
            `;
            div.onclick = () => map.locate({ setView: true, maxZoom: 15 });
            return div;
        };
        locateButton.addTo(map);

    } catch (error) {
        console.error("❌ Erro ao inicializar o mapa:", error);
    }
});
</script>
