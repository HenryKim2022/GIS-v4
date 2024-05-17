// /////////////////////////////////////////////////////////////////////////////
// /////    <!-- CUST SCRIPT: LEAFLET JS -->
// /////////////////////////////////////////////////////////////////////////////
var imgu = "https://upload.wikimedia.org/wikipedia/commons/thumb/9/9c/Logo_of_Ministry_of_Education_and_Culture_of_Republic_of_Indonesia.svg/400px-Logo_of_Ministry_of_Education_and_Culture_of_Republic_of_Indonesia.svg.png";
// var data = [
//     { "loc": [-6.1753924, 106.8271528], "title": "School 1", "imgUrl": imgu },
//     { "loc": [-6.2000000, 106.8166667], "title": "School 2", "imgUrl": imgu },
//     { "loc": [-6.2146207, 106.8451301], "title": "School 3", "imgUrl": imgu },
//     { "loc": [-6.2348972, 106.9899802], "title": "School 4", "imgUrl": imgu },
//     { "loc": [-6.1714402, 106.8384527], "title": "School 5", "imgUrl": imgu },
// ];






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

function addSearchControl(map, markersLayer) {
    L.control.search({
        layer: markersLayer,
        position: 'topleft',
        initial: false,
        marker: false,
        zoom: 48,
        propertyName: 'popupText'
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
        maxZoom: function (map) {
            return Math.min(map.getZoom(), 1);
        }
    }).addTo(map);

}

function populateMapWithMarkers(map, imgUrl, markersLayer) {
    // Menggunakan fetch untuk memuat file JSON
    fetch('public/plugins/leaflet-official/data.geojson.json/data.v1.json')
        .then(response => response.json())
        .then(geojsonData => {
            geojsonData.features.forEach(feature => {
                var marker = L.marker(feature.geometry.coordinates.reverse()).addTo(markersLayer);
                marker.bindPopup(`
              <h3>${feature.properties.institu_name}</h3>
              <p>${feature.properties.institu_category}</p>
              <p>${feature.properties.institu_address}</p>
            `);
            });

            addSearchControl(map, markersLayer)
            console.log('Success to load geojson.json :)');
        })
        .catch(error => {
            console.log('Error:', error);
        });



    // fetch('public/plugins/leaflet-official/data.geojson.json/data.v1.json')
    //     .then(response => response.json())
    //     .then(geojsonData => {
    //         const markers = geojsonData.features
    //             .filter(f => {
    //                 // Hanya ambil data yang memiliki properti 'addr:street'
    //                 return f.properties['institu_id:institu_name:institu_category:institu_npsn:institu_address:institu_mark_id'];
    //             })
    //             .map(f => {
    //                 const loc = f.geometry.coordinates.reverse();
    //                 const institu_id = f.properties.institu_id;
    //                 const institu_name = f.properties.institu_name;
    //                 const institu_category = f.properties.institu_category;
    //                 const institu_npsn = f.properties.institu_npsn;
    //                 const institu_logo = f.properties.institu_logo;
    //                 const institu_address = f.properties.institu_address;
    //                 const institu_descb = f.properties.institu_descb;
    //                 const institu_image = f.properties.institu_image;
    //                 const institu_mark_id = f.properties.institu_mark_id;



    //                 const fromDB_PopupContent = `
    //                   <div>
    //                     <h4 class="text-sm text-mute m-0">
    //                       <div class="d-flex align-content-center align-items-center justify-center w-100">
    //                         <img src="${imgUrl}" alt="tutwuri Image" width="20" style="margin-right: 0.2rem;">
    //                         <span>${institu_name}:</span>
    //                       </div>
    //                     </h4>
    //                     <a class="font-fs text-sm text-mute"> Lat:${loc[0]} | Lon: ${loc[1]}</a>
    //                     <p>
    //                       <div class="d-flex align-content-center align-items-center justify-content-around w-100">
    //                         <img src="${institu_logo}" alt="${institu_name} Logo" width="80">
    //                       </div>
    //                     </p>
    //                   </div>
    //                 `;

    //                 return L.marker(loc, {
    //                     title: title
    //                 }).bindPopup(fromDB_PopupContent);
    //             });


    //         markersLayer = L.layerGroup(markers).addTo(map);
    //         addSearchControl(map, markersLayer)

    //         console.log('Success to load geojson.json :)');
    //     })
    //     .catch(error => {
    //         console.error('Failed to load geojson.json:', error);
    //         return error;
    //     });





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
    var markersLayer = L.layerGroup().addTo(map);
    map.addLayer(markersLayer);

    addResetViewControl(map);
    addTileLayer(map);
    addLocateControl(map);
    populateMapWithMarkers(map, imgu, markersLayer);
    addMarkerOnContextMenu(map, markersLayer);
}

// Call the main function to initialize the map
initializeMapApp();
