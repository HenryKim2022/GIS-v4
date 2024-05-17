var imgu = "https://demo4.iti-if.my.id/public/plugins/leaflet-official/data.geojson.json/img/tutwuri.png";
var controlSearch;

function initializeMap() {
    var map = new L.Map('map', {
        fullscreenControl: true,
        fullscreenControlOptions: {
            position: 'topleft'
        },
        gestureHandling: false
    }).setView([-3.4763993, 115.2211498], 4.50);

    // L.Control.geocoder().addTo(map);

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
            const tooltipData = {
                tobesearch: f.properties.institu_name,
            }
            const marker = L.marker(coordinates, tooltipData);

            const institu_name = f.properties['institu_name'] || "none";
            const institu_npsn = f.properties['institu_npsn'] || "none";
            const imgLogo = f.properties['institu_logo'] || "none";
            const institu_addr = f.properties['institu_address'] || "none";
            const institu_images = f.properties['institu_image'] || "none";
            const last_update = f.properties['updated_at'] || "never";


            continueTOprocess(institu_addr);
            function continueTOprocess(final_addr) {
                const isImgLogoExist = imgLogo.endsWith('.png') || imgLogo.endsWith('.jpg') ? imgLogo : '';
                const isImgsExist = institu_images.endsWith('.png') || institu_images.endsWith('.jpg') ? institu_images : '';
                const imgWidth = imgLogo.endsWith('.png') || imgLogo.endsWith('.jpg') ? '30' : '80';
                let content = `
                    <div class='d-flex flex-column p-0'>
                    <span style='padding-bottom:2px;'><strong>Coordinates: </strong>${coordinates}<br></span>
                    <span style='padding-bottom:2px;'><strong>Name: </strong>${institu_name}<br></span>
                    <span style='padding-bottom:2px;'><strong>NPSN: </strong>${institu_npsn}<br></span>
                    <span style='padding-bottom:2px;'><strong>Logo: </strong>
                        <img src='${isImgLogoExist}' alt='${institu_name} Logo' width='${imgWidth}'><br>
                    </span>
                    <span style='padding-bottom:2px;'><strong>Address:</strong>${final_addr}<br></span>
                    <span style='padding-bottom:2px;'><strong>Images:</strong>
                        <img src='${isImgsExist}' alt='${institu_name} Logo' width='80'><br>
                    </span>
                    <span style='padding-bottom:2px;'><strong>Last Update: </strong>${last_update}<br></span>
                    </div>
                `;

                marker.bindTooltip(institu_name + "  ➟  " + final_addr);
                marker.bindPopup(content);
                marker.options.popupText = marker._popup._content;
                markersLayer.addLayer(marker);
            }

        });

    addSearchControl(map, markersLayer, 'tobesearch');
}


function addMarkerOnContextMenu(map, markersLayer) {
    map.on('contextmenu taphold', function (e) {
        var LAT = e.latlng.lat.toFixed(7);
        var LNG = e.latlng.lng.toFixed(7);
        var coordinates = {
            lat: LAT,
            lng: LNG
        };

        getAddressFromCoordinates(coordinates)
            .then(address => {
                // Define the addr components
                var componentKeys = [
                    { key: 'road', label: 'Jl.' },
                    { key: 'neighbourhood', label: 'Ling.' },
                    { key: 'hamlet', label: 'Dusun' },
                    { key: 'village', label: 'Desa' },
                    { key: 'suburb', label: 'Suburb' },
                    { key: 'city_district', label: 'Kec.' },
                    { key: 'town', label: 'Kota' },
                    { key: 'county', label: 'Kab.' },
                    { key: 'state_district', label: 'Wilayah' },
                    { key: 'city', label: 'Kota' },
                    { key: 'state', label: 'Prov.' },
                    { key: 'postcode', label: 'Kode Pos' },
                    { key: 'country', label: 'Negara' }
                ];

                var province = address['state'];
                var postcode = address['postcode'];
                var addressComponents = [];

                componentKeys.forEach(component => {
                    var key = component.key;
                    var label = component.label;

                    if (key === 'state') {
                        if (province && postcode) {
                            addressComponents.push(label + ' ' + province + ' (' + postcode + ')');
                        } else if (province) {
                            addressComponents.push(label + ' ' + province);
                        }
                    } else if (key !== 'postcode' && address[key]) {
                        if (label && address[key].toLowerCase().includes(label.toLowerCase())) {
                            addressComponents.push(address[key]);
                        } else {
                            addressComponents.push(label + ' ' + address[key]);
                        }
                    }
                });

                var fulladdr = addressComponents.join(', ');
                processIt(fulladdr);
                console.log(fulladdr);
            })
            .catch(error => {
                console.error('Error:', error.message);
            });

        function processIt(institu_addr) {
            const institu_name = "Untitled Marker";
            const institu_npsn = "fill data!";
            const imgLogo = imgu; // Corrected variable name
            const institu_images = imgu;
            const last_update = "never";

            const tooltipData = {
                tobesearch: institu_name
            };
            const marker = L.marker(new L.latLng([LAT, LNG]), tooltipData);

            const fromRightClick_PopupContent = `
                <div class='d-flex flex-column p-0'>
                    <span style='padding-bottom:2px;'><strong>Coordinates: </strong>${LAT}, ${LNG}<br></span>
                    <span style='padding-bottom:2px;'><strong>Name: </strong>${institu_name}<br></span>
                    <span style='padding-bottom:2px;'><strong>NPSN: </strong>${institu_npsn}<br></span>
                    <span style='padding-bottom:2px;'><strong>Logo: </strong>
                        <img src='${imgLogo}' alt='${institu_name} Logo' width='30'><br>
                    </span>
                    <span style='padding-bottom:2px;'><strong>Address:</strong>${institu_addr}<br></span>
                    <span class='d-flex flex-column align-top text-start' style='padding-bottom:2px;'><strong>Images:</strong>
                        <img src='${institu_images}' alt='${institu_name} Logo' width='80'><br>
                    </span>
                    <span style='padding-bottom:2px;'><strong>Last Update: </strong>${last_update}<br></span>
                    <div class='d-flex flex-col justify-content-between'>
                        <button class="mark-cancel-btn mdi mdi-cancel">Cancel</button>
                        <button class="mark-remove-btn mdi mdi-delete">Remove</button>
                        <button class="mark-edit-btn mdi mdi-content-edit">Edit</button>
                    </div>
                </div>
            `;

            marker.bindTooltip(institu_name + "  ➟  " + institu_addr);
            marker.bindPopup(fromRightClick_PopupContent);
            marker.options.popupText = marker._popup._content;
            markersLayer.addLayer(marker);


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
                    var cancelButton = document.querySelector('.mark-cancel-btn');
                    if (cancelButton) {
                        cancelButton.addEventListener('click', function () {
                            marker.closePopup();
                        });
                    }
                });
                var cancelButton = document.querySelector('.mark-cancel-btn');
                cancelButton.addEventListener('click', function () {
                    if (cancelButton) {
                        marker.closePopup();
                    }
                });
                var deleteButton = document.querySelector('.mark-remove-btn');
                deleteButton.addEventListener('click', function () {
                    if (deleteButton) {
                        markersLayer.removeLayer(marker); // Remove the marker from the layer
                    }
                });
            });
        }

    });
}



function getAddressFromCoordinates(coordinates) {
    const url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${coordinates.lat}&lon=${coordinates.lng}`;

    return fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data && data.address) {
                const address = data.address;
                return address;
            } else {
                throw new Error('Address not found');
            }
        })
        .catch(error => {
            throw new Error('Error retrieving address');
        });
}


function printAddrToConsole(map) {
    map.on('click', function (e) {
        const coordinates = e.latlng;
        getAddressFromCoordinates(coordinates)
            .then(address => {
                console.log(address);
            })
            .catch(error => {
                console.error('Error:', error.message);
            });
    });
}

function geocodeTracks(map) {
    var geocoder = L.Control.geocoder({
      defaultMarkGeocode: false
    })
      .on('markgeocode', function(e) {
        var geocode = e.geocode;
        if (geocode && geocode.bbox) {
          var bbox = geocode.bbox;
          var bounds = L.latLngBounds(bbox.getSouthWest(), bbox.getNorthEast());
          var poly = L.polygon([
            bounds.getSouthEast(),
            bounds.getNorthEast(),
            bounds.getNorthWest(),
            bounds.getSouthWest()
          ]).addTo(map);
          map.fitBounds(bounds);
        } else {
          console.log('No valid geocode result found.');
        }
      })
      .addTo(map);
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
    printAddrToConsole(map);
    geocodeTracks(map);
}




// Call the main function to initialize the map
initializeMapApp();
