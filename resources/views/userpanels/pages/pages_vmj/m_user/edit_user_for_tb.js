document.addEventListener('DOMContentLoaded', function () {
    const modalSelector = document.getElementById('editUserModalTB');
    const modalToShow = new bootstrap.Modal(modalSelector);
    const targetedModalForm = document.querySelector('#editUserModalTB #editUserForm');


    if (modalSelector) {
        setTimeout(() => {
            var lenEditRecordButtons = dt_basic.rows().count() + 1;
            if (lenEditRecordButtons > 0) {
                for (var i = 1; i < lenEditRecordButtons; i++) {
                    const editRecordBtn = document.querySelector('.edit-record-' + i);

                    // To open Modal, to add edit record
                    if (editRecordBtn) {
                        editRecordBtn.addEventListener('click', function () {
                            var userID = this.getAttribute('user_id_value');
                            console.log("Clicked userID:", userID);

                            // Make an AJAX request to fetch latitude and longitude based on userID
                            $.ajax({
                                url: '/m-userlist/get-u',
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    userID: userID
                                },
                                success: function (response) {
                                    console.log("Response:");
                                    console.log(response);
                                    // Update the input values in the modal with the fetched latitude and longitude
                                    $('#modalEditUserID2').val(response.user_id);
                                    $('#modalEditUserFirstname2').val(response.firstname);
                                    $('#modalEditUserLastname2').val(response.lastname);
                                    $('#modalEditUsername2').val(response.user_name);
                                    $('#modalEditUserPassword2').val(response.user_password);

                                    // Show the modal
                                    console.log('SHOWING MODAL');
                                    modalToShow.show();
                                },
                                error: function (error) {
                                    console.log("Err:\n");
                                    console.log(error);
                                }
                            });


                            // modalToShow.show();
                        });
                    }


                    const editCancelBtn = document.querySelector('#editUserModalTB #editUserForm .modal-user-cancel-btn');
                    // To open Modal, to add edit record
                    if (editCancelBtn) {
                        editCancelBtn.addEventListener('click', function () {
                            modalToShow.hide();
                        });
                    }
                }
            }
        }, 200);

        // Form validation for Add new record
        const fv2 = FormValidation.formValidation(targetedModalForm, {
            fields: {
                modalEditCategoryName2: {
                    validators: {
                        notEmpty: {
                            message: 'The latitude field is required'
                        }
                    }
                },
                bsvalidationcheckbox2: {
                    validators: {
                        choice: {
                            min: 1,
                            message: 'Please confirm to process!',
                            required: true // Add required option
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: '',
                    rowSelector: function (field, ele) {
                        switch (field) {
                            case 'modalEditCategoryName2':
                                return '.form-control';
                            case 'bsvalidationcheckbox2':
                                return '.form-check-input';
                            default:
                                return '.row';
                        }
                    }
                }),
                autoFocus: new FormValidation.plugins.AutoFocus()
            },
            // Prevent form submission if validation fails
            submitHandler: function (form) {
                form.preventDefault();
                // Handle the form submission manually here if needed
            }
        });

        const saveRecordBtn = document.querySelector('#editUserModalTB .modal-cat-save-btn');
        if (saveRecordBtn) {
            saveRecordBtn.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent the default button behavior

                fv2.validate().then(function (status) {
                    if (status === 'Valid') {
                        targetedModalForm.submit(); // Submit the form if validation passes
                    }
                });
            });
        }
    }

});
