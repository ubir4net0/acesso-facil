<section id="mapa" class="py-28 bg-gray-50 scroll-animate">
    <div class="container mx-auto px-4">

        <div class="text-center mb-16">
            <span class="px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-semibold">
                Mapa Interativo
            </span>

            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mt-4 mb-4">
                Explore Locais Acessíveis em Manaus
            </h2>

            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Filtre por categoria e visualize no mapa os pontos acessíveis próximos a você.
            </p>
        </div>

        <div class="mb-8 flex flex-wrap justify-center gap-3" id="category-filters">

        </div>


        <div id="map"
            class="w-full h-[450px] md:h-[650px] rounded-3xl shadow-xl border border-gray-200 overflow-hidden">
        </div>
    </div>
</section>

<link href="https://unpkg.com/sweet-icons/dist/sweet-icons.css" rel="stylesheet">

<script>
    document.addEventListener("DOMContentLoaded", () => {

        if (typeof L === "undefined") {
            console.error("Leaflet não está carregado.");
            return;
        }


        const categorias = {
            "Restaurante": "si si-restaurant",
            "Universidade": "si si-school",
            "Escola": "si si-school",
            "Supermercado": "si si-cart",
            "Hospital": "si si-hospital",
            "Clínica": "si si-hospital-cross",
            "Parque": "si si-tree",
            "Museu": "si si-museum",
            "Biblioteca": "si si-books",
            "Shopping": "si si-mall",
            "Teatro": "si si-theater",
            "Cinema": "si si-film",
            "Estádio": "si si-stadium",
            "Academia": "si si-gym",
            "Hotel": "si si-hotel",
            "Praia": "si si-sun",
            "Centro Comercial": "si si-shop",
            "Prefeitura": "si si-government",
            "Terminal de Ônibus": "si si-bus",
            "Estação de Metrô": "si si-train",
            "Centro Cultural": "si si-culture"
        };


        const categoriaEmoji = {
            "Restaurante": "🍽️", "Universidade": "🎓", "Escola": "🏫", "Supermercado": "🛒", "Hospital": "🏥",
            "Clínica": "🩺", "Parque": "🌳", "Museu": "🏛️", "Biblioteca": "📚", "Shopping": "🏬", "Teatro": "🎭",
            "Cinema": "🎬", "Estádio": "🏟️", "Academia": "🏋️‍♂️", "Hotel": "🏨", "Praia": "🏖️", "Centro Comercial": "🏢",
            "Prefeitura": "🏛️", "Terminal de Ônibus": "🚌", "Estação de Metrô": "🚇", "Centro Cultural": "🎨"
        };


        function sweetIconsAvailable() {
            try {
                const el = document.createElement('i');
                el.className = 'si si-restaurant';
                el.style.display = 'inline-block';

                el.style.position = 'absolute';
                el.style.left = '-9999px';
                document.body.appendChild(el);
                const has = el.offsetWidth > 0 && el.offsetHeight > 0;
                document.body.removeChild(el);
                return has;
            } catch (e) {
                return false;
            }
        }

        const sweetOK = sweetIconsAvailable();


        function createSweetDivIcon(category) {
            if (sweetOK) {
                const cls = categorias[category] ?? 'si si-pin';
                return L.divIcon({
                    className: '',
                    html: `
                    <div style="display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;
                                background:white;border-radius:10px;box-shadow:0 6px 18px rgba(0,0,0,0.12);border:1px solid rgba(0,0,0,0.06)">
                        <i class="${cls}" style="font-size:22px;color:#2563EB;line-height:1;"></i>
                    </div>
                `,
                    iconSize: [44, 44],
                    iconAnchor: [22, 44],
                    popupAnchor: [0, -36]
                });
            } else {

                const emoji = categoriaEmoji[category] ?? '📍';
                return L.divIcon({
                    className: '',
                    html: `
                    <div style="display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;
                                background:white;border-radius:10px;box-shadow:0 6px 18px rgba(0,0,0,0.12);border:1px solid rgba(0,0,0,0.06);font-size:20px;">
                        ${emoji}
                    </div>
                `,
                    iconSize: [44, 44],
                    iconAnchor: [22, 44],
                    popupAnchor: [0, -36]
                });
            }
        }


        const map = L.map("map", {
            zoomControl: false,
            scrollWheelZoom: true
        }).setView([-3.1303, -60.0239], 13);

        L.control.zoom({ position: "bottomright" }).addTo(map);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19,
            attribution: "&copy; OpenStreetMap contributors"
        }).addTo(map);


        const markersLayer = L.layerGroup().addTo(map);
        let allMarkers = [];


        const loadingPopup = L.popup({ closeButton: false })
            .setLatLng([-3.1303, -60.0239])
            .setContent("<b>Carregando locais...</b>")
            .openOn(map);


        fetch("/api/places")
            .then(res => res.json())
            .then(locais => {
                locais.forEach(place => {
                    if (!place.latitude || !place.longitude) return;

                    const categoria = place?.categoria?.nome ?? null;
                    const icon = createSweetDivIcon(categoria);

                    const marker = L.marker([parseFloat(place.latitude), parseFloat(place.longitude)], { icon });

                    marker.category = categoria;

                    marker.bindPopup(`
                    <div style="min-width:230px;font-family:Inter, sans-serif;">
                        <h3 style="font-weight:700;margin-bottom:6px;">${place.nome ?? 'Sem nome'}</h3>
                        <p style="margin:0 0 6px;"><strong>Categoria:</strong> ${categoria ?? 'Sem categoria'}</p>
                        <p style="margin:0 0 8px;"><strong>Endereço:</strong> ${place.endereco ?? 'Não informado'}</p>
                        <a href="/locais/${place.id}" style="display:inline-block;background:#2563EB;color:white;padding:6px 10px;border-radius:8px;text-align:center;text-decoration:none;">
                            Ver detalhes
                        </a>
                    </div>
                `);

                    allMarkers.push(marker);
                    markersLayer.addLayer(marker);
                });

                map.closePopup();


                if (allMarkers.length > 0) {
                    const group = new L.featureGroup(allMarkers);
                    map.fitBounds(group.getBounds().pad(0.15));
                }
            })
            .catch(err => {
                map.closePopup();
                console.error("Erro ao carregar locais:", err);
            });


        const filterContainer = document.getElementById("category-filters");


        const allBtn = document.createElement("button");
        allBtn.className = "px-4 py-2 rounded-full border border-gray-300 bg-white text-gray-700 hover:bg-blue-50 transition";
        allBtn.textContent = "Todos";
        allBtn.dataset.category = "Todos";
        filterContainer.appendChild(allBtn);

        Object.keys(categorias).forEach(cat => {
            const btn = document.createElement("button");
            btn.className = "px-4 py-2 rounded-full border border-gray-300 bg-white text-gray-700 hover:bg-blue-50 transition";
            btn.textContent = cat;
            btn.dataset.category = cat;
            filterContainer.appendChild(btn);
        });

        filterContainer.addEventListener("click", (e) => {
            const btn = e.target.closest("button");
            if (!btn) return;

            const cat = btn.dataset.category;


            Array.from(filterContainer.children).forEach(b => {
                b.classList.remove("bg-blue-600", "text-white", "border-blue-600");
                b.classList.add("bg-white", "text-gray-700");
            });
            btn.classList.remove("bg-white", "text-gray-700");
            btn.classList.add("bg-blue-600", "text-white", "border-blue-600");


            markersLayer.clearLayers();

            let filtered = [];
            if (cat === "Todos") {
                filtered = allMarkers;
            } else {
                filtered = allMarkers.filter(m => m.category === cat);
            }

            filtered.forEach(m => markersLayer.addLayer(m));

            if (filtered.length > 0) {
                const g = new L.featureGroup(filtered);
                map.fitBounds(g.getBounds().pad(0.15));
            }
        });


        allBtn.click();


        const locateButton = L.control({ position: 'bottomright' });
        locateButton.onAdd = function () {
            const div = L.DomUtil.create('div', 'leaflet-control-locate');
            div.innerHTML = `
            <button class="bg-white border border-gray-300 rounded-lg p-2 shadow hover:bg-gray-50 transition" title="Minha localização">
                📍
            </button>
        `;
            div.onclick = () => map.locate({ setView: true, maxZoom: 15 });
            return div;
        };
        locateButton.addTo(map);


        let userMarker = null;
        map.on("locationfound", e => {
            if (userMarker) map.removeLayer(userMarker);

            userMarker = L.circleMarker(e.latlng, {
                radius: 8,
                color: "#0ea5e9",
                fillColor: "#38bdf8",
                fillOpacity: 0.9,
                weight: 2
            }).bindPopup("<b>📍 Você está aqui</b>").addTo(map);
        });

        map.on("locationerror", () => {

        });

    });
</script>