var imgu = "public/img/noimage.png";
var controlSearch;
let isModalActive = false;
var fullscreenControl, fullscreenElement;

let startingCoordinates;
let startingZoom;

setStartingValue();
function setStartingValue() {
    function handleViewportChange() {
        const viewportWidth = window.innerWidth;
        const deviceType = viewportWidth < 768 ? 'smartphone' : 'pc';
        if (deviceType === 'smartphone') {
            // console.log('Smartphone viewport detected');
            startingCoordinates = [-3.4763993, 133.2211498];
            startingZoom = 6.5;
        } else {
            // console.log('PC viewport detected');
            startingCoordinates = [-2.6140108, 140.4221155];
            startingZoom = 9.7;
        }
    }

    window.addEventListener('resize', handleViewportChange);
    handleViewportChange();
}




function openModal(modalToShow, modalSelector) {
    isModalActive = true;
    modalToShow.show();
    modalSelector.scrollIntoView();

    $('body').on('click', modalSelector, function (oEvt) {
        // oEvt.preventDefault(); // Prevents the default behavior of the click event
        oEvt.stopPropagation();     //<--- this is important, for checkbox on leaflet + other
    });

    document.addEventListener('keydown', function (event) {
        if (isModalActive && event.key === 'Escape') {
            closeModal(modalToShow);
        }
    });

    $(modalToShow).on('hidden.bs.modal', function () {
        isModalActive = false;
        document.getElementById('map-overlay').style.display = 'none';
        document.getElementById('map').style.pointerEvents = 'auto';
    });


    document.getElementById('map-overlay').style.display = 'block';
    document.getElementById('map').style.pointerEvents = 'none';
}
function closeModal(modalToShow) {
    isModalActive = false;
    modalToShow.hide();

    document.getElementById('map-overlay').style.display = 'none';
    document.getElementById('map').style.pointerEvents = 'auto';
}

function setDataModal(map, markersLayer, whichModal = 'viewMarkUserModal') {
    const modalSelector = document.querySelector('#' + whichModal);
    const modalToShow = new bootstrap.Modal(modalSelector);
    const targetedModalForm = document.querySelector('#' + whichModal + ' #viewMarkForm');

    // document.addEventListener('DOMContentLoaded', function () {
    markersLayer.eachLayer(function (layer) {
        layer.on('click', function () {
            // Retrieve data for the clicked marker
            const mark_id = layer.options.mark_id;
            const mark_lat = layer.options.mark_lat;
            const mark_lon = layer.options.mark_lon;
            const mark_address = layer.options.mark_address;
            // const created_at = layer.options.created_at;
            const updated_at = layer.options.updated_at;


            // Retrieve tooltipData object from marker options
            $('#modalViewMarkID').val(mark_id);
            $('#modalViewLatitude').val(mark_lat);
            $('#modalViewLongitude').val(mark_lon);
            $('#modalViewAddress').val(mark_address);
            $('#modalViewLastUpdate').val(updated_at);
            openModal(modalToShow, modalSelector);

            $('#delete_modalviewMarkUserModal').on('click', function () {
                closeModal(modalToShow);
                $('#mark_id').val(mark_id);

                openModal(new bootstrap.Modal(document.querySelector('#deleteMarkModalMAPS')), document.querySelector('#deleteMarkModalMAPS'));
                const modaldeleteMarkModalMAPSBtn = $(document.querySelector('#deleteMarkModalMAPS')).find('#confirmDelete')[0];
                modaldeleteMarkModalMAPSBtn.addEventListener('click', function () {
                    $.ajax({
                        url: '/m-mark/delete-mark-maps',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            mark_id: mark_id
                        },
                        success: function (response) {
                            // Handle success response, e.g., reload the table or show a success message
                            console.log(response);
                            console.log('Mark deleted successfully');
                            markersLayer.removeLayer(layer);
                            // Close the confirmation modal
                            closeModal(new bootstrap.Modal(document.querySelector('#deleteMarkModalMAPS')));
                            location.reload(); // Reload the page to update the table
                        },
                        error: function (error) {
                            // Handle error response, e.g., show an error message
                            console.log('Error deleting mark:', error);
                        }
                    });
                });

                const modalDeleteMarkMAPSCancelBtn = $(document.querySelector('#deleteMarkModalMAPS')).find('#cancel_modaldeleteMarkModalMAPS')[0];
                modalDeleteMarkMAPSCancelBtn.addEventListener('click', function () {
                    closeModal(new bootstrap.Modal(document.querySelector('#deleteMarkModalMAPS')));
                });




            });


            // $('#delete_modalviewMarkUserModal').on('click', function () {
            //     // Delete Record
            //     if (confirm("Are you sure you want to delete this records?")) {
            //         $.ajax({
            //             url: '/m-mark/delete-mark-maps',
            //             method: 'POST',
            //             headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //             },
            //             data: {
            //                 mark_id: mark_id
            //             },
            //             success: function (response) {
            //                 // Handle success response, e.g., reload the table or show a success message
            //                 console.log(response);
            //                 console.log('Mark deleted successfully');
            //                 markersLayer.removeLayer(layer);
            //                 location.reload(); // Reload the page to update the table
            //             },
            //             error: function (error) {
            //                 // Handle error response, e.g., show an error message
            //                 console.log('Error deleting mark:', error);
            //             }
            //         });
            //     }

            // });

            const closeModalBtn = $(modalSelector).find('#close_modalviewMarkUserModal')[0];
            closeModalBtn.addEventListener('click', function () {
                closeModal(modalToShow);
            });

            const editModalBtn = $(modalSelector).find('#edit_modalviewMarkUserModal')[0];
            editModalBtn.addEventListener('click', function () {
                closeModal(modalToShow);
                $('#modalEditMarkID2MAPS').val(mark_id);
                $('#modalEditLatitudeMAPS').val(mark_lat);
                $('#modalEditLongitudeMAPS').val(mark_lon);
                $('#modalEditMarkAddressMAPS').val(mark_address);
                openModal(new bootstrap.Modal(document.querySelector('#editMarkModalMAPS')), document.querySelector('#editMarkModalMAPS'));
                const modalviewMarkUserModalMAPCancelModalBtn = $(document.querySelector('#editMarkModalMAPS')).find('#cancel_modalviewMarkUserModalMAPS')[0];
                modalviewMarkUserModalMAPCancelModalBtn.addEventListener('click', function () {
                    closeModal(modalToShow);
                });

            });


        });
    });

}



function initLeafletMap() {
    var map = new L.Map('map', {
        fullscreenControl: true,
        fullscreenControlOptions: {
            position: 'topleft',
            forcePseudoFullscreen: false
        },
        gestureHandling: true,
        zoom: {
            scrollWheelZoom: false,
            wheelPxPerZoomLevel: 120
        }
    }).setView(startingCoordinates, startingZoom);

    map.on('enterFullscreen', function () {
        map.scrollWheelZoom.disable(); // Disable scroll wheel zoom in fullscreen mode
        console.log('in fullscreen mode');
    });
    map.on('exitFullscreen', function () {
        map.scrollWheelZoom.enable(); // Enable scroll wheel zoom when exiting fullscreen mode
        console.log('not fullscreen mode');
    });


    var appName = "GIS";
    var currentDomain = window.location.origin;
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: `Map data &copy; <a href="${currentDomain}">${appName}</a>`
    }).addTo(map);

    L.control.mousePosition({
        position: 'bottomleft',
        formatter: function (lat, lng) {
            var latDirection = lat >= 0 ? '' : '-';
            var lngDirection = lng >= 0 ? '' : '-';
            return lngDirection + Math.abs(lng).toFixed(7) + ' ' + latDirection + Math.abs(lat).toFixed(7);
        }
    }).addTo(map);

    // Override scroll behavior for the map container when modal is active
    map.addEventListener('click', function (event) {
        if (isModalActive) {
            event.stopPropagation();
        }
    }, { passive: false });




    function handleViewportChange() {
        const viewportWidth = window.innerWidth;
        const deviceType = viewportWidth < 768 ? 'smartphone' : 'pc';
        if (deviceType === 'smartphone') {
            console.log('Smartphone viewport detected');
            startingCoordinates = [-3.4763993, 133.2211498];
            startingZoom = 6.5;
            map.setView(startingCoordinates, startingZoom);
        } else {
            console.log('PC viewport detected');
            startingCoordinates = [-2.6140108, 140.4221155];
            startingZoom = 9.7;
            map.setView(startingCoordinates, startingZoom);
        }
    }
    window.addEventListener('onload', handleViewportChange);
    handleViewportChange();



    return map;
}





function populateMarks4romDB(map, markersLayer) {
    let tooltipData;
    fetch('/one-time/loadone')
        .then(response => response.json())
        .then(data => {
            const markers = data.features
                .filter(f => f.properties.mark.mark_id)
                .map(f => {
                    const coordinates = f.geometry.coordinates.map(parseFloat).reverse();
                    const markColor = f.properties.mark.mark_color;
                    const createdTimestamp = new Date(f.properties.mark.created_at);
                    const updatedTimestamp = new Date(f.properties.mark.updated_at);
                    tooltipData = {
                        full_coordinates: coordinates || "untitled",
                        mark_id: f.properties.mark.mark_id || "none",
                        mark_lat: coordinates[0] || "none",
                        mark_lon: coordinates[1] || "none",
                        mark_color: markColor || "none",
                        mark_address: f.properties.mark.mark_address || "none",
                        created_at: createdTimestamp.toLocaleString('id-ID', {
                            timeZone: 'Asia/Jakarta',
                            hour12: true
                        }) || "none",
                        updated_at: updatedTimestamp.toLocaleString('id-ID', {
                            timeZone: 'Asia/Jakarta',
                            hour12: true
                        }) || "none",
                        inst_name: f.properties.institution ? f.properties.institution.name : "none",
                        inst_cat: f.properties.institution ? f.properties.institution.category : "none",
                        inst_images: f.properties.institution ? f.properties.institution.images : []
                    };

                    // console.log(tooltipData);    //// SHOW ALL LOADED DATA FROM JSON
                    let customIconMarker;
                    if (markColor === 'success') {
                        customIconMarker = L.icon({
                            iconUrl: 'public/plugins/leaflet-official/leaflet.base.vlastest/dist/images/marker-icon-success.png',
                            iconSize: [21, 38], iconAnchor: [10, 38]
                        });
                    } else if (markColor === 'warning') {
                        customIconMarker = L.icon({
                            iconUrl: 'public/plugins/leaflet-official/leaflet.base.vlastest/dist/images/marker-icon-warning.png',
                            iconSize: [21, 38], iconAnchor: [10, 38]
                        });
                    }

                    const marker = L.marker(coordinates, {
                        icon: customIconMarker,
                        ...tooltipData
                    });

                    applyMarksToolTips();
                    function applyMarksToolTips() {
                        var tooltipText = tooltipData.inst_name != "none" ? tooltipData.inst_name : tooltipData.full_coordinates;
                        marker.bindTooltip(tooltipText + "  ➟  " + tooltipData.mark_address, {
                            offset: [16, -4],
                            direction: 'right' // Set the direction of the tooltip (top, bottom, left, right)
                        });
                        markersLayer.addLayer(marker);

                        setDataModal(map, markersLayer);
                    }

                    return tooltipData;
                });
            markersLayer.addTo(map);


            // Populate the typeahead search field
            const markIDs = markers.map(marker => ({ search_item: marker.mark_id }));
            const marksAddress = markers.map(marker => ({ search_item: marker.mark_address }));
            const instNames = markers.map(marker => ({ search_item: marker.inst_name }));
            const fullCoordinates = markers.map(marker => ({ search_item: marker.full_coordinates }));

            const listOfMarkIDs = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('search_item'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: markIDs
            });
            const listOfMarkAddr = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('search_item'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: marksAddress
            });
            const listOfInstNames = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('search_item'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: instNames
            });
            const listOfFullCoords = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('search_item'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: fullCoordinates
            });

            const listOfNominatimAddresses = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('search_item'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url: 'https://nominatim.openstreetmap.org/search?format=json&q=%QUERY',
                    wildcard: '%QUERY',
                    rateLimitBy: 'debounce',
                    rateLimitWait: 0, // Adjust this value as needed (in milliseconds)
                    transform: function (response) {
                        // console.log(response); // Check the structure of the response
                        return response.map(result => ({
                            search_item: result.display_name,
                            lat: result.lat,
                            lon: result.lon
                        }));
                    }
                }
            });

            var isRtl = true;
            $('#searchLeafletField').typeahead(
                {
                    hint: !isRtl,
                    highlight: true,
                    minLength: 0
                },
                {
                    name: 'mark-id',
                    source: listOfMarkIDs,
                    display: 'search_item',
                    templates: {
                        header: '<h6 class="league-name border-bottom mb-0 mx-3 mt-3 pb-2">Mark-ID</h6>'
                    }
                },
                {
                    name: 'mark-address',
                    source: listOfMarkAddr,
                    display: 'search_item',
                    templates: {
                        header: '<h6 class="league-name border-bottom mb-0 mx-3 mt-3 pb-2">Address</h6>'
                    }
                },
                {
                    name: 'inst-name',
                    source: listOfInstNames,
                    display: 'search_item',
                    templates: {
                        header: '<h6 class="league-name border-bottom mb-0 mx-3 mt-3 pb-2">Institutions</h6>'
                    }
                },
                {
                    name: 'full-coordinates',
                    source: listOfFullCoords,
                    display: 'search_item',
                    templates: {
                        header: '<h6 class="league-name border-bottom mb-0 mx-3 mt-3 pb-2">Coordinates</h6>'
                    }
                },
                {
                    name: 'nominatim-addresses',
                    source: listOfNominatimAddresses,
                    display: 'search_item',
                    limit: 10,
                    minLength: 0,
                    templates: {
                        header: '<h6 class="league-name border-bottom mb-0 mx-3 mt-3 pb-2">Un-managed Address</h6>'
                    }
                }
            );


            let selectedMarker;
            let selectedCircle;
            $('.typeahead-multi-datasets').on('typeahead:selected', function (event, result) {
                // Clear previously selected marker and circle
                if (selectedMarker) {
                    markersLayer.removeLayer(selectedMarker);
                    selectedMarker = null;
                }
                if (selectedCircle) {
                    markersLayer.removeLayer(selectedCircle);
                    selectedCircle = null;
                }

                // Find the corresponding marker based on the selected result (matching name or address)
                let selectedMarkerData = markers.find(
                    marker =>
                        marker.mark_id === result.search_item ||
                        marker.mark_address === result.search_item ||
                        marker.inst_name === result.search_item ||
                        marker.full_coordinates === result.search_item
                );

                if (!selectedMarkerData) {
                    // If no marker is found, assume it's from the 'listOfNominatimAddresses' dataset
                    selectedMarkerData = {
                        mark_lat: result.lat,
                        mark_lon: result.lon,
                        mark_address: result.search_item
                    };
                }

                if (selectedMarkerData) {
                    // Get the coordinates of the selected marker
                    const selectedCoordinates = [selectedMarkerData.mark_lat, selectedMarkerData.mark_lon];

                    let customIconMarker2;
                    if (selectedMarkerData.mark_color === 'success') {
                        customIconMarker2 = L.icon({
                            iconUrl: 'public/plugins/leaflet-official/leaflet.base.vlastest/dist/images/marker-icon-success.png',
                            iconSize: [21, 38],
                            iconAnchor: [10, 38],
                            popupAnchor: [0, -30]
                        });
                    } else if (selectedMarkerData.mark_color === 'warning') {
                        customIconMarker2 = L.icon({
                            iconUrl: 'public/plugins/leaflet-official/leaflet.base.vlastest/dist/images/marker-icon-warning.png',
                            iconSize: [21, 38],
                            iconAnchor: [10, 38],
                            popupAnchor: [0, -30]
                        });
                    } else {
                        // Use a default icon if no specific icon is defined
                        customIconMarker2 = L.icon({
                            iconUrl: 'public/plugins/leaflet-official/leaflet.base.vlastest/dist/images/marker-icon.png',
                            iconSize: [25, 41],
                            iconAnchor: [12, 41],
                            popupAnchor: [1, -34],
                            shadowUrl: 'public/plugins/leaflet-official/leaflet.base.vlastest/dist/images/marker-shadow.png',
                            shadowSize: [41, 41],
                            shadowAnchor: [12, 41]
                        });
                    }


                    // Create a new marker and circle for the selected result
                    selectedMarker = L.marker(selectedCoordinates, { icon: customIconMarker2 }).bindTooltip(selectedCoordinates + " ➟ " + selectedMarkerData.mark_address, {
                        offset: [16, -4],
                        direction: 'right',
                        permanent: false
                    }).openTooltip();
                    selectedCircle = L.circle(selectedCoordinates, { radius: 0, color: 'red', fillColor: '#f03', fillOpacity: 0.5 });

                    // Add the marker and circle to the map
                    markersLayer.addLayer(selectedMarker);
                    markersLayer.addLayer(selectedCircle);

                    // Log the coordinates
                    setLogCoordinates(selectedMarker, selectedMarkerData);
                    setClearInputBtn(selectedMarker, selectedCircle);

                    // Pan the map to the selected marker
                    map.flyTo(selectedCoordinates, Math.min(18, 18.5));
                }
            });



            $('#searchLeafletField').on('input', function (event) {
                const inputValue = $(this).val();

                if (inputValue === '') {
                    // Clear previously selected marker and circle
                    if (selectedMarker) {
                        markersLayer.removeLayer(selectedMarker);
                        selectedMarker = null; // Set selectedMarker to null to clear it
                    }
                    if (selectedCircle) {
                        markersLayer.removeLayer(selectedCircle);
                        selectedCircle = null; // Set selectedCircle to null to clear it
                    }

                    // map.setView(startingCoordinates, startingZoom);
                    map.flyTo(startingCoordinates, startingZoom);
                } else {
                    // Find the corresponding marker based on the input value
                    let selectedMarkerData = markers.find(marker => marker.mark_id === inputValue || marker.mark_address === inputValue || marker.full_coordinates === inputValue);

                    // Clear the previously selected circle
                    if (selectedCircle) {
                        markersLayer.removeLayer(selectedCircle);
                        selectedCircle = null; // Set selectedCircle to null to clear it
                    }

                    if (selectedMarkerData) {
                        // Clear previously selected marker
                        if (selectedMarker) {
                            markersLayer.removeLayer(selectedMarker);
                            selectedMarker = null;
                        }

                        // Get the coordinates of the selected marker
                        const selectedCoordinates = [selectedMarkerData.mark_lat, selectedMarkerData.mark_lon];
                        const [lat, lon] = selectedCoordinates;

                        let customIconMarker2;
                        if (selectedMarkerData.mark_color === 'success') {
                            customIconMarker2 = L.icon({
                                iconUrl: 'public/plugins/leaflet-official/leaflet.base.vlastest/dist/images/marker-icon-success.png',
                                iconSize: [21, 38],
                                iconAnchor: [10, 38]
                            });
                        } else if (selectedMarkerData.mark_color === 'warning') {
                            customIconMarker2 = L.icon({
                                iconUrl: 'public/plugins/leaflet-official/leaflet.base.vlastest/dist/images/marker-icon-warning.png',
                                iconSize: [21, 38],
                                iconAnchor: [10, 38]
                            });
                        }
                        // Create a new marker and circle for the selected result
                        selectedMarker = L.marker(selectedCoordinates, { icon: customIconMarker2 }).bindTooltip(selectedCoordinates + " ➟ " + selectedMarkerData.mark_address, {
                            offset: [16, -4],
                            direction: 'right',
                            permanent: false
                        }).openTooltip();
                        selectedCircle = L.circle(selectedCoordinates, { radius: 0, color: 'red', fillColor: '#f03', fillOpacity: 0.5 });

                        // Add the marker and circle to the map
                        markersLayer.addLayer(selectedMarker);
                        // Add the circle only if the typed input matches the institution name or address
                        markersLayer.addLayer(selectedMarkerData.mark_id === inputValue || selectedMarkerData.mark_address === inputValue || selectedMarkerData.full_coordinates === inputValue ? selectedCircle : null);

                        // Pan the map to the selected marker
                        // map.panTo(selectedCoordinates);
                        map.flyTo(selectedCoordinates, Math.min(18, 18.5));

                        // Log the coordinates
                        setLogCoordinates(selectedMarker, selectedMarkerData);
                        setClearInputBtn(selectedMarker, selectedCircle);
                    }
                }
            });


            function setLogCoordinates(selectedMarker, selectedMarkerData) {
                selectedMarker.on('click', function () {
                    console.log('Selected mark id:', selectedMarkerData.mark_id);
                    console.log('Selected mark address:', selectedMarkerData.mark_address);
                    setDataModalAfterSearch(selectedMarkerData)     // Show the modal when the marker is clicked
                });
            }


            function setClearInputBtn(selectedMarker = null, selectedCircle = null) {
                const clearInputButton = document.querySelector('.clearInput');
                const searchField = document.getElementById('searchLeafletField');
                clearInputButton.addEventListener('click', () => {
                    searchField.value = '';
                    selectedMarker = null;
                    if (selectedCircle != null) {
                        markersLayer.removeLayer(selectedCircle);
                    }
                    map.flyTo(startingCoordinates, startingZoom);
                });
            }




        })
        .catch(error => {
            console.error('Error:', error);

        });

    return true;
}


function setDataModalAfterSearch(selectedMarkerData = [], whichModal = "viewMarkUserModal") {
    const modalSelector = document.querySelector('#' + whichModal);
    const modalToShow = new bootstrap.Modal(modalSelector);
    const targetedModalForm = document.querySelector('#' + whichModal + ' #viewMarkForm');

    // Retrieve data for the clicked marker
    var mark_id = selectedMarkerData.mark_id;
    const mark_lat = selectedMarkerData.mark_lat;
    const mark_lon = selectedMarkerData.mark_lon;
    const mark_address = selectedMarkerData.mark_address;
    // const created_at = selectedMarkerData.created_at;
    const updated_at = selectedMarkerData.updated_at;


    // Retrieve tooltipData object from marker options
    $('#modalViewMarkID').val(mark_id);
    $('#modalViewLatitude').val(mark_lat);
    $('#modalViewLongitude').val(mark_lon);
    $('#modalViewAddress').val(mark_address);
    $('#modalViewLastUpdate').val(updated_at);
    openModal(modalToShow, modalSelector);

    $('#delete_modalviewMarkUserModal').on('click', function () {
        closeModal(modalToShow);
        $('#mark_id').val(mark_id);

        openModal(new bootstrap.Modal(document.querySelector('#deleteMarkModalMAPS')), document.querySelector('#deleteMarkModalMAPS'));
        const modaldeleteMarkModalMAPSBtn = $(document.querySelector('#deleteMarkModalMAPS')).find('#confirmDelete')[0];
        modaldeleteMarkModalMAPSBtn.addEventListener('click', function () {
            $.ajax({
                url: '/m-mark/delete-mark-maps',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    mark_id_maps: mark_id
                },
                success: function (response) {
                    // Handle success response, e.g., reload the table or show a success message
                    console.log(response);
                    console.log('Mark deleted successfully');
                    markersLayer.removeLayer(layer);
                    // Close the confirmation modal
                    closeModal(new bootstrap.Modal(document.querySelector('#deleteMarkModalMAPS')));
                    location.reload(); // Reload the page to update the table
                },
                error: function (error) {
                    // Handle error response, e.g., show an error message
                    console.log('Error deleting mark:', error);
                }
            });
        });

        const modalDeleteMarkMAPSCancelBtn = $(document.querySelector('#deleteMarkModalMAPS')).find('#cancel_modaldeleteMarkModalMAPS')[0];
        modalDeleteMarkMAPSCancelBtn.addEventListener('click', function () {
            closeModal(new bootstrap.Modal(document.querySelector('#deleteMarkModalMAPS')));
        });




    });
    const closeModalBtn = $(modalSelector).find('#close_modalviewMarkUserModal')[0];
    closeModalBtn.addEventListener('click', function () {
        closeModal(modalToShow);
    });

    const editModalBtn = $(modalSelector).find('#edit_modalviewMarkUserModal')[0];
    editModalBtn.addEventListener('click', function () {
        closeModal(modalToShow);
        $('#modalEditMarkID2MAPS').val(mark_id);
        $('#modalEditLatitudeMAPS').val(mark_lat);
        $('#modalEditLongitudeMAPS').val(mark_lon);
        $('#modalEditMarkAddressMAPS').val(mark_address);
        openModal(new bootstrap.Modal(document.querySelector('#editMarkModalMAPS')), document.querySelector('#editMarkModalMAPS'));
        const modalviewMarkUserModalMAPCancelModalBtn = $(document.querySelector('#editMarkModalMAPS')).find('#cancel_modalviewMarkUserModalMAPS')[0];
        modalviewMarkUserModalMAPCancelModalBtn.addEventListener('click', function () {
            closeModal(modalToShow);
        });

    });
}
// ############################################################# END VIEW ############################################################# //


// ############################################################# START ADD ############################################################# //
function addRightClick(map, markersLayer) {
    map.on('contextmenu taphold', function (e) {
        LAT = e.latlng.lat.toFixed(7);
        LNG = e.latlng.lng.toFixed(7);

        var coordinates = {
            lat: LAT,
            lng: LNG
        };

        console.log("Coordinates:", `[${LAT}, ${LNG}]`);
        console.log("Zoom level:", map.getZoom());

        getNominatingAddr(coordinates);
        function getNominatingAddr(coordinates) {
            // GET ADDRESS FROM NOMINATING DOMAIN
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
                            var provinceValue = province;
                            try {
                                // Perform dynamic swapping for specific directions
                                provinceValue = provinceValue.replace(/north/gi, 'utara');
                                provinceValue = provinceValue.replace(/south/gi, 'selatan');
                                provinceValue = provinceValue.replace(/west/gi, 'barat');
                                provinceValue = provinceValue.replace(/east/gi, 'timur');
                                provinceValue = provinceValue.replace(/central/gi, 'tengah');
                                provinceValue = provinceValue.replace(/java/gi, 'jawa');

                                if (provinceValue.toLowerCase().includes('jawa')) {
                                    provinceValue = provinceValue.replace('jawa', 'Jawa');
                                }
                                // Swap direction with province
                                if (provinceValue.toLowerCase().includes('utara')) {
                                    provinceValue = provinceValue.replace('utara', '');
                                    provinceValue = provinceValue.trim() + ' Utara';
                                } else if (provinceValue.toLowerCase().includes('selatan')) {
                                    provinceValue = provinceValue.replace('selatan', '');
                                    provinceValue = provinceValue.trim() + ' Selatan';
                                } else if (provinceValue.toLowerCase().includes('barat')) {
                                    provinceValue = provinceValue.replace('barat', '');
                                    provinceValue = provinceValue.trim() + ' Barat';
                                } else if (provinceValue.toLowerCase().includes('timur')) {
                                    provinceValue = provinceValue.replace('timur', '');
                                    provinceValue = provinceValue.trim() + ' Timur';
                                } else if (provinceValue.toLowerCase().includes('tengah')) {
                                    provinceValue = provinceValue.replace('tengah', '');
                                    provinceValue = provinceValue.trim() + ' Tengah';
                                }
                            } catch (error) {
                                // console.error('Err (state):', error);
                            }

                            // Generate the address component with the updated value
                            if (provinceValue && postcode) {
                                addressComponents.push(label + ' ' + provinceValue + ' (' + postcode + ')');
                            } else if (provinceValue) {
                                addressComponents.push(label + ' ' + provinceValue);
                            }

                        } else if (key !== 'postcode' && address[key]) {
                            var addressValue = address[key];

                            try {
                                // Perform dynamic swapping for specific directions
                                addressValue = addressValue.replace(/north/gi, 'utara');
                                addressValue = addressValue.replace(/south/gi, 'selatan');
                                addressValue = addressValue.replace(/west/gi, 'barat');
                                addressValue = addressValue.replace(/east/gi, 'timur');
                                addressValue = addressValue.replace(/central/gi, 'tengah');
                                addressValue = addressValue.replace(/java/gi, 'jawa');
                                addressValue = addressValue.replace(/regency/gi, '');


                                if (addressValue.toLowerCase().includes('jawa')) {
                                    addressValue = addressValue.replace('jawa', 'Jawa');
                                }
                                // Swap direction with province
                                if (addressValue.toLowerCase().includes('utara')) {
                                    addressValue = addressValue.replace('utara', '');
                                    addressValue = addressValue.trim() + ' Utara';
                                } else if (addressValue.toLowerCase().includes('selatan')) {
                                    addressValue = addressValue.replace('selatan', '');
                                    addressValue = addressValue.trim() + ' Selatan';
                                } else if (addressValue.toLowerCase().includes('barat')) {
                                    addressValue = addressValue.replace('barat', '');
                                    addressValue = addressValue.trim() + ' Barat';
                                } else if (addressValue.toLowerCase().includes('timur')) {
                                    addressValue = addressValue.replace('timur', '');
                                    addressValue = addressValue.trim() + ' Timur';
                                } else if (addressValue.toLowerCase().includes('tengah')) {
                                    addressValue = addressValue.replace('tengah', '');
                                    addressValue = addressValue.trim() + ' Tengah';
                                }

                            } catch (error) {
                                // console.error('Err (post-code):', error);
                            }

                            // Generate the address component with the updated value
                            if (label && addressValue.toLowerCase().includes(label.toLowerCase())) {
                                addressComponents.push(addressValue);
                            } else {
                                addressComponents.push(label + ' ' + addressValue);
                            }
                        }



                    });


                    var fulladdr = addressComponents.join(', ');
                    // processIt(fulladdr);
                    processIt(fulladdr, LAT, LNG)
                    console.log(fulladdr);
                })
                .catch(error => {
                    console.error('Error (outter):', error.message);
                    processIt("We're using OSRM's demo server, sometimes wont get address automatically :)", LAT, LNG);
                });

        }



        // NOW
        function processIt(institu_addr, LAT, LNG) {
            const institu_name = "Unsaved Marker";
            // const tooltipData = {
            //     tobesearch: institu_name + "  ➟  " + institu_addr
            // };


            customIconMarker = L.icon({
                iconUrl: 'public/plugins/leaflet-official/leaflet.base.vlastest/dist/images/marker-icon-danger.png',
                iconSize: [21, 38], iconAnchor: [10, 38]
            });
            const marker = L.marker([parseFloat(LAT), parseFloat(LNG)], {
                icon: customIconMarker
            });

            // var markModalID = "editMarkModal";
            marker.bindTooltip(institu_name + "  ➟  " + institu_addr, {
                offset: [16, -4],
                direction: 'right' // Set the direction of the tooltip (top, bottom, left, right)
            });



            marker.on('click', function () {
                // $('#modalEditMarkID2MAPS').val(mark_id);
                $('#modalEditLatitudeMAPS2').val(parseFloat(LAT));
                $('#modalEditLongitudeMAPS2').val(parseFloat(LNG));
                $('#modalEditMarkAddressMAPS2').val(institu_addr);
                openModal(new bootstrap.Modal(document.querySelector('#addMarkModalMAPS')), document.querySelector('#addMarkModalMAPS'));
                const modaladdMarkUserModalMAPRemoveBtn = $(document.querySelector('#addMarkModalMAPS')).find('#remove_modalviewMarkUserModalMAPS')[0];
                modaladdMarkUserModalMAPRemoveBtn.addEventListener('click', function () {
                    closeModal(new bootstrap.Modal(document.querySelector('#addMarkModalMAPS')));
                    markersLayer.removeLayer(marker);
                });
                const modaladdMarkUserModalMAPCancelBtn = $(document.querySelector('#addMarkModalMAPS')).find('#cancel_modaladdMarkUserModalMAPS')[0];
                modaladdMarkUserModalMAPCancelBtn.addEventListener('click', function () {
                    closeModal(new bootstrap.Modal(document.querySelector('#addMarkModalMAPS')));
                });
            });

            markersLayer.addLayer(marker);
        }




    });
}
// ############################################################# END ADD ############################################################# //

function getAddressFromCoordinates(coordinates) {
    const url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${coordinates.lat}&lon=${coordinates.lng}`;

    return fetch(url)
        .then(response => {
            if (!response.ok) {
                // throw new Error('Network response was not ok');
                console.log(new Error('Network response was not ok'));
            }
            return response.json();
        })
        .then(data => {
            if (data && data.address) {
                const address = data.address;
                return address;
            } else {
                // throw new Error('Address not found');
                console.log(new Error('Address not found'));
            }
        })
        .catch(error => {
            // throw new Error('Error retrieving address');
            console.log(new Error('Error retrieving address'));
        });
}


// function addResetViewControl(map) {
//     L.control.resetView({
//         position: "topright",
//         title: "Reset view",
//         latlng: L.latLng(startingCoordinates),
//         zoom: startingZoom,
//     }).addTo(map);

//     const resetViewControl = document.querySelector('.leaflet-control-resetview');
//     resetViewControl.addEventListener('click', (event) => {
//         event.preventDefault();
//         map.flyTo(startingCoordinates, startingZoom);
//     });
// }


function addResetViewControl(map) {
    var resetControl = L.control.resetView({
        position: "topright",
        title: "Reset view",
        latlng: L.latLng(map.getCenter()), // Set latlng dynamically using map's current center
        zoom: map.getZoom(), // Set zoom dynamically using map's current zoom level
    }).addTo(map);

    const resetViewControl = document.querySelector('.leaflet-control-resetview');
    resetViewControl.addEventListener('click', (event) => {
        event.preventDefault();
        map.flyTo(startingCoordinates, startingZoom);
    });
}




// ############################################################# MAIN CALLER ############################################################# //

var map = initLeafletMap();
var markersLayer = L.layerGroup();
if (populateMarks4romDB(map, markersLayer)) {
    addResetViewControl(map);
    addRightClick(map, markersLayer);
}

