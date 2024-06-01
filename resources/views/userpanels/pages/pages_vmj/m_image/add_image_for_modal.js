document.addEventListener('DOMContentLoaded', function () {
    const modalSelector = document.getElementById('addImageModalTB');
    const targetedModalForm = document.querySelector('#addImageModalTB #addImageForm');

    if (modalSelector) {
        // Form validation for Add new record
        const fv1 = FormValidation.formValidation(targetedModalForm, {
            fields: {
                modalEditInstitutionIDSelect1: {
                    validators: {
                        notEmpty: {
                            message: 'The institution-name field is required'
                        }
                    }
                },
                modalEditImageTitle1: {
                    validators: {
                        notEmpty: {
                            message: 'The image-title field is required'
                        }
                    }
                },
                modalEditImageDescb1: {
                    validators: {}
                },
                modalEditImageSRC1: {
                    validators: {}
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
                            case 'modalEditInstitutionIDSelect1':
                            case 'modalEditImageTitle1':
                            case 'modalEditImageDescb1':
                            case 'modalEditImageSRC1':
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

        const modalEditInstitutionID1 = document.getElementById('modalEditInstitutionID1');
        if (modalEditInstitutionID1) {
            modalEditInstitutionID1.addEventListener('change', function () {
                fv1.revalidateField('modalEditInstitutionIDSelect1');
            });
        }

        const saveRecordBtn = document.querySelector('#addImageModalTB .modal-image-save-btn');
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
