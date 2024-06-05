document.addEventListener('DOMContentLoaded', function () {
    const modalId = 'editMarkModalTB';
    const modalSelector = document.getElementById(modalId);
    const modalToShow = new bootstrap.Modal(modalSelector);
    const targetedModalForm = document.querySelector('#' + modalId + ' #editMarkForm');



    $(document).on('click', '.edit-record', function (event) {
        var markID = $(this).attr('mark_id_value');
        console.log('Edit button clicked for mark_id:', markID);

        setTimeout(() => {
            $.ajax({
                url: '/m-mark/get-mark',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    markID: markID
                },
                success: function (response) {
                    // console.log("Response:\n" + response);
                    console.log(response);
                    // Update the input values in the modal with the fetched latitude and longitude
                    $('#modalEditMarkID2').val(response.mark_id);
                    $('#modalEditLatitude2').val(response.latitude);
                    $('#modalEditLongitude2').val(response.longitude);
                    $('#modalEditMarkAddress2').val(response.mark_address);
                    // console.log(response.mark_address);
                    // Show the modal
                    console.log('SHOWING MODAL');
                    modalToShow.show();

                },
                error: function (error) {
                    console.log("Err:\n");
                    console.log(error);
                }
            });
        });




    });

    const editCancelBtn = document.querySelector('#'+modalId+ ' #editMarkForm .modal-mark-cancel-btn');
    // To open Modal, to add edit record
    if (editCancelBtn) {
        editCancelBtn.addEventListener('click', function () {
            closeModal(modalToShow);
        });
    }



     // Form validation for Add new record
     const fv2_tb = FormValidation.formValidation(targetedModalForm, {
        fields: {
            modalEditLatitude2: {
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
            modalEditLongitude2: {
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
            modalEditMarkAddress2: {
                validators: {
                    notEmpty: {
                        message: 'The longitude field is required'
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
                        case 'modalEditLatitude2':
                        case 'modalEditLongitude2':
                        case 'modalEditMarkAddress2':
                            // return '.col-12';
                            return '#' + modalId + ' .col-12';
                        // case 'bsvalidationcheckbox2':
                        //     return '#' + modalId + ' .col-12';
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

    const saveRecordBtn = document.querySelector('#'+modalId+ ' .modal-mark-save-btn');
    if (saveRecordBtn) {
        saveRecordBtn.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default button behavior

            fv2_tb.validate().then(function (status) {
                if (status === 'Valid') {
                    targetedModalForm.submit(); // Submit the form if validation passes
                }
            });
        });
    }


});
