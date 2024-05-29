document.addEventListener('DOMContentLoaded', function () {
    const modalSelector = document.getElementById('addInstituModalTB');
    const targetedModalForm = document.querySelector('#addInstituModalTB #addInstituForm');

    if (modalSelector) {
        // Form validation for Add new record
        const fv1 = FormValidation.formValidation(targetedModalForm, {
            fields: {
                modalEditInstitutionName1: {
                    validators: {
                        notEmpty: {
                            message: 'The institution-name field is required'
                        }
                    }
                },
                modalEditInstitutionNPSN1: {
                    validators: {
                        notEmpty: {
                            message: 'The npsn field is required'
                        }
                    }
                },
                modalEditInstitutionCATID1: {
                    validators: {
                        notEmpty: {
                            message: 'The category field is required'
                        }
                    }
                },
                modalEditInstitutionLOGO1: {
                    validators: {
                        // notEmpty: {
                        //     message: 'The logo field is required'
                        // }
                    }
                },
                modalEditInstitutionMARKID1: {
                    validators: {
                        notEmpty: {
                            message: 'The mark field is required'
                        }
                    }
                },
                bsvalidationcheckbox1: {
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
                            case 'modalEditInstitutionName1':
                            case 'modalEditInstitutionNPSN1':
                            case 'modalEditInstitutionCATID1':
                            case 'modalEditInstitutionLOGO1':
                            case 'modalEditInstitutionMARKID1':
                                return '.col-12';
                            case 'bsvalidationcheckbox1':
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

        const saveRecordBtn = document.querySelector('#addInstituModalTB .modal-institu-save-btn');
        if (saveRecordBtn) {
            saveRecordBtn.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent the default button behavior

                fv1.validate().then(function (status) {
                    if (status === 'Valid') {
                        targetedModalForm.submit(); // Submit the form if validation passes
                    }
                });
            });
        }
    }

});
