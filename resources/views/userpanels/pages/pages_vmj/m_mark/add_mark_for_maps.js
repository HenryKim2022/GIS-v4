document.addEventListener('DOMContentLoaded', function () {
    const modalId = 'addMarkModalMAPS';
    const modalSelector = document.getElementById(modalId);
    const targetedModalForm = document.querySelector('#' + modalId + ' #addMarkFormMAPS');


    // if (modalSelector) {
    // Form validation for Add new record
    const fv2_maps_add = FormValidation.formValidation(targetedModalForm, {
        fields: {
            modalEditLatitudeMAPS2: {
                validators: {
                    notEmpty: {
                        message: 'The latitude field is required'
                    },
                    regexp: {
                        regexp: /^-?\d+(\.\d+)?$/,
                        message: 'The latitude field must be a valid number'
                    }
                }
            },
            modalEditLongitudeMAPS2: {
                validators: {
                    notEmpty: {
                        message: 'The longitude field is required'
                    },
                    regexp: {
                        regexp: /^-?\d+(\.\d+)?$/,
                        message: 'The longitude field must be a valid number'
                    }
                }
            },
            modalEditMarkAddressMAPS2: {
                validators: {
                    notEmpty: {
                        message: 'The address field is required'
                    }
                }
            },
            bsvalidationcheckboxMAPS2: {
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
                        case 'modalEditLatitudeMAPS2':
                        case 'modalEditLongitudeMAPS2':
                        case 'modalEditMarkAddressMAPS2':
                            return '#' + modalId + ' .col-12';
                        default:
                            if (ele.type === 'checkbox') {
                                return '#' + ele.id;
                            }
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

    const saveRecordBtn = document.querySelector('#' + modalId + ' .modal-mark-save-btn');
    if (saveRecordBtn) {
        saveRecordBtn.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default button behavior

            fv2_maps_add.validate().then(function (status) {
                if (status === 'Valid') {
                    targetedModalForm.submit(); // Submit the form if validation passes
                }
            });
        });
    }
    // }

});
