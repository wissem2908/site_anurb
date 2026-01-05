<?php include 'includes/header.php'; ?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-1 text-white animated slideInDown">Filiales</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb text-uppercase mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Accueil</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Filiales</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Filiales Section Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row gx-5">
            <!-- LEFT: Map -->
            <div class="col-lg-7 mb-4">
                <div id="filialesMap" style="height: 600px; border-radius: 15px; box-shadow: 0 8px 30px rgba(0,0,0,0.1);"></div>
            </div>

            <!-- RIGHT: Cards -->
            <div class="col-lg-5">
                <div class="row g-4" id="filialesCards">
                    <!-- Card template -->
                    <div class="col-md-6">
                        <div class="card filiale-card h-100 shadow-sm" data-lat="36.7538" data-lng="3.0588">
                            <div class="card-img-wrapper">
                                <img src="assets/images/filiales/urbab.png" class="card-img-top" alt="Filiale 1">
                                <div class="card-overlay">
                                    <h5>URBA Blida</h5>
                                    <p>URBAB</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card filiale-card h-100 shadow-sm" data-lat="34.7300" data-lng="3.0800">
                            <div class="card-img-wrapper">
                                <img src="assets/images/filiales/urbab.png" class="card-img-top" alt="Filiale 2">
                                <div class="card-overlay">
                                    <h5>URBA Oran</h5>
                                    <p>URBAO</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card filiale-card h-100 shadow-sm" data-lat="36.7074" data-lng="3.2124">
                            <div class="card-img-wrapper">
                                <img src="assets/images/filiales/urbab.png" class="card-img-top" alt="Filiale 3">
                                <div class="card-overlay">
                                    <h5>URBA Alger</h5>
                                    <p>URBAA</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card filiale-card h-100 shadow-sm" data-lat="35.6911" data-lng="0.6381">
                            <div class="card-img-wrapper">
                                <img src="assets/images/filiales/urbab.png" class="card-img-top" alt="Filiale 4">
                                <div class="card-overlay">
                                    <h5>URBA Annaba</h5>
                                    <p>URBAN</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Filiales Section End -->

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- Optional: Marker Cluster -->
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
<script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>

<style>
    /* Card hover overlay */
    .filiale-card {
        cursor: pointer;
        overflow: hidden;
        border-radius: 15px;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .filiale-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    }

    .card-img-wrapper {
        position: relative;
    }

    .card-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        padding: 10px;
        text-align: center;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .filiale-card:hover .card-overlay {
        opacity: 1;
    }

    /* Leaflet custom popup */
    .leaflet-popup.custom-popup .leaflet-popup-content-wrapper {
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        padding: 10px;
    }

    .leaflet-popup.custom-popup .leaflet-popup-tip {
        background: #007bff;
    }
</style>

<script>
    const filiales = [{
            name: "URBA Blida",
            abbrev: "URBAB",
            lat: 36.7538,
            lng: 3.0588,
            img: "assets/images/filiales/urbab.png"
        },
        {
            name: "URBA Oran",
            abbrev: "URBAO",
            lat: 34.7300,
            lng: 3.0800,
            img: "assets/images/filiales/urbab.png"
        },
        {
            name: "URBA Alger",
            abbrev: "URBAA",
            lat: 36.7074,
            lng: 3.2124,
            img: "assets/images/filiales/urbab.png"
        },
        {
            name: "URBA Annaba",
            abbrev: "URBAN",
            lat: 35.6911,
            lng: 0.6381,
            img: "assets/images/filiales/urbab.png"
        }
    ];

    // Initialize map
    const map = L.map('filialesMap').setView([36.7538, 3.0588], 6);

    // Modern light tile
    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OSM</a> &copy; CARTO',
        subdomains: 'abcd',
        maxZoom: 19
    }).addTo(map);

    // Marker cluster
    const markers = L.markerClusterGroup();

    filiales.forEach(f => {
        // Use filiale image as marker
        const icon = L.icon({
            iconUrl: f.img,
            iconSize: [50, 50], // size of the marker
            iconAnchor: [25, 50], // point of the icon which will correspond to marker's location
            popupAnchor: [0, -50] // point from which the popup should open relative to the iconAnchor
        });

        const marker = L.marker([f.lat, f.lng], {
            icon
        });

        marker.bindPopup(`
        <div style="text-align:center; width:200px;">
            <img src="${f.img}" style="border-radius:10px; width:100%; height:100px; object-fit:cover; margin-bottom:5px;">
            <h6 style="margin:0;">${f.name}</h6>
            <small>${f.abbrev}</small>
        </div>
    `, {
            closeButton: true,
            className: 'custom-popup'
        });

        markers.addLayer(marker);
    });

    map.addLayer(markers);

    // Card click -> fly to marker & open popup
    document.querySelectorAll('.filiale-card').forEach(card => {
        card.addEventListener('click', () => {
            const lat = parseFloat(card.dataset.lat);
            const lng = parseFloat(card.dataset.lng);
            const name = card.querySelector('.card-overlay h5').textContent.trim();

            map.flyTo([lat, lng], 12);

            markers.eachLayer(marker => {
                if (marker.getPopup().getContent().includes(name)) {
                    marker.openPopup();
                }
            });
        });
    });
</script>


<?php include 'includes/footer.php'; ?>