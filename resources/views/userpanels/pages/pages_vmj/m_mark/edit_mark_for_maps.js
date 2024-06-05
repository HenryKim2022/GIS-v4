// document.addEventListener('DOMContentLoaded', function () {
    const modalId = 'editMarkModalMAPS';
    const modalSelector = document.getElementById(modalId);
    const modalToShow = new bootstrap.Modal(modalSelector);
    const targetedModalForm = document.querySelector('#' + modalId + ' #editMarkFormMAPS');

    // Form validation for Add new record
    const fv2_maps = FormValidation.formValidation(targetedModalForm, {
        fields: {
            modalEditLatitudeMAPS: {
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
            modalEditLongitudeMAPS: {
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
            modalEditMarkAddressMAPS: {
                validators: {
                    notEmpty: {
                        message: 'The address field is required'
                    }
                }
            },
            bsvalidationcheckboxMAPS: {
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
                        case 'modalEditLatitudeMAPS':
                        case 'modalEditLongitudeMAPS':
                        case 'modalEditMarkAddressMAPS':
                            return '#' + modalId + ' .col-12';
                            // return '.col-12';
                        case 'bsvalidationcheckboxMAPS':
                            return '#' + modalId + ' #cs_cb_maps';
                        //     return '#' + modalId + ' .form-check-input';
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

    const processCheckBox = document.querySelector('#'+modalId+ ' #cs_cb_maps');
    if (processCheckBox) {
        processCheckBox.addEventListener('click', function (event) {
            // event.preventDefault(); // Prevent the default button behavior
            // event.stopPropagation();
        });
    }

    const saveRecordBtn = document.querySelector('#'+modalId+ ' .modal-mark-map-save-btn');
    if (saveRecordBtn) {
        saveRecordBtn.addEventListener('click', function (event) {
            // event.preventDefault(); // Prevent the default button behavior

            fv2_maps.validate().then(function (status) {
                if (status === 'Valid') {
                    targetedModalForm.submit(); // Submit the form if validation passes
                }
            });
        });
    }


// });
