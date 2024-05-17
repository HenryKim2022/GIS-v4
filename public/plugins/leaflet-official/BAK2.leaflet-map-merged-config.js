// /////////////////////////////////////////////////////////////////////////////
// /////    <!-- CUST SCRIPT: LEAFLET JS -->
// /////////////////////////////////////////////////////////////////////////////
var imgu = "https://upload.wikimedia.org/wikipedia/commons/thumb/9/9c/Logo_of_Ministry_of_Education_and_Culture_of_Republic_of_Indonesia.svg/400px-Logo_of_Ministry_of_Education_and_Culture_of_Republic_of_Indonesia.svg.png";
var data = [
    { "loc": [-6.1753924, 106.8271528], "title": "School 1", "imgUrl": imgu },
    { "loc": [-6.2000000, 106.8166667], "title": "School 2", "imgUrl": imgu },
    { "loc": [-6.2146207, 106.8451301], "title": "School 3", "imgUrl": imgu },
    { "loc": [-6.2348972, 106.9899802], "title": "School 4", "imgUrl": imgu },
    { "loc": [-6.1714402, 106.8384527], "title": "School 5", "imgUrl": imgu },
];

var map = L.map('map', {
    zoom: 14,
    center: new L.latLng(41.8990, 12.4977),
    layers: L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
});

// Menggunakan fetch untuk memuat file JSON
fetch('path/to/geojson.json')
    .then(response => response.json())
    .then(geojsonData => {
      const markers = geojsonData.features
        .filter(f => {
          // Hanya ambil data yang memiliki properti 'addr:street'
          return f.properties['addr:street'];
        })
        .map(f => {
          return L.marker(f.geometry.coordinates.reverse(), {
            title: f.properties.name
          }).bindPopup(f.properties['addr:street']);
        });

      markers.forEach(m => {
        m.options.popupText = m._popup._content;
      });

      var poiLayers = L.layerGroup(markers).addTo(map);

      L.control.search({
        layer: poiLayers,
        initial: false,
        propertyName: 'popupText'
      }).addTo(map);
    })
    .catch(error => {
        console.error('Failed to load geojson.json:', error);
    });


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

function addSearchControl(map,markersLayer) {
    var controlSearch = new L.Control.Search({
        position: 'topleft',
        layer: markersLayer,
        initial: false,
        zoom: 48,
        marker: false
    });

    map.addControl(controlSearch);
}

function addLocateControl(map) {
    L.control.locate({
        position: 'topright',
        strings: {
            title: "Locate me!"
        },
        flyTo: true,
        setView: 'always',
        maxZoom: function (map) {
            return Math.min(map.getZoom(), 1);
        }
    }).addTo(map);
}

function populateMapWithMarkers(map,data,markersLayer) {
    for (var i in data) {
        var title = data[i].title,
            loc = data[i].loc,
            imgUrl = data[i].imgUrl,
            fromDB_PopupContent = `
                <div>
                    <h4 class="text-sm text-mute m-0">
                        <div class="d-flex align-content-center align-items-center justify-center w-100">
                            <img src="${imgUrl}" alt="tutwuri Image" width="20" style="margin-right: 0.2rem;">
                            <span>${title}:</span>
                        </div>
                    </h4>
                    <a class="font-fs text-sm text-mute"> Lat:${loc[0]} | Lon: ${loc[1]}</a>
                    <p>
                        <div class="d-flex align-content-center align-items-center justify-content-around w-100">
                            <img src="${imgUrl}" alt="${title} Logo" width="80">
                        </div>
                    </p>
                </div>
            `,
            marker = new L.Marker(new L.latLng(loc), { title: title });

        marker.bindPopup(fromDB_PopupContent);
        markersLayer.addLayer(marker);
    }
}

function addMarkerOnContextMenu(map,markersLayer) {
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
    var markersLayer = new L.LayerGroup();
    map.addLayer(markersLayer);

    addResetViewControl(map);
    addTileLayer(map);
    addSearchControl(map,markersLayer);
    addLocateControl(map);
    populateMapWithMarkers(map,data,markersLayer);
    addMarkerOnContextMenu(map,markersLayer);
}

// Call the main function to initialize the map
initializeMapApp();
