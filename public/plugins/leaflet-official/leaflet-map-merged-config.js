var imgu = "public/img/noimage.png";
let isModalActive = false;
var fullscreenControl, fullscreenElement;

function openModal() {
    isModalActive = true;
}
function closeModal() {
    isModalActive = false;
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

    // // LISTENERS
    // fullscreenControl = map.fullscreenControl;
    // fullscreenElement = fullscreenControl.getContainer();
    // // Override scroll behavior for the fullscreen element when modal is active
    // fullscreenElement.addEventListener('scroll', function (event) {
    //     if (isModalActive) {
    //         event.stopPropagation();
    //     }
    // });
    // // Override scroll behavior for the map container when modal is active
    // map.addEventListener('wheel', function (event) {
    //     if (isModalActive) {
    //         event.stopPropagation();
    //     }
    // }, { passive: false });


    return map;
}

function populateMarks4romDB(map, markersLayer) {
    /// Data loader
    fetch('/landing-page/loadmark')
        .then(response => response.json())
        .then(data => {
            data.features
                .filter(f => f.properties.institu_name)
                .forEach(f => {
                    const coordinates = f.geometry.coordinates.map(parseFloat).reverse();
                    const tooltipData = {
                        tobesearch1: f.properties.institu_name,
                        tobesearch2: f.properties.institu_address,
                    };
                    const populateMarker = L.marker(coordinates, tooltipData);

                    const institu_name = f.properties.institu_name || "none";
                    const institu_npsn = f.properties.institu_npsn || "none";
                    const imgLogo = f.properties.institu_logo || "none";
                    const institu_addr = f.properties.institu_address || "none";
                    const institu_images = f.properties.institu_images || [];
                    const last_update = f.properties.updated_at || "never";

                    applyMarksToolTips(institu_addr);
                    function applyMarksToolTips(final_addr) {
                        populateMarker.bindTooltip(institu_name + "  ➟  " + final_addr);
                        markersLayer.addLayer(populateMarker);

                        setDataModal();
                    }
                });

            markersLayer.addTo(map); // Add the layer group to the map outside the forEach loop
        })
        .catch(error => {
            console.error('Error:', error);
        });
}


function setDataModal(){

}


function mainMenu() {
    var map = initLeafletMap();
    var markersLayer = L.layerGroup();

    populateMarks4romDB(map, markersLayer);
}
// ############################################################# MAIN CALLER ############################################################# //
mainMenu();
