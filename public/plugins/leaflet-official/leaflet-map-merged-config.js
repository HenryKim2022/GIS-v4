var imgu = "public/img/noimage.png";
let isModalActive = false;
var fullscreenControl, fullscreenElement;

function openModal() {
    isModalActive = true;
}
function closeModal() {
    isModalActive = false;
}

function setDataModal(map, markersLayer) {
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
                        if (institution_images.length === 0) {
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

            // Open the modal
            openModal();
            modalToShow.show();
            const closeModalBtn = $(modalSelector).find('#close_modalviewMarkVisitorModal')[0];
            closeModalBtn.addEventListener('click', function () {
                closeModal();
                modalToShow.hide();
            });

        });
    });

    // });
}


function initLeafletMap() {
    var map = new L.Map('map', {
        fullscreenControl: true,
        fullscreenControlOptions: {
            position: 'topleft',
            forcePseudoFullscreen: false
        },
        gestureHandling: true,
    }).setView([-3.4763993, 115.2211498], 4.50);

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

    return map;
}

function populateMarks4romDB(map, markersLayer) {
    /// Data loader
    document.addEventListener('DOMContentLoaded', function () {
        fetch('/landing-page/loadmark')
        .then(response => response.json())
        .then(data => {
            data.features
                .filter(f => f.properties.institu_name)
                .forEach(f => {
                    const coordinates = f.geometry.coordinates.map(parseFloat).reverse();
                    const createdTimestamp = new Date(f.properties.created_at);
                    const updatedTimestamp = new Date(f.properties.created_at);
                    const tooltipData = {
                        institution_lat: coordinates[0] || "none",  /// How to get the latlon??
                        institution_lon: coordinates[1] || "none",
                        institution_name: f.properties.institu_name || "none",
                        institution_cat: f.properties.institu_category || "none",
                        institution_npsn: f.properties.institu_npsn || "none",
                        institution_logo: f.properties.institu_logo || "none",
                        institution_address: f.properties.institu_address || "none",
                        institution_images: f.properties.institu_images || [],
                        institution_mark_id: f.properties.institu_mark_id || "none",
                        institution_created: createdTimestamp.toLocaleString('id-ID', { timeZone: 'Asia/Jakarta', hour12: true }) || "none",
                        institution_updated: updatedTimestamp.toLocaleString('id-ID', { timeZone: 'Asia/Jakarta', hour12: true }) || "none",
                    };
                    const populateMarker = L.marker(coordinates, tooltipData);

                    applyMarksToolTips(tooltipData.institution_address);
                    function applyMarksToolTips(final_addr) {
                        populateMarker.bindTooltip(tooltipData.institution_name + "  ➟  " + final_addr);
                        markersLayer.addLayer(populateMarker);

                        // document.addEventListener('DOMContentLoaded', function () {
                        setDataModal(map, markersLayer);
                        // });

                    }
                });

            markersLayer.addTo(map); // Add the layer group to the map outside the forEach loop
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

}



// ############################################################# MAIN CALLER ############################################################# //

var map = initLeafletMap();
var markersLayer = L.layerGroup();
populateMarks4romDB(map, markersLayer);


