<!-- Modal: EditProfile / edit profile modal -->
<div class="modal fade" id="addUserModalTB" data-bs-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg modal-simple modal-add-user modal-dialog-scrollable modal-dialog-centered">
        {{-- <div class="modal-content p-3 p-md-5"> --}}
        <div class="modal-content p-3 p-md-1 pt-md-5">
            <div class="modal-body py-3 py-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Add New User</h3>
                    {{-- <p class="pt-1">Updating user details will receive a privacy audit.</p> --}}
                </div>
                {{-- <form id="addUserForm" class="row g-4 needs-validation" onsubmit="return false" novalidate> --}}
                <form id="addUserForm" class="row g-2 needs-validation" method="POST" action="/m-userlist/add-u" novalidate>
                    @csrf
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditUserFirstname1" name="modalEditUserFirstname1" class="form-control"
                                placeholder="e.g John" required />
                            <label for="modalEditUserFirstname1">First Name</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditUserLastname1" name="modalEditUserLastname1" class="form-control"
                                placeholder="e.g Doe" required />
                            <label for="modalEditUserLastname1">Last Name</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditUsername1" name="modalEditUsername1" class="form-control"
                                placeholder="e.g johndoe2024" required />
                            <label for="modalEditUsername1">UserName</label>
                        </div>
                    </div>
                    {{-- <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditUserPassword1" name="modalEditUserPassword1" class="form-control"
                                placeholder="e.g 123456" required />
                            <label for="modalEditUserPassword1">Password</label>
                        </div>
                    </div> --}}

                    <div class="col-12 col-md-4 form-password-toggle">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="password" id="modalEditUserPassword1"
                                    name="modalEditUserPassword1"
                                    placeholder="e.g 123456" required />
                                <label for="modalEditUserPassword1">Password</label>
                            </div>
                            <span class="input-group-text cursor-pointer"><i
                                    class="mdi mdi-eye-off-outline"></i></span>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 form-password-toggle">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="password"
                                    name="modalEditUserPasswordConfirm1" id="modalEditUserPasswordConfirm1"
                                    placeholder="e.g 123456" required />
                                <label for="modalEditUserPasswordConfirm1">Confirm Password</label>
                            </div>
                            <span class="input-group-text cursor-pointer"><i
                                    class="mdi mdi-eye-off-outline"></i></span>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="bsvalidationcheckbox1" name="bsvalidationcheckbox1" checked="false" required />
                            <label class="form-check-label" for="bsvalidationcheckbox1">Proceed to save</label>
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
