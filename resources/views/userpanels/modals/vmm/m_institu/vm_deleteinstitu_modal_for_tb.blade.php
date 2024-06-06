<!-- Modal: EditProfile / edit profile modal -->
<div class="modal fade" id="deleteInstitutionModalTB" data-bs-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg modal-simple modal-edit-mark modal-dialog-scrollable modal-dialog-centered">
        {{-- <div class="modal-content p-3 p-md-5"> --}}
        <div class="modal-content p-3 p-md-1 pt-md-5">
            <div class="modal-body py-3 py-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Confirm Institution Deletion</h3>
                </div>
                <form class="row g-2 needs-validation" method="POST"
                    action="{{ route('m-inst-data.delete') }}"
                    novalidate>
                    @csrf
                    <h6 class="text-center">
                        Are you sure want to <a class="text-warning">delete this records?</a> This action <a class="text-danger">cannot be undone</a>. <br>
                        Please confirm by clicking "<a class="text-danger">DELETE</a>" below.
                    </h6>

                    <input type="hidden" id="institu_id" name="institu_id" />
                    <div class="modal-footer p-0 pl-4 pt-4 pb-4">
                        <div class="col-12 text-center">
                            <div class="d-flex flex-col justify-content-end">
                                <button class="modal-btn modal-mark-map-cancel-btn btn btn-primary me-2"
                                    id="cancel_modaldeleteInstitutionModalTB" data-bs-dismiss="modal"
                                    type="button">Cancel</button>
                                <button class="modal-btn modal-mark-map-save-btn btn btn-danger" {{-- type="submit" --}}
                                    id="confirmDelete">Delete</button>
                            </div>
                        </div>
                    </div>


                </form>
            </div>


        </div>
    </div>
</div>
