document.addEventListener('DOMContentLoaded', function () {
    const modalSelector = document.getElementById('addUserModalTB');
    const modalToShow = new bootstrap.Modal(modalSelector);
    const targetedModalForm = document.querySelector('#addUserModalTB #addUserForm');


    if (modalSelector) {
        setTimeout(() => {
            const saveRecordBtn = document.querySelector('#addUserModalTB #addUserForm .modal-user-save-btn');
            if (saveRecordBtn) {
                saveRecordBtn.addEventListener('click', function () {
                    var userID = $('#modalEdituserID').val();
                    var userFirstName = $('#modalEditUserFirstname1').val(response.firstname);
                    var userLastName = $('#modalEditUserLastname1').val(response.lastname);
                    var userName = $('#modalEditUsername1').val(response.username);
                    var userPwd = $('#modalEditUserPassword1').val(response.user_password);

                    // Make an AJAX request to save the data
                    $.ajax({
                        url: '/m-userlist/add-u',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: {
                            userID: userID,
                            userFirstName: userFirstName,
                            userLastName: userLastName,
                            userName: userName,
                            userPwd: userPwd
                        },
                        success: function (response) {
                            // Handle the success response
                            console.log('Data saved successfully:', response);
                            // Close the modal if needed
                            modalToShow.hide();
                            // Additional actions after saving the data
                        },
                        error: function (error) {
                            // Handle the error response
                            console.log('Error occurred while saving the data:', error);
                        }
                    });

                });
            }
        }, 200);



        // Form validation for Add new record
        const fv2 = FormValidation.formValidation(targetedModalForm, {
            fields: {
                modalEditUserFirstname1: {
                    validators: {
                        notEmpty: {
                            message: 'The firstname field is required'
                        }
                    }
                },
                modalEditUserLastname1: {
                    validators: {}
                },
                modalEditUsername1: {
                    validators: {
                        notEmpty: {
                            message: 'The username field is required'
                        }
                    }
                },
                modalEditUserPassword1: {
                    validators: {
                        notEmpty: {
                            message: 'The password field is required'
                        },
                        stringLength: {
                            min: 6,
                            message: 'Password must be more than 6 characters'
                        }
                    }
                },
                modalEditUserPasswordConfirm1: {
                    validators: {
                        notEmpty: {
                            message: 'The password matching field is required'
                        },
                        identical: {
                            compare: function() {
                                return formChangePass.querySelector(
                                    '[name="modalEditUserPassword1"]').value;
                            },
                            message: 'The password and its confirm are not the same'
                        },
                        stringLength: {
                            min: 6,
                            message: 'Password must be more than 6 characters'
                        }
                    }
                },
                bsvalidationcheckbox: {
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
                            case 'modalEditUserFirstname1':
                            case 'modalEditUserLastname1':
                            case 'modalEditUsername1':
                                return '.form-control';
                            case 'modalEditUserPassword1':
                            case 'modalEditUserPasswordConfirm1':
                                return '.col-12 .input-group .form-floating .form-control';
                            case 'bsvalidationcheckbox':
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

        const saveRecordBtn = document.querySelector('#addUserModalTB .modal-user-save-btn');
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
