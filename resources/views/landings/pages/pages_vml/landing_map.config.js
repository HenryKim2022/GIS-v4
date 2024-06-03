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

    document.getElementById('map-overlay').style.display = 'block';
    document.getElementById('map').style.pointerEvents = 'none';
}
function closeModal(modalToShow) {
    isModalActive = false;
    modalToShow.hide();

    document.getElementById('map-overlay').style.display = 'none';
    document.getElementById('map').style.pointerEvents = 'auto';
}

function setDataModal(map, markersLayer, selectedMarkerData = []) {
    const modalSelector = document.querySelector('#viewMarkVisitorModal');
    const modalToShow = new bootstrap.Modal(modalSelector);
    const targetedModalForm = document.querySelector('#viewMarkVisitorModal #viewMarkForm');

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
            const closeModalBtn = $(modalSelector).find('#close_modalviewMarkVisitorModal')[0];
            closeModalBtn.addEventListener('click', function () {
                closeModal(modalToShow);
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
        // zoom: {
        //     scrollWheelZoom: false,
        //     wheelPxPerZoomLevel: 120
        // }
    }).setView(startingCoordinates, startingZoom);

    var appName = "GIS";
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: `Map data &copy; <a href="https://www.openstreetmap.org/">${appName}</a>`
    }).addTo(map);

    // Override scroll behavior for the map container when modal is active
    map.addEventListener('wheel', function (event) {
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
                    const updatedTimestamp = new Date(f.properties.created_at);
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
}


function setDataModalAfterSearch(selectedMarkerData = []) {
    const modalSelector = document.querySelector('#viewMarkVisitorModal');
    const modalToShow = new bootstrap.Modal(modalSelector);
    const targetedModalForm = document.querySelector('#viewMarkVisitorModal #viewMarkForm');

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
    const closeModalBtn = $(modalSelector).find('#close_modalviewMarkVisitorModal')[0];
    closeModalBtn.addEventListener('click', function () {
        closeModal(modalToShow);
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



// ############################################################# MAIN CALLER ############################################################# //

var map = initLeafletMap();
var markersLayer = L.layerGroup();
populateMarks4romDB(map, markersLayer);


