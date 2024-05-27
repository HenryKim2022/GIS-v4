<!-- Modal: EditProfile / edit profile modal -->
<div class="modal fade" id="editUserModalTB" data-bs-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user modal-dialog-scrollable modal-dialog-centered">
        {{-- <div class="modal-content p-3 p-md-5"> --}}
        <div class="modal-content p-3 p-md-1 pt-md-5">
            <div class="modal-body py-3 py-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Edit User Informations</h3>
                    {{-- <p class="pt-1">Updating user details will receive a privacy audit.</p> --}}
                </div>
                {{-- <form id="addUserForm" class="row g-4 needs-validation" onsubmit="return false" novalidate> --}}
                <form id="editUserForm" class="row g-2 needs-validation" method="POST" action="/m-userlist/edit-u" novalidate>
                    @csrf
                    <div class="col-12 col-md-2">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditUserID2" name="modalEditUserID2" class="form-control"
                                placeholder="user-id" readonly required />
                            <label for="modalEditUserID2">User-ID</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditUserFirstname2" name="modalEditUserFirstname2" class="form-control"
                                placeholder="e.g John" required />
                            <label for="modalEditUserFirstname2">First Name</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditUserLastname2" name="modalEditUserLastname2" class="form-control"
                                placeholder="e.g Doe" required />
                            <label for="modalEditUserLastname2">Last Name</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditUsername2" name="modalEditUsername2" class="form-control"
                                placeholder="e.g johndoe2024" required />
                            <label for="modalEditUsername2">UserName</label>
                        </div>
                    </div>
                    {{-- <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditUserPassword2" name="modalEditUserPassword2" class="form-control"
                                placeholder="e.g 123456" required />
                            <label for="modalEditUserPassword2">Password</label>
                        </div>
                    </div> --}}

                    <div class="col-12 col-md-4 form-password-toggle">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="password" id="modalEditUserPassword2"
                                    name="modalEditUserPassword2"
                                    placeholder="e.g 123456" required />
                                <label for="modalEditUserPassword2">Password</label>
                            </div>
                            <span class="input-group-text cursor-pointer"><i
                                    class="mdi mdi-eye-off-outline"></i></span>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 form-password-toggle">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="password"
                                    name="modalEditUserPasswordConfirm2" id="modalEditUserPasswordConfirm2"
                                    placeholder="e.g 123456" required />
                                <label for="modalEditUserPasswordConfirm2">Confirm Password</label>
                            </div>
                            <span class="input-group-text cursor-pointer"><i
                                    class="mdi mdi-eye-off-outline"></i></span>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="bsvalidationcheckbox2" name="bsvalidationcheckbox2" checked="false" required />
                            <label class="form-check-label" for="bsvalidationcheckbox2">Proceed to save</label>
                            <div class="feedback text-muted">You must agree before saving.</div>
                        </div>
                    </div>
                    <div class="modal-footer p-0 pl-4 pt-4 pb-4">
                        <div class="col-12 text-center">
                            <div class="d-flex flex-col justify-content-end">
                                <button class="modal-btn modal-user-cancel-btn btn btn-primary me-2"
                                    data-bs-dismiss="modal" type="button">Cancel</button>
                                <button class="modal-btn modal-user-save-btn btn btn-success"
                                    type="submit">Save</button>
                            </div>
                        </div>
                    </div>


                </form>
            </div>


        </div>
    </div>
</div>
