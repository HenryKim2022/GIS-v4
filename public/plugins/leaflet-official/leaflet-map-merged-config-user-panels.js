var imgu = "public/img/noimage.png";
var controlSearch;
var mycurrentLat, mycurrentLng;

let isModalActive = false;
const modal = document.getElementById('editMarkModal');
var fullscreenControl;
var fullscreenElement;

function openModal() {
    isModalActive = true;
}
function closeModal() {
    isModalActive = false;
}


function initializeMap() {
    var map = new L.Map('map', {
        fullscreenControl: true,
        fullscreenControlOptions: {
            position: 'topleft',
            forcePseudoFullscreen: false
        },
        gestureHandling: true,
    }).setView([-3.4763993, 115.2211498], 4.50);

    // L.Control.geocoder().addTo(map);

    //  // Add a class to the map container when in fullscreen mode
    //  map.on('enterFullscreen', function () {
    //     document.getElementById('map').classList.add('fullscreen-map');
    // });

    // // Remove the class when exiting fullscreen mode
    // map.on('exitFullscreen', function () {
    //     document.getElementById('map').classList.remove('fullscreen-map');
    // });


    fullscreenControl = map.fullscreenControl;
    fullscreenElement = fullscreenControl.getContainer();
    // Override scroll behavior for the fullscreen element when modal is active
    fullscreenElement.addEventListener('scroll', function (event) {
        if (isModalActive) {
            event.stopPropagation();
        }
    });


    // Override scroll behavior for the map container when modal is active
    map.addEventListener('wheel', function (event) {
        if (isModalActive) {
            event.stopPropagation();
        }
    }, { passive: false });


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
        hideMarkerOnCollapse: true
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



function addAddressSearchControl(map, markersLayer) {
    var searchMarker;
    L.Control.geocoder({
        defaultMarkGeocode: false,
        position: 'topleft',
        placeholder: 'Search by address',
        geocoder: L.Control.Geocoder.nominatim(),
    }).on('markgeocode', function (e) {
        var latlng = e.geocode.center;
        map.setView(latlng, 16); // Set the map view to the geocoded location
        // Remove previous marker and popup, if any
        if (searchMarker) {
            map.removeLayer(searchMarker);
        }

        searchMarker = L.marker(latlng).addTo(map); // Add a marker at the geocoded location
        if (e.geocode.raw && e.geocode.raw.icon) {
            var imageUrl = 'https://www.openstreetmap.org' + e.geocode.raw.icon; // Get the URL of the street view image
            var popupContent = '<img src="' + imageUrl + '" alt="Street View" style="width: 20;">';
            searchMarker.bindPopup(popupContent).openPopup(); // Bind the popup with the street view image and open it
        } else {
            searchMarker.bindPopup('No image available').openPopup(); // Fallback content if image is not available
        }

        // Remove marker and popup on double-click
        searchMarker.on('dblclick', function () {
            map.removeLayer(searchMarker);
            searchMarker = null;
        });

    }).addTo(map);
}

function addLocateMeControl(map, markersLayer) {
    L.control.locate({
        position: 'topright',
        strings: {
            title: "Locate me!"
        },
        flyTo: true,
        setView: 'untilPan',  //untilPan or always
        locateOptions: {
            enableHighAccuracy: true
        },
        maxZoom: function (map) {
            return Math.min(map.getZoom(), 1);
        }
    }).addTo(map);

    map.on('locationfound', function (e) {
        var latitude = e.latitude;
        var longitude = e.longitude;
        mycurrentLat = latitude;
        mycurrentLng = longitude;
        console.log('My Locations >\nLatitude:', mycurrentLat, 'Longitude:', mycurrentLng);
        // addGeocodeTracksControl(map, markersLayer);
    });


}

function populateMapWithMarkers(map, markersLayer) {
    school500.features
        .filter(f => f.properties['institu_name'])
        .forEach(f => {
            const coordinates = f.geometry.coordinates.slice().reverse();
            const tooltipData = {
                tobesearch1: f.properties.institu_name,
                tobesearch2: f.properties.institu_address,
            }
            const populateMarker = L.marker(coordinates, tooltipData);

            const institu_name = f.properties['institu_name'] || "none";
            const institu_npsn = f.properties['institu_npsn'] || "none";
            const imgLogo = f.properties['institu_logo'] || "none";
            const institu_addr = f.properties['institu_address'] || "none";
            const institu_images = f.properties['institu_image'] || [];
            const last_update = f.properties['updated_at'] || "never";


            continueTOprocess(institu_addr);
            function continueTOprocess(final_addr) {
                const isImgLogoExist = imgLogo.endsWith('.png') || imgLogo.endsWith('.jpg') ? imgLogo : '';
                // const isImgsExist = institu_images.endsWith('.png') || institu_images.endsWith('.jpg') ? institu_images : '';
                const isImgsExist = Array.isArray(institu_images) && institu_images.length > 0 && (institu_images[0].endsWith('.png') || institu_images[0].endsWith('.jpg')) ? institu_images[0] : '';
                const imgWidth = imgLogo.endsWith('.png') || imgLogo.endsWith('.jpg') ? '30' : '80';

                var markModalID = "viewMarkModal";
                populateMarker.bindTooltip(institu_name + "  ➟  " + final_addr);

                document.addEventListener('DOMContentLoaded', function () {
                    populateMarker.on('click', function () {
                        var markModal = document.getElementById(markModalID);
                        $(markModal).modal("show");
                        openModal();
                        // $('#viewMarkModal').modal('show');  // Replace 'myModal' with the ID of your Bootstrap modal

                        isModalActive = true;
                        var modalViewLatitude = document.getElementById('modalViewLatitude');
                        modalViewLatitude.value = coordinates[0];
                        var modalViewLongitude = document.getElementById('modalViewLongitude');
                        modalViewLongitude.value = coordinates[1];
                        var modalViewInstitutionName = document.getElementById('modalViewInstitutionName');
                        modalViewInstitutionName.value = institu_name;
                        var modalViewNPSN = document.getElementById('modalViewNPSN');
                        modalViewNPSN.value = institu_npsn;
                        var modalViewAddress = document.getElementById('modalViewAddress');
                        modalViewAddress.value = institu_addr;
                        var modalViewLastUpdate = document.getElementById('modalViewLastUpdate');
                        modalViewLastUpdate.value = last_update;

                        addLogo2Modal(LogoPreviewId = "modalViewLogoPreview");
                        addImages2Modal();

                    });
                    markersLayer.addLayer(populateMarker);
                })

                function addLogo2Modal(LogoPreviewId = "") {
                    setLogo();
                    function setLogo() {
                        var modalLogoPreview = document.getElementById(LogoPreviewId);
                        // Check if logo already exists
                        if (modalLogoPreview.childElementCount === 0) {
                            updateLogoPreview(imgLogo);
                        }
                        function updateLogoPreview(imageSrc) {
                            var logoImage = document.createElement('img');
                            logoImage.src = imageSrc;
                            logoImage.classList.add('logo-preview');
                            logoImage.style.width = '96px';
                            logoImage.style.height = '96px';

                            modalLogoPreview.appendChild(logoImage);
                        }
                    }
                }

                function addImages2Modal() {
                    setImages()
                    function setImages() {
                        // setBS5Slider("carouselExampleDark");
                        // function setBS5Slider(BS5SliderID) {
                        //     const carouselIndicators = document.getElementById('caro_indicators');
                        //     const carouselInner = document.getElementById('caro_items');

                        //     institu_images.forEach((image, imageIndex) => {
                        //         // Create indicator button
                        //         const slideIndiBtn = document.createElement('button');
                        //         slideIndiBtn.type = 'button';
                        //         slideIndiBtn.setAttribute('data-bs-target', '#' + BS5SliderID);
                        //         slideIndiBtn.setAttribute('data-bs-slide-to', imageIndex);

                        //         if (imageIndex === 0) {
                        //             slideIndiBtn.classList.add('active');
                        //         }
                        //         carouselIndicators.appendChild(slideIndiBtn);


                        //         // Create carousel item
                        //         const carouselItem = document.createElement('div');
                        //         carouselItem.classList.add('carousel-item');
                        //         carouselItem.classList.add('d-flex');
                        //         carouselItem.classList.add('justify-content-center');
                        //         carouselItem.classList.add('align-items-center');

                        //         if (imageIndex === 0) {
                        //             carouselItem.classList.add('active');
                        //         }

                        //         const img = document.createElement('img');
                        //         img.classList.add('d-block', 'w-8');
                        //         img.id = "caro_img_" + imageIndex;
                        //         img.type = 'button';
                        //         img.style.width = '101px';
                        //         img.style.height = '101px';
                        //         img.src = image;
                        //         carouselItem.appendChild(img);

                        //         carouselInner.appendChild(carouselItem);
                        //     });
                        // }



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
                                institu_images.forEach((image, imageIndex) => {
                                    const slide = document.createElement('div');
                                    slide.classList.add('swiper-slide');
                                    slide.classList.add('d-flex');
                                    slide.classList.add('justify-content-center');
                                    slide.classList.add('align-items-center');

                                    const imgElement = document.createElement('img');
                                    imgElement.src = image;
                                    imgElement.alt = `Image ${imageIndex + 1}`;
                                    imgElement.style.height = '40px'; // Set the height directly
                                    imgElement.id = `image${imageIndex + 1}`; // Assign an ID to the image element

                                    slide.appendChild(imgElement);

                                    swiperWrapper.appendChild(slide);
                                });
                            }
                        }




                    }

                    // function setImages() {
                    //     setSwiperSlider();
                    //     function setSwiperSlider() {
                    //         // Initialize Swiper
                    //         const swiperInstance = new Swiper('.swiper-container', {
                    //             // Configuration options
                    //             slidesPerView: 1,
                    //             spaceBetween: 1,
                    //             loop: true,
                    //             navigation: {
                    //                 nextEl: '.swiper-images-btn-next',
                    //                 prevEl: '.swiper-images-btn-prev',
                    //             },
                    //             breakpoints: {
                    //                 // When the viewport width is less than or equal to 640px
                    //                 640: {
                    //                     slidesPerView: 1,
                    //                     spaceBetween: 1,
                    //                 },
                    //                 // When the viewport width is greater than 640px and less than or equal to 1024px
                    //                 1024: {
                    //                     slidesPerView: 1,
                    //                     spaceBetween: 2,
                    //                 },
                    //                 // When the viewport width is greater than 1024px
                    //                 1024: {
                    //                     slidesPerView: 1,
                    //                     spaceBetween: 3,
                    //                 },
                    //             },
                    //             observer: true,
                    //             observeParents: true,
                    //             observeSlideChildren: true,
                    //         });

                    //         // Clear existing slider items
                    //         const swiperWrapper = document.querySelector('.swiper-wrapper');
                    //         swiperWrapper.innerHTML = '';

                    //         genSliderItem();
                    //         function genSliderItem() {
                    //             // Generate the slider items
                    //             institu_images.forEach((image, imageIndex) => {
                    //                 const slide = document.createElement('div');
                    //                 slide.classList.add('swiper-slide');
                    //                 slide.classList.add('d-flex');
                    //                 slide.classList.add('justify-content-center');
                    //                 slide.classList.add('align-items-center');

                    //                 const imgElement = document.createElement('img');
                    //                 imgElement.src = image;
                    //                 imgElement.alt = `Image ${imageIndex + 1}`;
                    //                 imgElement.style.height = '48px'; // Set the height directly
                    //                 imgElement.id = `image${imageIndex + 1}`; // Assign an ID to the image element

                    //                 slide.appendChild(imgElement);

                    //                 swiperWrapper.appendChild(slide);
                    //             });
                    //         }




                    //     }
                    // }
                }


            }

        });

    addSchoolnameSearchControlbyMark(map, markersLayer, 'tobesearch1', 'school name');
    addSchoolnameSearchControlbyMark(map, markersLayer, 'tobesearch2', 'school address');
}


// Detect touch devices
if ('ontouchstart' in window || navigator.maxTouchPoints) {
    document.body.classList.add('touch-device');
}





// // // VER 2
function addMarkerOnContextMenu(map, markersLayer) {
    map.on('contextmenu taphold', function (e) {
        if (isModalActive) {
            // e.preventDefault();
        }

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
                processIt("We're using OSRM's demo server, sometimes wont get address automatically :)");
            });

        function processIt(institu_addr) {
            const institu_name = "Untitled Marker";
            const institu_npsn = "fill data!";
            const imgLogo = imgu; // Corrected variable name
            const institu_images = [
                imgu,
                imgu,
                imgu
            ];
            const last_update = "never";

            const tooltipData = {
                tobesearch: institu_name
            };


            const marker = L.marker(new L.latLng([LAT, LNG]), tooltipData);

            var markModalID = "editMarkModal";
            marker.bindTooltip(institu_name + "  ➟  " + institu_addr);
            marker.on('click', function () {
                var markModal = document.getElementById(markModalID);
                $(markModal).modal("show");
                openModal();

                var modalViewLatitude = document.getElementById('modalEditLatitude');
                modalViewLatitude.value = coordinates['lat'];
                var modalViewLongitude = document.getElementById('modalEditLongitude');
                modalViewLongitude.value = coordinates['lng'];
                var modalViewInstitutionName = document.getElementById('modalEditInstitutionName');
                modalViewInstitutionName.value = institu_name;
                var modalViewNPSN = document.getElementById('modalEditNPSN');
                modalViewNPSN.value = institu_npsn;
                var modalViewAddress = document.getElementById('modalEditAddress');
                modalViewAddress.value = institu_addr;
                var modalViewLastUpdate = document.getElementById('modalEditLastUpdate');
                modalViewLastUpdate.value = last_update;

                addLogo2Modal(LogoPreviewId = "modalEditLogoPreview");
                addImages2Modal();


                var modalSaveButton = document.querySelector('.modal-mark-save-btn');
                if (modalSaveButton) {
                    modalSaveButton.addEventListener('click', function () {
                        // $('#editMarkModal').modal('hide');
                        // newMarker.setPopupContent(updatedPopupContent);
                        // $(markModal).modal("hide");
                        closeModal();
                    });
                }
                var modalRemoveButton = document.querySelector('.modal-mark-remove-btn');
                if (modalRemoveButton) {
                    modalRemoveButton.addEventListener('click', function () {
                        markersLayer.removeLayer(marker);
                        $(markModal).modal("hide");
                        closeModal();
                    });
                }
                var modalCancelButton = document.querySelector('.modal-mark-cancel-btn');
                if (modalCancelButton) {
                    modalCancelButton.addEventListener('click', function () {
                        // $('#editMarkModal').modal('hide');
                        $(markModal).modal("hide");
                        closeModal();
                    });
                }

                function addLogo2Modal(LogoPreviewId = "") {
                    setLogo();
                    function setLogo() {
                        var modalLogoPreview = document.getElementById(LogoPreviewId);
                        // Check if logo already exists
                        if (modalLogoPreview.childElementCount === 0) {
                            updateLogoPreview(imgLogo);
                        }
                        function updateLogoPreview(imageSrc) {
                            var logoImage = document.createElement('img');
                            logoImage.src = imageSrc;
                            logoImage.classList.add('logo-preview');
                            logoImage.style.width = '96px';
                            logoImage.style.height = '96px';

                            modalLogoPreview.appendChild(logoImage);
                        }
                    }
                }

                function addImages2Modal() {
                    setImages()
                    function setImages() {
                        // // setBS5Slider();
                        // function setBS5Slider(BS5SliderID) {
                        //     const carouselIndicators = document.getElementById('caro_indicators');
                        //     const carouselInner = document.getElementById('caro_items');

                        //     institu_images.forEach((image, imageIndex) => {
                        //         // Create indicator button
                        //         const slideIndiBtn = document.createElement('button');
                        //         slideIndiBtn.setAttribute('data-bs-target', '#' + BS5SliderID);
                        //         slideIndiBtn.setAttribute('data-bs-slide-to', imageIndex);

                        //         if (imageIndex === 0) {
                        //             slideIndiBtn.classList.add('active');
                        //         }
                        //         carouselIndicators.appendChild(slideIndiBtn);


                        //         // Create carousel item
                        //         const carouselItem = document.createElement('div');
                        //         carouselItem.classList.add('carousel-item');
                        //         carouselItem.classList.add('d-flex');
                        //         carouselItem.classList.add('justify-content-center');
                        //         carouselItem.classList.add('align-items-center');

                        //         if (imageIndex === 0) {
                        //             carouselItem.classList.add('active');
                        //         }

                        //         const img = document.createElement('img');
                        //         img.classList.add('d-block', 'w-100');
                        //         img.src = image;
                        //         carouselItem.appendChild(img);

                        //         carouselInner.appendChild(carouselItem);
                        //     });
                        // }



                        // // setSwiperSlider();
                        // function setSwiperSlider() {
                        //     // Initialize Swiper
                        //     const swiperInstance = new Swiper('.swiper-container', {
                        //         // Configuration options
                        //         slidesPerView: 1,
                        //         spaceBetween: 1,
                        //         loop: true,
                        //         navigation: {
                        //             nextEl: '.swiper-images-btn-next',
                        //             prevEl: '.swiper-images-btn-prev',
                        //         },
                        //         breakpoints: {
                        //             // When the viewport width is less than or equal to 640px
                        //             640: {
                        //                 slidesPerView: 1,
                        //                 spaceBetween: 1,
                        //             },
                        //             // When the viewport width is greater than 640px and less than or equal to 1024px
                        //             1024: {
                        //                 slidesPerView: 1,
                        //                 spaceBetween: 2,
                        //             },
                        //             // When the viewport width is greater than 1024px
                        //             1024: {
                        //                 slidesPerView: 1,
                        //                 spaceBetween: 3,
                        //             },
                        //         },
                        //         observer: true,
                        //         observeParents: true,
                        //         observeSlideChildren: true,
                        //     });

                        //     // Clear existing slider items
                        //     const swiperWrapper = document.querySelector('.swiper-wrapper');
                        //     swiperWrapper.innerHTML = '';

                        //     genSliderItem();
                        //     function genSliderItem() {
                        //         // Generate the slider items
                        //         institu_images.forEach((image, imageIndex) => {
                        //             const slide = document.createElement('div');
                        //             slide.classList.add('swiper-slide');
                        //             slide.classList.add('d-flex');
                        //             slide.classList.add('justify-content-center');
                        //             slide.classList.add('align-items-center');

                        //             const imgElement = document.createElement('img');
                        //             imgElement.src = image;
                        //             imgElement.alt = `Image ${imageIndex + 1}`;
                        //             imgElement.style.height = '48px'; // Set the height directly
                        //             imgElement.id = `image${imageIndex + 1}`; // Assign an ID to the image element

                        //             slide.appendChild(imgElement);

                        //             swiperWrapper.appendChild(slide);
                        //         });
                        //     }
                        // }




                    }
                }



            });

            markersLayer.addLayer(marker);
        }
    });
}







// // // VER 1
// function addMarkerOnContextMenu(map, markersLayer) {
//     map.on('contextmenu taphold', function (e) {
//         // if (isModalActive && !modal.contains(e.target)) {
//         if (isModalActive) {
//             // e.preventDefault();
//         }


//         var LAT = e.latlng.lat.toFixed(7);
//         var LNG = e.latlng.lng.toFixed(7);
//         var coordinates = {
//             lat: LAT,
//             lng: LNG
//         };

//         getAddressFromCoordinates(coordinates)
//             .then(address => {
//                 // Define the addr components
//                 var componentKeys = [
//                     { key: 'road', label: 'Jl.' },
//                     { key: 'neighbourhood', label: 'Ling.' },
//                     { key: 'hamlet', label: 'Dusun' },
//                     { key: 'village', label: 'Desa' },
//                     { key: 'suburb', label: 'Suburb' },
//                     { key: 'city_district', label: 'Kec.' },
//                     { key: 'town', label: 'Kota' },
//                     { key: 'county', label: 'Kab.' },
//                     { key: 'state_district', label: 'Wilayah' },
//                     { key: 'city', label: 'Kota' },
//                     { key: 'state', label: 'Prov.' },
//                     { key: 'postcode', label: 'Kode Pos' },
//                     { key: 'country', label: 'Negara' }
//                 ];

//                 var province = address['state'];
//                 var postcode = address['postcode'];
//                 var addressComponents = [];

//                 componentKeys.forEach(component => {
//                     var key = component.key;
//                     var label = component.label;

//                     if (key === 'state') {
//                         if (province && postcode) {
//                             addressComponents.push(label + ' ' + province + ' (' + postcode + ')');
//                         } else if (province) {
//                             addressComponents.push(label + ' ' + province);
//                         }
//                     } else if (key !== 'postcode' && address[key]) {
//                         if (label && address[key].toLowerCase().includes(label.toLowerCase())) {
//                             addressComponents.push(address[key]);
//                         } else {
//                             addressComponents.push(label + ' ' + address[key]);
//                         }
//                     }
//                 });

//                 var fulladdr = addressComponents.join(', ');
//                 processIt(fulladdr);
//                 console.log(fulladdr);
//             })
//             .catch(error => {
//                 console.error('Error:', error.message);
//                 processIt("We're using OSRM's demo server, sometimes wont get address automatically :)");

//             });

//         function processIt(institu_addr) {
//             const institu_name = "Untitled Marker";
//             const institu_npsn = "fill data!";
//             const imgLogo = imgu; // Corrected variable name
//             const institu_images = imgu;
//             const last_update = "never";

//             const tooltipData = {
//                 tobesearch: institu_name
//             };
//             const marker = L.marker(new L.latLng([LAT, LNG]), tooltipData);

//             const fromRightClick_PopupContent = `
//                         <div class='d-flex flex-column p-0'>
//                             <span style='padding-bottom:2px;'><strong>Coordinates: </strong>${LAT}, ${LNG}<br></span>
//                             <span style='padding-bottom:2px;'><strong>Name: </strong>${institu_name}<br></span>
//                             <span style='padding-bottom:2px;'><strong>NPSN: </strong>${institu_npsn}<br></span>
//                             <span style='padding-bottom:2px;'><strong>Logo: </strong>
//                                 <img src='${imgLogo}' alt='${institu_name} Logo' width='30'><br>
//                             </span>
//                             <span style='padding-bottom:2px;'><strong>Address: </strong>${institu_addr}<br></span>
//                             <span class='d-flex flex-column align-top text-start' style='padding-bottom:2px;'><strong>Images:</strong>
//                                 <img src='${institu_images}' alt='${institu_name} Logo' width='80'><br>
//                             </span>
//                             <span style='padding-bottom:2px;'><strong>Last Update: </strong>${last_update}<br></span>
//                             <div class='d-flex flex-col justify-content-between'>
//                                 <button class="mark-cancel-remove-btn mdi mdi-delete p-2 rounded-2"> Cancel & Remove</button>
//                                 <button class="mark-edit-btn mdi mdi-content-save-all p-2 rounded-2" onclick="openModal()"> Edit & Save</button>
//                             </div>
//                         </div>
//                     `;

//             marker.bindTooltip(institu_name + "  ➟  " + institu_addr);
//             marker.bindPopup(fromRightClick_PopupContent);
//             marker.options.popupText = marker._popup._content;
//             markersLayer.addLayer(marker);


//             // Handle the "Edit" button click event within the marker's popup
//             marker.on('popupopen', function () {
//                 var editButton = document.querySelector('.mark-edit-btn');

//                 editButton.addEventListener('click', function () {
//                     marker.closePopup();
//                     $('#editMarkModal').modal('show');
//                     isModalActive = true;
//                     var modalSaveButton = document.querySelector('.modal-mark-save-btn');
//                     if (modalSaveButton) {
//                         modalSaveButton.addEventListener('click', function () {
//                             // $('#editMarkModal').modal('hide');
//                             // marker.setPopupContent(updatedPopupContent);
//                         });
//                     }
//                     var modalRemoveButton = document.querySelector('.modal-mark-remove-btn');
//                     if (modalRemoveButton) {
//                         modalRemoveButton.addEventListener('click', function () {
//                             markersLayer.removeLayer(marker);
//                             marker.closePopup();
//                             $('#editMarkModal').modal('hide');
//                             isModalActive = false;
//                         });
//                     }
//                     var modalCancelButton = document.querySelector('.modal-mark-cancel-btn');
//                     if (modalCancelButton) {
//                         modalCancelButton.addEventListener('click', function () {
//                             $('#editMarkModal').modal('hide');
//                             isModalActive = false;
//                         });
//                     }
//                 });
//                 var cancelandRemoveButton = document.querySelector('.mark-cancel-remove-btn');
//                 cancelandRemoveButton.addEventListener('click', function () {
//                     if (cancelandRemoveButton) {
//                         marker.closePopup();
//                         markersLayer.removeLayer(marker); // Remove the marker from the layer
//                     }
//                 });

//             });
//         }


//     });

//     // }


// }






// VER 0
// function addMarkerOnContextMenu(map, markersLayer) {
//     map.on('contextmenu taphold', function (e) {
//         var LAT = e.latlng.lat.toFixed(7);
//         var LNG = e.latlng.lng.toFixed(7);
//         var coordinates = {
//             lat: LAT,
//             lng: LNG
//         };

//         getAddressFromCoordinates(coordinates)
//             .then(address => {
//                 // Define the addr components
//                 var componentKeys = [
//                     { key: 'road', label: 'Jl.' },
//                     { key: 'neighbourhood', label: 'Ling.' },
//                     { key: 'hamlet', label: 'Dusun' },
//                     { key: 'village', label: 'Desa' },
//                     { key: 'suburb', label: 'Suburb' },
//                     { key: 'city_district', label: 'Kec.' },
//                     { key: 'town', label: 'Kota' },
//                     { key: 'county', label: 'Kab.' },
//                     { key: 'state_district', label: 'Wilayah' },
//                     { key: 'city', label: 'Kota' },
//                     { key: 'state', label: 'Prov.' },
//                     { key: 'postcode', label: 'Kode Pos' },
//                     { key: 'country', label: 'Negara' }
//                 ];

//                 var province = address['state'];
//                 var postcode = address['postcode'];
//                 var addressComponents = [];

//                 componentKeys.forEach(component => {
//                     var key = component.key;
//                     var label = component.label;

//                     if (key === 'state') {
//                         if (province && postcode) {
//                             addressComponents.push(label + ' ' + province + ' (' + postcode + ')');
//                         } else if (province) {
//                             addressComponents.push(label + ' ' + province);
//                         }
//                     } else if (key !== 'postcode' && address[key]) {
//                         if (label && address[key].toLowerCase().includes(label.toLowerCase())) {
//                             addressComponents.push(address[key]);
//                         } else {
//                             addressComponents.push(label + ' ' + address[key]);
//                         }
//                     }
//                 });

//                 var fulladdr = addressComponents.join(', ');
//                 processIt(fulladdr);
//                 console.log(fulladdr);
//             })
//             .catch(error => {
//                 console.error('Error:', error.message);
//             });

//         function processIt(institu_addr) {
//             const institu_name = "Untitled Marker";
//             const institu_npsn = "fill data!";
//             const imgLogo = imgu; // Corrected variable name
//             const institu_images = imgu;
//             const last_update = "never";

//             const tooltipData = {
//                 tobesearch: institu_name
//             };
//             const marker = L.marker(new L.latLng([LAT, LNG]), tooltipData);

//             const fromRightClick_PopupContent = `
//                 <div class='d-flex flex-column p-0'>
//                     <span style='padding-bottom:2px;'><strong>Coordinates: </strong>${LAT}, ${LNG}<br></span>
//                     <span style='padding-bottom:2px;'><strong>Name: </strong>${institu_name}<br></span>
//                     <span style='padding-bottom:2px;'><strong>NPSN: </strong>${institu_npsn}<br></span>
//                     <span style='padding-bottom:2px;'><strong>Logo: </strong>
//                         <img src='${imgLogo}' alt='${institu_name} Logo' width='30'><br>
//                     </span>
//                     <span style='padding-bottom:2px;'><strong>Address:</strong>${institu_addr}<br></span>
//                     <span class='d-flex flex-column align-top text-start' style='padding-bottom:2px;'><strong>Images:</strong>
//                         <img src='${institu_images}' alt='${institu_name} Logo' width='80'><br>
//                     </span>
//                     <span style='padding-bottom:2px;'><strong>Last Update: </strong>${last_update}<br></span>
//                     <div class='d-flex flex-col justify-content-between'>
//                         <button class="mark-cancel-btn mdi mdi-cancel p-2 rounded-2"> Cancel</button>
//                         <button class="mark-remove-btn mdi mdi-delete p-2 rounded-2"> Remove</button>
//                         <button class="mark-edit-btn mdi mdi-content-save-all p-2 rounded-2"> Edit & Save</button>
//                     </div>
//                 </div>
//             `;

//             marker.bindTooltip(institu_name + "  ➟  " + institu_addr);
//             marker.bindPopup(fromRightClick_PopupContent);
//             marker.options.popupText = marker._popup._content;
//             markersLayer.addLayer(marker);


//             marker.on('click', function () {
//                 var editButton = document.querySelector('.mark-edit-btn');
//                 editButton.addEventListener('click', function () {
//                     $('#editMarkModal').modal('show');
//                     var saveButton = document.querySelector('.modal-save-btn');
//                     if (saveButton) {
//                         saveButton.addEventListener('click', function () {
//                             $('#editMarkModal').modal('hide');
//                             marker.setPopupContent(updatedPopupContent);
//                         });
//                     }
//                     var cancelButton = document.querySelector('.mark-cancel-btn');
//                     if (cancelButton) {
//                         cancelButton.addEventListener('click', function () {
//                             $('#editMarkModal').modal('hide');
//                             marker.closePopup();
//                         });
//                     }
//                 });
//                 var cancelButton = document.querySelector('.mark-cancel-btn');
//                 cancelButton.addEventListener('click', function () {
//                     if (cancelButton) {
//                         marker.closePopup();
//                     }
//                 });
//                 var deleteButton = document.querySelector('.mark-remove-btn');
//                 deleteButton.addEventListener('click', function () {
//                     if (deleteButton) {
//                         markersLayer.removeLayer(marker); // Remove the marker from the layer
//                         marker.closePopup();
//                     }
//                 });
//             });








//         }
//     });

// }




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





function addGeocodeTracksControl(map, markersLayer) {
    const showButton = L.Control.extend({
        options: {
            position: 'topright'
        },

        onAdd: function (map) {
            const container = L.DomUtil.create('div', 'leaflet-routing-show-button leaflet-bar leaflet-control');
            const button = L.DomUtil.create('a', 'leaflet-routing-show-button-icon', container);
            button.innerHTML = '<i class="mdi mdi-routes"></i>';
            button.href = '#';
            button.addEventListener('click', function () {
                const routingContainer = document.querySelector('.leaflet-routing-container');
                const hideButton = document.querySelector('.leaflet-routing-hide-button');
                if (routingContainer.style.display === 'block') {
                    routingContainer.style.display = 'none';
                    hideButton.style.display = 'none';
                    container.style.display = 'block';
                } else {
                    routingContainer.style.display = 'block';
                    hideButton.style.display = 'block';
                    container.style.display = 'none';
                }
            });
            return container;
        }
    });
    map.addControl(new showButton());

    const startingPointMarker = L.marker(new L.latLng([-6.2029824, 106.5811968]), { title: "Tracks me" }).addTo(map);
    const control = L.Routing.control({
        waypoints: [
            // L.latLng(mycurrentLat, mycurrentLng),
            L.latLng(-6.2029824, 106.5811968),
            L.latLng(-6.2029828, 106.5811978)
        ],
        routeWhileDragging: true,
        geocoder: L.Control.Geocoder.nominatim()
    }).addTo(map);

    const routingContainer = document.querySelector('.leaflet-routing-container');
    routingContainer.style.display = 'none'; // Hide the routing container initially

    const hideButton = document.createElement('button');
    hideButton.innerHTML = `
        <i class="mdi mdi-routes dark-mode" style="position: relative; z-index: 1; color: var(--bs-dark);"></i>
    `;
    hideButton.classList.add('leaflet-routing-hide-button', 'leaflet-bar', 'leaflet-control');
    hideButton.style.marginTop = '0';
    hideButton.style.marginRight = '2.7px';
    hideButton.addEventListener('click', function () {
        routingContainer.style.display = 'none';
        hideButton.style.display = 'none';
        const showButton = document.querySelector('.leaflet-routing-show-button');
        showButton.style.display = 'block';
    });
    const geocoderContainer = document.querySelector('.leaflet-routing-geocoder');
    geocoderContainer.parentNode.insertBefore(hideButton, geocoderContainer);
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Declare variables to store the selected coordinates
    let selectedStartCoordinates = null;
    let selectedEndCoordinates = null;

    const startPointButton = document.createElement('button');
    startPointButton.innerHTML = `
        <i class="mdi mdi-map-marker-account dark-mode" style="position: relative; z-index: 1; color: var(--bs-dark);"></i>
    `;
    startPointButton.classList.add('leaflet-routing-start-button', 'leaflet-bar', 'leaflet-control');
    startPointButton.style.marginTop = '-3px';
    startPointButton.style.marginBottom = '6px';
    startPointButton.style.marginRight = '2.7px';
    // Attach the click event handlers for the start and end buttons
    startPointButton.addEventListener('click', function () {
        map.once('click', handleStartPointClick);
    });

    const endPointButton = document.createElement('button');
    endPointButton.innerHTML = `
    <i class="mdi mdi-map-marker-question dark-mode" style="position: relative; z-index: 1; color: var(--bs-dark);"></i>
    `;
    endPointButton.classList.add('leaflet-routing-end-button', 'leaflet-bar', 'leaflet-control');
    endPointButton.style.marginTop = '0';
    endPointButton.style.marginRight = '2.7px';
    endPointButton.addEventListener('click', function () {
        map.once('click', handleEndPointClick);
    });


    const buttonContainer = document.createElement('div');
    buttonContainer.classList.add('leaflet-routing-button-container');
    buttonContainer.appendChild(startPointButton);
    buttonContainer.appendChild(endPointButton);

    const geocodersContainer = document.querySelector('.leaflet-routing-geocoders');
    geocodersContainer.parentNode.insertBefore(buttonContainer, geocodersContainer);

    // ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // // const alternativesContainer = document.querySelector('.leaflet-routing-alternatives-container');
    // // routingContainer.insertBefore(hideButton, alternativesContainer);

    // // Apply custom scrollbar styles
    // // routingContainer.style.overflow = 'auto';
    // routingContainer.style.maxHeight = '100%'; // Adjust the maximum height as needed

    // // if (removeWaypointButtons[2]) {
    // //     removeWaypointButtons[2].dispatchEvent(clickEvent);
    // // }
    // // if (removeWaypointButtons[3]) {
    // //     removeWaypointButtons[3].dispatchEvent(clickEvent);
    // // }

    // /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // // Define the event handler for the map click event to handle the start point selection
    function handleStartPointClick(e) {
        selectedStartCoordinates = e.latlng;
        getAddressFromCoordinates(selectedStartCoordinates)
            .then(address => {
                console.log("Selecting StartPoint");
                console.log(address);
                const startInput = document.querySelector('.leaflet-routing-geocoder input[placeholder="Start"]');
                startInput.value = address;
            })
            .catch(error => {
                console.error('Error:', error.message);
            });
    }

    // // Define the event handler for the map click event to handle the end point selection
    function handleEndPointClick(e) {
        selectedEndCoordinates = e.latlng;
        getAddressFromCoordinates(selectedEndCoordinates)
            .then(address => {
                console.log("Selecting EndPoint");
                console.log(address);
                // // Add the end point marker on the map
                // const endPointMarker = L.marker(selectedEndCoordinates).addTo(markersLayer);
                // endPointMarker.bindPopup(address).openPopup();
                // // Update the routing control with the new end point
                // control.spliceWaypoints(control.getWaypoints().length - 1, 1, selectedEndCoordinates);
                const endInput = document.querySelector('.leaflet-routing-geocoder input[placeholder="End"]');
                endInput.value = address;
            })
            .catch(error => {
                console.error('Error:', error.message);
            });
    }


    // Get all elements with the class "leaflet-routing-remove-waypoint". Clicking the [x] button each route input.
    const removeWaypointButtons = Array.from(document.querySelectorAll('.leaflet-routing-remove-waypoint'));
    const clickEvent = new Event('click');
    if (removeWaypointButtons[0]) {
        removeWaypointButtons[0].dispatchEvent(clickEvent);
    }
    if (removeWaypointButtons[1]) {
        removeWaypointButtons[1].dispatchEvent(clickEvent);
    }
}


// function addGeocodeTracksControl(map, markersLayer) {
//     tooltipData = `Tracks me`;
//     const startingPointMarker = L.marker(new L.latLng([-6.2029824, 106.5811968]), tooltipData);
//     L.Routing.control({
//         waypoints: [
//             // L.latLng(mycurrentLat, mycurrentLng),
//             L.latLng(-6.2029824, 106.5811968),
//             L.latLng(-6.2029828, 106.5811978)
//         ],
//         routeWhileDragging: true,
//     }).addTo(map);
// }

function testdialog(map) {

}

// The main function to initialize the map and its components
function initializeMapApp() {
    var map = initializeMap();
    var markersLayer = L.layerGroup();
    addTileLayer(map);

    populateMapWithMarkers(map, markersLayer);
    // addAddressSearchControl(map);
    // addGeocodeTracksControl(map, markersLayer);
    addResetViewControl(map);
    addLocateMeControl(map);
    addMarkerOnContextMenu(map, markersLayer);
    // printAddrToConsole(map);
    // testdialog(map);
}




// Call the main function to initialize the map

initializeMapApp();
const mapfirstload = document.getElementById('#map');
const clickEvent = new Event('click');
if (mapfirstload) {
    // mapfirstload.dispatchEvent(clickEvent);
    clickEvent.stopPropagation();

    mapfirstload.addEventListener('change', function (event) {
        event.stopPropagation(); // Stop the event from bubbling up
    });
}




