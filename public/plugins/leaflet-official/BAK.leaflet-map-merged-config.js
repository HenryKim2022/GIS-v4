// /////////////////////////////////////////////////////////////////////////////
// /////    <!-- CUST SCRIPT: LEAFLET JS -->
// /////////////////////////////////////////////////////////////////////////////
// Useful round number function
function roundNumber(number, tensplace = 10) {
    return Math.round(number * tensplace) / tensplace;
}


//////////////// ALWAYS NEED1:
var map = new L.Map('map', {
    fullscreenControl: true,
    fullscreenControlOptions: {
        position: 'topleft'
    },
    gestureHandling: false
}).setView([-3.4763993, 115.2211498], 4.50);
//////////////// ENDOF: RESET NEED1:


//////////////// ALWAYS NEED2: RESET VIEW
L.control.resetView({
    position: "topright",
    title: "Reset view",
    latlng: L.latLng([-3.4763993, 115.2211498]),
    zoom: 4.50,
}).addTo(map);
//////////////// ENDOF: ALWAYS NEED2: RESET VIEW

//////////////// ALWAYS NEED3:
var appName = "GIS";
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: `Map data &copy; <a href="https://www.openstreetmap.org/">${appName}</a>`
}).addTo(map);
//////////////// ENDOF: ALWAYS NEED3:

//////////////// ALWAYS NEED4: SEARCH CONTROL
var markersLayer = new L.LayerGroup(); // layer containing searched elements
map.addLayer(markersLayer);
var controlSearch = new L.Control.Search({
    position: 'topleft',
    layer: markersLayer,
    initial: false,
    zoom: 48,
    marker: false
});
map.addControl(controlSearch);
//////////////// ENDOF: ALWAYS NEED4: SEARCH CONTROL

//////////////// ALWAYS NEED5: LOCATE CONTROL
L.control.locate({
    position: 'topright',
    strings: {
        title: "Locate me!"
    },
    flyTo: true, // Enable smooth fly animation to the location
    setView: 'always', // Always set the view to the located position
    maxZoom: function (map) { // Dynamically determine the maximum zoom level
        return Math.min(map.getZoom(), 1); // Set the maximum zoom level to the current zoom level or 16, whichever is smaller
    }
}).addTo(map);
//////////////// ENDOF: ALWAYS NEED5: LOCATE CONTROL

//////////////// ALWAYS NEED6: POPULATE MAP (MARKER)
// Sample data values for populating the map
var imgu = "https://upload.wikimedia.org/wikipedia/commons/thumb/9/9c/Logo_of_Ministry_of_Education_and_Culture_of_Republic_of_Indonesia.svg/400px-Logo_of_Ministry_of_Education_and_Culture_of_Republic_of_Indonesia.svg.png";
var data = [
    { "loc": [-6.1753924, 106.8271528], "title": "School 1", "imgUrl": imgu },
    { "loc": [-6.2000000, 106.8166667], "title": "School 2", "imgUrl": imgu },
    { "loc": [-6.2146207, 106.8451301], "title": "School 3", "imgUrl": imgu },
    { "loc": [-6.2348972, 106.9899802], "title": "School 4", "imgUrl": imgu },
    { "loc": [-6.1714402, 106.8384527], "title": "School 5", "imgUrl": imgu },
    // Add more school locations with image URLs here
];

// Populate the map with markers from sample data
for (i in data) {
    var title = data[i].title,
        loc = data[i].loc,
        imgUrl = data[i].imgUrl,
        popupContent = `
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
    marker.bindPopup(popupContent);
    markersLayer.addLayer(marker);
}
//////////////// ENDOF: ALWAYS NEED6: POPULATE MAP (MARKER)



// Define a variable to store the marker layer group
var markerLayer = L.layerGroup().addTo(map);

// Add event listeners for both desktop and mobile devices
map.on('contextmenu taphold', function (event) {
    var manualLatLng = event.latlng;
    var title = 'Untitled Place';
    var address = '';
    var imgUrl = imgu;

    var popupContent = `
        <div>
            <h4 class="text-sm text-mute m-0">
                <div class="d-flex align-content-center align-items-center justify-center w-100">
                    <img src="${imgUrl}" alt="" width="20" style="margin-right: 0.2rem;">
                    <span>${title}:</span>
                </div>
            </h4>
            <a class="font-fs text-sm text-mute"> Lat:${manualLatLng.lat} | Lon: ${manualLatLng.lng}</a>
            <p>
                <div class="d-flex align-content-center align-items-center justify-content-around w-100">
                    <img src="${imgUrl}" alt="${title} Logo" width="80">
                    <a>Address: ${address}</a>
                </div>
            </p>
            <button class="mark-edit-btn">Edit</button>
        </div>
    `;

    var marker = new L.Marker(manualLatLng, { title: title });
    marker.bindPopup(popupContent).openPopup();
    markersLayer.addLayer(marker);
    data.push(
        { "loc": [manualLatLng.lat, manualLatLng.lng], "title": title, "imgUrl": imgu }
    );

    // Handle the "Edit" button click event within the marker's popup
    marker.on('popupopen', function () {
        var editButton = document.querySelector('.mark-edit-btn');

        editButton.addEventListener('click', function () {
            $('#editMarkModal').modal('show');

            var saveButton = document.querySelector('.modal-save-btn');
            if (saveButton) {
                saveButton.addEventListener('click', function () {

                    $('#editMarkModal').modal('hide');
                    marker.setPopupContent(updatedPopupContent);
                });
            }
        });
    });
});


// Enter fullscreen event listener
map.on('fullscreenchange', function () {
var isFullscreen = document.fullscreenElement !== null;
if (isFullscreen) {
    // Show the modal when entering fullscreen
    document.getElementById('editMarkModal').style.zIndex = 999999;
} else {
    // Hide or remove the modal when exiting fullscreen
    document.getElementById('editMarkModal').style.zIndex = 1102;
}
});

