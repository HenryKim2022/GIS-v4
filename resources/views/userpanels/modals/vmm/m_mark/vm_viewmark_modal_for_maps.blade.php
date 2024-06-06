<style>
    .form-floating.form-control {
        height: fit-content !important;
    }

    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-family: 'Material Design Icons';
        font-size: 16px;
        font-weight: normal;
        content: '\e5cc';
    }

    .swiper-button-prev::after {
        content: '\e5cb';
    }

    /* CSS */
    @-moz-document url-prefix() {
        .modal-body {
            overflow-x: hidden !important;
        }
    }
</style>

<!-- Modal: EditProfile / edit profile modal -->
<div class="modal fade" style="overflow-x: hidden" id="viewMarkUserModal" data-bs-backdrop="false" tabindex="-1"
    style="z-index: 1104 !important;">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content p-3 p-md-1 pt-md-5">
            <div class="modal-body py-3 py-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">View Mark Information</h3>
                </div>
                <form id="viewMarkForm" class="row g-2">
                    <div class="col-6 col-md-2">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalViewMarkID" name="modalViewMarkID" class="form-control"
                                placeholder="latitude" readonly />
                            <label for="modalViewMarkID">Mark-ID</label>
                        </div>
                    </div>
                    <div class="col-6 col-md-5">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalViewLatitude" name="modalViewLatitude" class="form-control"
                                placeholder="latitude" readonly />
                            <label for="modalViewLatitude">Latitude</label>
                        </div>
                    </div>
                    <div class="col-6 col-md-5">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalViewLongitude" name="modalViewLongitude" class="form-control"
                                placeholder="longitude" readonly />
                            <label for="modalViewLongitude">Logitude</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalViewAddress" name="modalViewAddress"
                                class="form-control modal-edit-tax-id" placeholder="mark address" readonly />
                            <label for="modalViewAddress">Address</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalViewLastUpdate" name="modalViewLastUpdate"
                                class="form-control" placeholder="last update" readonly />
                            <label for="modalViewLastUpdate">Last update</label>
                        </div>
                    </div>

                    <div class="modal-footer p-0 pt-4 pb-4">
                        <div class="col-12 text-center">
                            <div class="d-flex flex-col justify-content-between">
                                <button class="modal-btn modal-view-mark-delete-btn btn btn-danger ms-2"
                                id="delete_modalviewMarkUserModal">Delete</button>
                                <div class="d-flex flex-col justify-content-end">
                                    <button class="modal-btn modal-view-mark-cancel-btn btn btn-primary me-2"
                                        {{-- data-bs-dismiss="modal"  --}} id="close_modalviewMarkUserModal">Close</button>
                                    <button class="modal-btn modal-edit-mark-btn btn btn-success" type="submit"
                                    id="edit_modalviewMarkUserModal"
                                    >Edit</button>
                                </div>
                            </div>


                        </div>
                    </div>


                </form>
            </div>



        </div>
    </div>
</div>




<script>
    const viewMarkUserModal = document.getElementById('viewMarkUserModal');
    viewMarkUserModal.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent autoscroll & prevent leaflet auto-exit fullscreen
        event.stopPropagation();
    });


    // Get the modal inputs
    var modalInputs = document.querySelectorAll('.form-floating');
    modalInputs.forEach(function(input) {
        input.addEventListener('click', function(event) {
            event.stopPropagation(); // Stop the event from bubbling up
        });

        input.addEventListener('change', function(event) {
            event.stopPropagation(); // Stop the event from bubbling up
        });
    });

    // Get the modal buttons
    var modalButtons = document.querySelectorAll('.modal-btn');
    modalButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.stopPropagation(); // Stop the event from bubbling up
            event.preventDefault();
        });

        button.addEventListener('change', function(event) {
            event.stopPropagation(); // Stop the event from bubbling up
        });
    });
</script>
