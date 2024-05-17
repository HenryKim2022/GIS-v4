var imgu = "";
var controlSearch;

function initializeMap() {
    var map = new L.Map('map', {
        fullscreenControl: true,
        fullscreenControlOptions: {
            position: 'topleft'
        },
        gestureHandling: false
    }).setView([-3.4763993, 115.2211498], 4.50);

    return map;
}

function addResetViewControl(map) {
    L.control.resetView({
        position: "topright",
        title: "Reset view",
        latlng: L.latLng([-3.4763993, 115.2211498]),
        zoom: 4.50,
    }).addTo(map);
}

function addTileLayer(map) {
    var appName = "GIS";
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: `Map data &copy; <a href="https://www.openstreetmap.org/">${appName}</a>`
    }).addTo(map);
}

function addSearchControl(map, markersLayer, propertyNamed) {
    L.control.search({
        layer: markersLayer,
        position: 'topleft',
        initial: false,
        zoom: 48,
        propertyName: propertyNamed,
        textPlaceholder: 'Search by school name'
    }).addTo(map);
}

function addLocateControl(map) {
    L.control.locate({
        position: 'topright',
        strings: {
            title: "Locate me!"
        },
        flyTo: true,
        setView: 'always',
        locateOptions: {
            enableHighAccuracy: true
        },
        maxZoom: function (map) {
            return Math.min(map.getZoom(), 1);
        }
    }).addTo(map);
}

function populateMapWithMarkers(map, markersLayer) {
    school500.features
        .filter(f => f.properties['institu_name'])
        .forEach(f => {
            const coordinates = f.geometry.coordinates.slice().reverse();
            const marker = L.marker(coordinates, {
                title: f.properties.institu_name,
                address: f.properties.institu_address
            });

            // Membuat konten marker yang berisi semua atribut
            let content = "<div name='" + f.properties['institu_address']  +"'>";
            content += "<strong>coordinates: </strong> " + coordinates + "<br>";

            for (let key in f.properties) {
                content += "<strong>" + key + ":</strong> " + f.properties[key] + "<br>";
            }
            content += "</div>";

            marker.bindPopup(content);
            marker.options.popupText = marker._popup._content;
            markersLayer.addLayer(marker);
        });

    addSearchControl(map, markersLayer, 'title');
}

function addMarkerOnContextMenu(map, markersLayer) {
    map.on('contextmenu taphold', function (e) {
        var LAT = e.latlng.lat.toFixed(7);
        var LNG = e.latlng.lng.toFixed(7);
        var title = 'New Marker',
            address = 'Fill the address',
            imgUrl = imgu,
            fromRightClick_PopupContent = `
                    <div>
                        <h4 class="text-sm text-mute m-0">
                            <div class="d-flex align-content-center align-items-center justify-center w-100">
                                <img src="${imgUrl}" alt="" width="20" style="margin-right: 0.2rem;">
                                <span>${title}:</span>
                            </div>
                        </h4>
                        <a class="font-fs text-sm text-mute"> Lat:${LAT} | Lon: ${LNG}</a>
                        <p>
                            <div class="d-flex align-content-center align-items-center justify-content-around w-100">
                                <img src="${imgUrl}" alt="${title} Logo" width="80">
                                <a>Address: ${address}</a>
                            </div>
                        </p>
                        <button class="mark-edit-btn">Edit</button>
                    </div>
                `;

        var marker = new L.Marker(new L.latLng([LAT, LNG]), { title: title });
        marker.bindPopup(fromRightClick_PopupContent);
        markersLayer.addLayer(marker);
        console.log("New marker added at Lat: " + LAT + " | Lon: " + LNG);
        // Remove the existing search control
        map.removeControl(controlSearch);
        // Create a new search control with the updated markersLayer
        addSearchControl(map, markersLayer);
    });
}

// The main function to initialize the map and its components
function initializeMapApp() {
    var map = initializeMap();
    var markersLayer = L.layerGroup();

    // addSearchControl(map, markersLayer);
    populateMapWithMarkers(map, markersLayer);
    addResetViewControl(map);
    addTileLayer(map);
    addLocateControl(map);
    addMarkerOnContextMenu(map, markersLayer);
}

// Call the main function to initialize the map
initializeMapApp();
