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
            startingZoom = 4.50;
        } else {
            // console.log('PC viewport detected');
            startingCoordinates = [-1.4763993, 118.2211498];
            startingZoom = 4.50;
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
            const institution_lat = layer.options.institution_lat;
            const institution_lon = layer.options.institution_lon;
            const institution_name = layer.options.institution_name;
            const institution_category = layer.options.institution_category;
            const institution_npsn = layer.options.institution_npsn;
            const institution_logo = layer.options.institution_logo;
            const institution_address = layer.options.institution_address;
            const institution_images = layer.options.institution_images;
            const institution_mark_id = layer.options.institution_mark_id;
            const created_at = layer.options.institution_created;
            const updated_at = layer.options.institution_updated;

            console.log(institution_images);
            // Retrieve tooltipData object from marker options

            $('#modalViewLatitude').val(institution_lat);
            $('#modalViewLongitude').val(institution_lon);
            $('#modalViewInstitutionName').val(institution_name);
            $('#modalViewNPSN').val(institution_npsn);
            $('#modalViewAddress').val(institution_address);
            $('#modalViewLastUpdate').val(updated_at);
            // Custom for logo
            var addLogoPreview = $(modalSelector).find('.logo-view-preview-container');
            var logoPreview = addLogoPreview.find('.logo-preview');
            if (institution_logo) {
                var img = new Image();
                img.classList.add('hover-image');
                img.onload = function () {
                    logoPreview.attr('src', img.src);
                };
                img.src = institution_logo;
            } else {
                logoPreview.attr('src', 'public/img/noimage.png');
            }

            // Custom for images
            /// Program images carousal here !!!
            setImages();
            function setImages() {
                setSwiperSlider();
                function setSwiperSlider() {
                    // Initialize Swiper
                    const swiperInstance = new Swiper('.swiper-container', {
                        // Configuration options
                        slidesPerView: 1,
                        spaceBetween: 1,
                        loop: false,
                        navigation: {
                            nextEl: '.swiper-images-btn-next',
                            prevEl: '.swiper-images-btn-prev',
                        },
                        breakpoints: {
                            // When the viewport width is less than or equal to 640px
                            640: {
                                slidesPerView: 1,
                                spaceBetween: 3,
                            },
                            // When the viewport width is greater than 640px and less than or equal to 1024px
                            1024: {
                                slidesPerView: 1,
                                spaceBetween: 3,
                            },
                            // When the viewport width is greater than 1024px
                            1024: {
                                slidesPerView: 1,
                                spaceBetween: 3,
                            },
                        },
                        observer: true,
                        observeParents: true,
                        observeSlideChildren: true,
                    });

                    // Clear existing slider items
                    const swiperWrapper = document.querySelector('.swiper-wrapper');
                    swiperWrapper.innerHTML = '';
                    genSliderItem();
                    function genSliderItem() {
                        // Generate the slider items
                        if (institution_images === null) {
                            const slide = document.createElement('div');
                            slide.classList.add('swiper-slide');
                            slide.classList.add('d-flex');
                            slide.classList.add('justify-content-center');
                            slide.classList.add('align-items-center');

                            const imgElement = document.createElement('img');
                            imgElement.src = 'public/img/noimage.png'; // Use the default image URL
                            imgElement.alt = 'No Image';
                            imgElement.style.height = '40px'; // Set the height directly
                            imgElement.id = 'image1'; // Assign an ID to the image element

                            slide.appendChild(imgElement);
                            swiperWrapper.appendChild(slide);
                        } else {
                            institution_images.forEach((image, imageIndex) => {
                                const slide = document.createElement('div');
                                slide.classList.add('swiper-slide');
                                slide.classList.add('d-flex');
                                slide.classList.add('justify-content-center');
                                slide.classList.add('align-items-center');

                                const imgElement = document.createElement('img');
                                imgElement.alt = image.alt;
                                imgElement.style.height = '40px'; // Set the height directly
                                imgElement.id = `image${imageIndex + 1}`; // Assign an ID to the image element
                                if (image.src) {
                                    imgElement.src = image.src; // Use the provided image URL
                                } else {
                                    imgElement.src = 'public/img/noimage.png'; // Use the default image URL
                                }

                                slide.appendChild(imgElement);
                                swiperWrapper.appendChild(slide);
                            });
                        }
                    }
                }
            }



            openModal(modalToShow, modalSelector);
            const closeModalBtn = $(modalSelector).find('#close_modalviewMarkUserModal')[0];
            closeModalBtn.addEventListener('click', function () {
                closeModal(modalToShow);
            });

            const editModalBtn = $(modalSelector).find('#edit_modalviewMarkUserModal')[0];
            editModalBtn.addEventListener('click', function () {
                closeModal(modalToShow);

                $('#modalEditMarkID2MAPS').val(institution_mark_id);
                $('#modalEditLatitudeMAPS').val(institution_lat);
                $('#modalEditLongitudeMAPS').val(institution_lon);
                $('#modalEditMarkAddressMAPS').val(institution_address);
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
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: `Map data &copy; <a href="https://www.openstreetmap.org/">${appName}</a>`
    }).addTo(map);

    L.control.mousePosition({
        position: 'bottomright',
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
            startingZoom = 4.50;
            map.setView(startingCoordinates, startingZoom);
        } else {
            console.log('PC viewport detected');
            startingCoordinates = [-1.4763993, 118.2211498];
            startingZoom = 4.50;
            map.setView(startingCoordinates, startingZoom);
        }
    }
    window.addEventListener('onload', handleViewportChange);
    handleViewportChange();



    return map;
}



function addSchoolnameSearchControlbyMark(map, markersLayer, propertyNamed, txtPHolder) {
    var searchControl = L.control.search({
        layer: markersLayer,
        position: 'topleft',
        initial: false,
        zoom: 48,
        propertyName: propertyNamed,
        textPlaceholder: 'Search by ' + txtPHolder,
        firstTipSubmit: true,
        textErr: txtPHolder + " wasn't found :(",
        hideMarkerOnCollapse: true,
        filterData: function (text, records) {
            // console.log("KEYWORDS: " + text);
            // console.log(records);
            records = this._defaultFilterData(text, records);
            return (records);
        },
        moveToLocation: function (latlng, title, map) {
            console.log("SELECTED RESULT:\n  title: " + title + " > coordinates: " + latlng.lat + ", " + latlng.lng);
            this._defaultMoveToLocation(latlng, title, map);
        }
    }).addTo(map);

    searchControl.on('search:locationfound', function (e) {
        // Show tooltip code
        var marker = e.layer;
        var tooltipText = marker.getTooltip().getContent();
        marker.bindTooltip(tooltipText, {
            permanent: true
        }).openTooltip();
    });
}



function populateMarks4romDB(map, markersLayer) {
    fetch('/landing-page/loadmark')
        .then(response => response.json())
        .then(data => {
            const markers = data.features
                .filter(f => f.properties.institu_name)
                .map(f => {
                    const coordinates = f.geometry.coordinates.map(parseFloat).reverse();
                    const createdTimestamp = new Date(f.properties.created_at);
                    const updatedTimestamp = new Date(f.properties.updated_at);
                    const tooltipData = {
                        full_coordinates: coordinates || "none",
                        institution_lat: coordinates[0] || "none",
                        institution_lon: coordinates[1] || "none",
                        institution_id: f.properties.institu_id || "none",
                        institution_name: f.properties.institu_name || "none",
                        institution_cat: f.properties.institu_category || "none",
                        institution_npsn: f.properties.institu_npsn || "none",
                        institution_logo: f.properties.institu_logo || "none",
                        institution_address: f.properties.institu_address || "none",
                        institution_images: f.properties.institu_images || [],
                        institution_mark_id: f.properties.institu_mark_id || "none",
                        institution_created: createdTimestamp.toLocaleString('id-ID', {
                            timeZone: 'Asia/Jakarta',
                            hour12: true
                        }) || "none",
                        institution_updated: updatedTimestamp.toLocaleString('id-ID', {
                            timeZone: 'Asia/Jakarta',
                            hour12: true
                        }) || "none"
                    };

                    const marker = L.marker(coordinates, tooltipData);
                    applyMarksToolTips();
                    function applyMarksToolTips() {
                        marker.bindTooltip(tooltipData.institution_name + "  ➟  " + tooltipData.institution_address);
                        markersLayer.addLayer(marker);

                        setDataModal(map, markersLayer);
                    }

                    return tooltipData;
                });
            markersLayer.addTo(map);



            // console.log(markers);
            // console.log("Data:", data);
            // Populate the typeahead search field
            const institutionsNames = markers.map(marker => ({ search_item: marker.institution_name }));
            const institutionsAddress = markers.map(marker => ({ search_item: marker.institution_address }));
            const fullCoordinates = markers.map(marker => ({ search_item: marker.full_coordinates }));

            const listOfInstName = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('search_item'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: institutionsNames
            });
            const listOfInstAddr = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('search_item'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: institutionsAddress
            });
            const listOfFullCoords = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('search_item'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: fullCoordinates
            });

            var isRtl = true;
            $('#searchLeafletField').typeahead(
                {
                    hint: !isRtl,
                    highlight: true,
                    minLength: 0
                },
                {
                    name: 'inst-name',
                    source: listOfInstName,
                    display: 'search_item',
                    templates: {
                        header: '<h6 class="league-name border-bottom mb-0 mx-3 mt-3 pb-2">Institution Name</h6>'
                    }
                },
                {
                    name: 'inst-address',
                    source: listOfInstAddr,
                    display: 'search_item',
                    templates: {
                        header: '<h6 class="league-name border-bottom mb-0 mx-3 mt-3 pb-2">Address</h6>'
                    }
                },
                {
                    name: 'full-coordinates',
                    source: listOfFullCoords,
                    display: 'search_item',
                    templates: {
                        header: '<h6 class="league-name border-bottom mb-0 mx-3 mt-3 pb-2">Coordinates</h6>'
                    }
                }
            );


            let selectedMarker;
            let selectedCircle;
            $('.typeahead-multi-datasets').on('typeahead:selected', function (event, result) {
                // Clear previously selected marker and circle
                if (selectedMarker) {
                    markersLayer.removeLayer(selectedMarker);
                }
                if (selectedCircle) {
                    markersLayer.removeLayer(selectedCircle);
                    // map.setView(startingCoordinates, startingZoom);
                    map.flyTo(startingCoordinates, startingZoom);
                }

                // Find the corresponding marker based on the selected result (matching name or address)
                const selectedMarkerData = markers.find(marker => marker.institution_name === result.search_item || marker.institution_address === result.search_item || marker.full_coordinates === result.search_item);
                if (selectedMarkerData) {
                    // Get the coordinates of the selected marker
                    const selectedCoordinates = [selectedMarkerData.institution_lat, selectedMarkerData.institution_lon];
                    const [lat, lon] = selectedCoordinates;

                    // Create a new marker and circle for the selected result
                    selectedMarker = L.marker(selectedCoordinates).bindTooltip(selectedMarkerData.institution_name + " ➟ " + selectedMarkerData.institution_address, {
                        permanent: false
                    }).openTooltip();
                    selectedCircle = L.circle(selectedCoordinates, { radius: 0, color: 'red' });

                    // Add the marker and circle to the map
                    markersLayer.addLayer(selectedMarker);
                    markersLayer.addLayer(selectedCircle);

                    // Pan the map to the selected marker
                    // map.panTo(selectedCoordinates);
                    map.flyTo(selectedCoordinates, 8.5);
                    // Zoom the map to the selected marker
                    // map.setZoom(15); // Adjust the zoom level as needed

                    // Log the coordinates
                    selectedMarker.on('click', function () {
                        // Show the modal when the marker is clicked
                        console.log('institu_id:', selectedMarkerData.institution_id);
                        console.log('Selected coordinates:', lat, lon);
                        setDataModalAfterSearch(selectedMarkerData)
                        // modalToShow.show();
                    });



                    const clearInputButton = document.querySelector('.clearInput');
                    const searchField = document.getElementById('searchLeafletField');
                    clearInputButton.addEventListener('click', () => {
                        searchField.value = '';
                        markersLayer.removeLayer(selectedCircle);
                        map.flyTo(startingCoordinates, startingZoom);
                    });

                }
            });




            $('#searchLeafletField').on('input', function () {
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
                    const selectedMarkerData = markers.find(marker =>
                        marker.institution_name === inputValue || marker.institution_address === inputValue
                    );

                    // Clear the previously selected circle
                    if (selectedCircle) {
                        markersLayer.removeLayer(selectedCircle);
                        selectedCircle = null; // Set selectedCircle to null to clear it
                    }

                    if (selectedMarkerData) {
                        // Clear previously selected marker
                        if (selectedMarker) {
                            markersLayer.removeLayer(selectedMarker);
                        }

                        // Get the coordinates of the selected marker
                        const selectedCoordinates = [selectedMarkerData.institution_lat, selectedMarkerData.institution_lon];
                        const [lat, lon] = selectedCoordinates;

                        // Create a new marker and circle for the selected result
                        selectedMarker = L.marker(selectedCoordinates).bindTooltip(selectedMarkerData.institution_name + " ➟ " + selectedMarkerData.institution_address, {
                            permanent: true
                        }).openTooltip();
                        selectedCircle = L.circle(selectedCoordinates, { radius: 0, color: 'red' });
                        // Add the marker and circle to the map
                        markersLayer.addLayer(selectedMarker);

                        // Add the circle only if the typed input matches the institution name or address
                        markersLayer.addLayer(selectedMarkerData.institution_name === inputValue || selectedMarkerData.institution_address === inputValue || selectedMarkerData.full_coordinates === inputValue ? selectedCircle : null);

                        // Pan the map to the selected marker
                        // map.panTo(selectedCoordinates);
                        map.flyTo(selectedCoordinates, 8.5);


                        // Log the coordinates
                        selectedMarker.on('click', function () {
                            // Show the modal when the marker is clicked
                            console.log('institu_id:', selectedMarkerData.institution_id);
                            console.log('Selected coordinates:', lat, lon);
                            setDataModalAfterSearch(selectedMarkerData)
                        });

                        const clearInputButton = document.querySelector('.clearInput');
                        const searchField = document.getElementById('searchLeafletField');
                        clearInputButton.addEventListener('click', () => {
                            searchField.value = '';
                            markersLayer.removeLayer(selectedCircle);
                            map.flyTo(startingCoordinates, startingZoom);
                        });

                    }
                }
            });

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

    $('#modalViewLatitude').val(selectedMarkerData.institution_lat);
    $('#modalViewLongitude').val(selectedMarkerData.institution_lon);
    $('#modalViewInstitutionName').val(selectedMarkerData.institution_name);
    $('#modalViewNPSN').val(selectedMarkerData.institution_npsn);
    $('#modalViewAddress').val(selectedMarkerData.institution_address);
    $('#modalViewLastUpdate').val(selectedMarkerData.institution_updated);

    // Custom for logo
    var addLogoPreview = $(modalSelector).find('.logo-view-preview-container');
    var logoPreview = addLogoPreview.find('.logo-preview');
    if (selectedMarkerData.institution_logo) {
        var img = new Image();
        img.classList.add('hover-image');
        img.onload = function () {
            logoPreview.attr('src', img.src);
        };
        img.src = selectedMarkerData.institution_logo;
    } else {
        logoPreview.attr('src', 'public/img/noimage.png');
    }

    // Custom for images
    /// Program images carousal here !!!
    setImages();
    function setImages() {
        setSwiperSlider();
        function setSwiperSlider() {
            // Initialize Swiper
            const swiperInstance = new Swiper('.swiper-container', {
                // Configuration options
                slidesPerView: 1,
                spaceBetween: 1,
                loop: false,
                navigation: {
                    nextEl: '.swiper-images-btn-next',
                    prevEl: '.swiper-images-btn-prev',
                },
                breakpoints: {
                    // When the viewport width is less than or equal to 640px
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 3,
                    },
                    // When the viewport width is greater than 640px and less than or equal to 1024px
                    1024: {
                        slidesPerView: 1,
                        spaceBetween: 3,
                    },
                    // When the viewport width is greater than 1024px
                    1024: {
                        slidesPerView: 1,
                        spaceBetween: 3,
                    },
                },
                observer: true,
                observeParents: true,
                observeSlideChildren: true,
            });

            // Clear existing slider items
            const swiperWrapper = document.querySelector('.swiper-wrapper');
            swiperWrapper.innerHTML = '';
            genSliderItem();
            function genSliderItem() {
                // Generate the slider items
                if (selectedMarkerData.institution_images === null) {
                    const slide = document.createElement('div');
                    slide.classList.add('swiper-slide');
                    slide.classList.add('d-flex');
                    slide.classList.add('justify-content-center');
                    slide.classList.add('align-items-center');

                    const imgElement = document.createElement('img');
                    imgElement.src = 'public/img/noimage.png'; // Use the default image URL
                    imgElement.alt = 'No Image';
                    imgElement.style.height = '40px'; // Set the height directly
                    imgElement.id = 'image1'; // Assign an ID to the image element

                    slide.appendChild(imgElement);
                    swiperWrapper.appendChild(slide);
                } else {
                    selectedMarkerData.institution_images.forEach((image, imageIndex) => {
                        const slide = document.createElement('div');
                        slide.classList.add('swiper-slide');
                        slide.classList.add('d-flex');
                        slide.classList.add('justify-content-center');
                        slide.classList.add('align-items-center');

                        const imgElement = document.createElement('img');
                        imgElement.alt = image.alt;
                        imgElement.style.height = '40px'; // Set the height directly
                        imgElement.id = `image${imageIndex + 1}`; // Assign an ID to the image element
                        if (image.src) {
                            imgElement.src = image.src; // Use the provided image URL
                        } else {
                            imgElement.src = 'public/img/noimage.png'; // Use the default image URL
                        }

                        slide.appendChild(imgElement);
                        swiperWrapper.appendChild(slide);
                    });
                }
            }
        }
    }

    openModal(modalToShow, modalSelector);
    const closeModalBtn = $(modalSelector).find('#close_modalviewMarkUserModal')[0];
    closeModalBtn.addEventListener('click', function () {
        closeModal(modalToShow);
    });
}
// ############################################################# END VIEW ############################################################# //

// ############################################################# START ADD ############################################################# //
function addRightClick(map, markersLayer) {
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
                console.log(fulladdr);
            })
            .catch(error => {
                console.error('Error (outter):', error.message);
                // processIt("We're using OSRM's demo server, sometimes wont get address automatically :)");
            });



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


function initializeSearchControl(map, markersLayer) {
    var searchControl = L.control.search({
        layer: markersLayer,
        position: 'topleft',
        initial: false,
        zoom: 48,
        propertyName: 'institution_name',
        textPlaceholder: 'Search by school name',
        firstTipSubmit: true,
        // textErr: txtPHolder + " wasn't found :(",
        hideMarkerOnCollapse: true,
        filterData: function (text, records) {
            // console.log("KEYWORDS: " + text);
            // console.log(records);
            records = this._defaultFilterData(text, records);
            return (records);
        },
        moveToLocation: function (latlng, title, map) {
            console.log("SELECTED RESULT:\n  title: " + title + " > coordinates: " + latlng.lat + ", " + latlng.lng);
            this._defaultMoveToLocation(latlng, title, map);
        },
        search: function (text, layer) {
            // Custom search function if needed
            // You can modify this function according to your search requirements
            return layer.filter(function (item) {
                return item.feature.properties.institu_name.toLowerCase().indexOf(text.toLowerCase()) !== -1;
            });
        }
    }).addTo(map);

    searchControl.on('search:locationfound', function (e) {
        // Show tooltip code
        var marker = e.layer;
        var tooltipText = marker.getTooltip().getContent();
        marker.bindTooltip(tooltipText, {
            permanent: true
        }).openTooltip();
    });
}


function addResetViewControl(map) {
    L.control.resetView({
        position: "topright",
        title: "Reset view",
        latlng: L.latLng(startingCoordinates),
        zoom: startingZoom,
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

