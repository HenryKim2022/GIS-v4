"use strict";

///////////////////////////////////////////////////////////
/////    <!-- CUST SCRIPT: DISABLE RIGHT CLICKS JS -->
///////////////////////////////////////////////////////////

var elements = document.getElementsByClassName("disable-right-click");
// Iterate over the elements and add a right-click event listener
for (var i = 0; i < elements.length; i++) {
    elements[i].addEventListener("contextmenu", function (event) {
        event.preventDefault(); // Prevent the default right-click behavior
    });
}



////////////////////////////////////////////////
/////    <!-- MAXIMIZE + FULLSCREEN JS -->
////////////////////////////////////////////////

// function setFullscreenHeight() {
//     const windowHeight = window.innerHeight; // Get the height of the viewport
//     const leaflet_map = document.getElementsByClassName("leaflet-map")[0];
//     const body = document.getElementsByTagName("body")[0];

//     if (document.fullscreenElement) {
//         const decreasedHeight = Math.floor(windowHeight - 45); // Decrease the height by 10%
//         if (leaflet_map) {
//             leaflet_map.style.height = decreasedHeight + "px";

//             leaflet_map.classList.add("leaflet-map-container-static"); // Add the static class
//         }
//         body.classList.add("no-scroll"); // Add the no-scroll class
//     } else {
//         if (leaflet_map) {
//             leaflet_map.style.height = ""; // Remove the height

//             leaflet_map.classList.remove("leaflet-map-container-static"); // Remove the static class
//         }
//         body.classList.remove("no-scroll"); // Remove the no-scroll class
//     }
// }

// // Call the function when the window is resized or orientation changes
// window.addEventListener("resize", setFullscreenHeight);
// window.addEventListener("orientationchange", setFullscreenHeight);

// function fullscreenFunct() {
//     var leaflet_card = document.getElementById("leaflet_card");

//     if (leaflet_card.classList.contains("full_screen")) {
//         // The element already has the "full_screen" class
//         leaflet_card.classList.remove("full_screen"); // remove F11 trigger
//         document.exitFullscreen();
//         document.getElementById("mapsfullscreen-btn").innerHTML =
//             '<i class="mdi mdi-24px mdi-fullscreen"></i>';
//     } else {
//         // The element does not have the "full_screen" class
//         leaflet_card.classList.add("full_screen"); // add F11 trigger
//         document.documentElement.requestFullscreen();
//         document.getElementById("mapsfullscreen-btn").innerHTML =
//             '<i class="mdi mdi-24px mdi-fullscreen-exit"></i>';
//     }
// }



/////////////////////////////////////////////////////////////////////////////////////
/////    <!-- CUST SCRIPT: ADD DARKEN BACKGROUND WHILE ABOUT-US MODAL SHOW JS -->
/////////////////////////////////////////////////////////////////////////////////////
var aboutUsModal = document.getElementById("aboutUsModal");
if (aboutUsModal) {
    aboutUsModal.addEventListener("shown.bs.modal", function () {
        var modalBackdrop = document.querySelector(".modal-backdrop");
        modalBackdrop.classList.add("custom-backdrop");
    });
}

// var editMarkModal = document.getElementById("editMarkModal");
// if (editMarkModal) {
//     editMarkModal.addEventListener("shown.bs.modal", function () {
//         var modalBackdrop = document.querySelector(".modal-backdrop");
//         modalBackdrop.classList.add("custom-backdrop");
//     });
// }



//////////////////////////////////////////////////////////////////////////////////////////
/////    <!-- CUST SCRIPT: ADD DARKEN BACKGROUND WHILE PRIVACY-POLICY MODAL SHOW JS -->
//////////////////////////////////////////////////////////////////////////////////////////
var registerPrivacyPolicyModal = document.getElementById("modalPrivacyPolicy");
if (registerPrivacyPolicyModal) {
    registerPrivacyPolicyModal.addEventListener("shown.bs.modal", function () {
        var modalBackdrop = document.querySelector(".modal-backdrop");
        modalBackdrop.classList.add("custom-backdrop");
    });
}

// ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// /////    <!-- CUST SCRIPT: SWEAT ALERT JS -->
// ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ///////// ALERT BY BUTTON: CENTER OF PARENT
function showAlert(
    typeAlert = "infoAlert",
    alertTitle = "Alert Title",
    alertIcon = "info",
    alertMsg = "Here is alert msg..."
) {
    const btnAlert = document.querySelector("#" + typeAlert); // Based on ID
    // General SweatAlert
    if (btnAlert) {
        Swal.fire({
            title: alertTitle,
            icon: alertIcon,
            text: alertMsg,
            showClass: {
                popup: "animate__animated animate__flipInX",
            },
            customClass: {
                confirmButton: "btn btn-primary me-3 waves-effect waves-light",
            },
            confirmButtonText:
                '<i class="mdi mdi-thumb-up-outline me-2"></i> Okay!',
            confirmButtonAriaLabel: "Thumbs up, okay!",
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: function () { },
            didClose: function () { },
            zIndex: 1150
        });
    }
}

// ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// /////    <!-- CUST SCRIPT: TOAST JS -->
// ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ///////// TOAST BY BUTTON: TOP RIGHT OF PARENT
function showToast() {
    var isData = true; // Based on Data Exists
    if (isData) {
        Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        }).fire({
            icon: "warning",
            title: "TOAST TESTING!",
        });
    }
}
// ///////// TOAST BY SESSION: TOP RIGHT OF PARENT



// /////////////////////////////////////////////////////////////////////////////
// /////    <!-- CUST SCRIPT: REGISTER PRIVACY POLICY JS -->
// /////////////////////////////////////////////////////////////////////////////
const signupBtn = document.getElementById("signupBtn");
const confirmPolicyBtn = document.getElementById("confirmPolicyBtn");
const termsCheckbox = document.getElementById("terms-conditions");

if (signupBtn) {
    if (confirmPolicyBtn) {
        if (termsCheckbox) {
            termsCheckbox.addEventListener("change", function () {
                if (termsCheckbox.checked) {
                    signupBtn.disabled = false;
                } else {
                    signupBtn.disabled = true;
                }
            });
            confirmPolicyBtn.addEventListener("click", function () {
                termsCheckbox.checked = true;
                signupBtn.disabled = false;
            });

        }
    }
}



// /////////////////////////////////////////////////////////////////////////////
// /////    <!-- CUST SCRIPT: DROPZONE JS -->
// /////////////////////////////////////////////////////////////////////////////
// previewTemplate: Updated Dropzone default previewTemplate
// ! Don't change it unless you really know what you are doing



