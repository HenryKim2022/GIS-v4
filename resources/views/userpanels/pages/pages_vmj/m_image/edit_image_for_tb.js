document.addEventListener('DOMContentLoaded', function () {
    const modalSelector = document.getElementById('editImageModalTB');
    const modalToShow = new bootstrap.Modal(modalSelector);
    const targetedModalForm = document.querySelector('#editImageModalTB #editImageForm');


    $(document).on('click', '.edit-record', function () {
        var imgID = $(this).attr('img_id_value');
        console.log('Edit button clicked for img_id:', imgID);
        setTimeout(() => {

            // Make an AJAX request to fetch latitude and longitude based on imgID
            $.ajax({
                url: '/m-image/get-img',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    imgID: imgID
                },
                success: function (response) {
                    console.log(response);
                    // Update the input values in the modal with the fetched latitude and longitude
                    $('#modalEditImageID2').val(response.img_id);
                    // $('#modalEditInstitutionIDSelect2').val(response.inst_name);
                    $('#modalEditImageTitle2').val(response.img_title);
                    $('#modalEditImageDescb2').val(response.img_descb);

                    // $('#modalEditImageSRC2').val(response.inst_npsn);

                    // Set the input file, the returned response.inst_logo, and the logo-preview src was returned response.inst_logo too
                    var addLogoPreview = $(modalSelector).find('.logo-add-preview-container');
                    var logoPreview = addLogoPreview.find('.logo-preview');
                    // Set the logo preview src to response.inst_logo if it exists
                    if (response.img_src) {
                        var img = new Image();
                        img.onload = function () {
                            logoPreview.attr('src', img.src);
                        };
                        img.src = response.img_src;
                    } else {
                        logoPreview.attr('src', 'public/img/noimage.png');
                    }


                    setinstList();
                    function setinstList() {
                        // Populate the select options for modalEditInstitutionMARKID1
                        var instSelect = $('#editImageModalTB #modalEditInstitutionIDSelect2');
                        instSelect.empty(); // Clear existing options
                        instSelect.append($('<option>', { value: "", text: "Select Institution" }));

                        $.each(response.instList, function (index, instOption) {
                            var option = $('<option>', { value: instOption.value, text: `[${instOption.value}] ${instOption.text}` });
                            if (instOption.selected) {
                                option.attr('selected', 'selected'); // Select the option
                            }
                            instSelect.append(option);
                        });

                    }

                    // Show the modal
                    console.log('SHOWING MODAL');
                    modalToShow.show();
                    // loadSelectList(imgID);
                },
                error: function (error) {
                    console.log("Err:\n");
                    console.log(error);
                }
            });
        }, 200);

    });


    const editCancelBtn = document.querySelector('#editImageModalTB #editImageForm .modal-image-cancel-btn');
    // To open Modal, to add edit record
    if (editCancelBtn) {
        editCancelBtn.addEventListener('click', function () {
            modalToShow.hide();
        });
    }



    // Form validation for Add new record
    const fv2 = FormValidation.formValidation(targetedModalForm, {
        fields: {
            modalEditImageID2: {
                validators: {
                    notEmpty: {
                        message: 'The instution-id field is required'
                    },
                }
            },
            modalEditInstitutionName2: {
                validators: {
                    notEmpty: {
                        message: 'The institution-name field is required'
                    }
                }
            },
            modalEditInstitutionNPSN2: {
                validators: {
                    notEmpty: {
                        message: 'The npsn field is required'
                    }
                }
            },
            modalEditInstitutionCATID2: {
                validators: {
                    notEmpty: {
                        message: 'The category field is required'
                    }
                }
            },
            modalEditInstitutionLOGO2: {
                validators: { /* this one is not need attrib notEmpty */ }
            },
            modalEditInstitutionMARKID2: {
                validators: {
                    notEmpty: {
                        message: 'The mark field is required'
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
                        case 'modalEditImageID2':
                        case 'modalEditInstitutionName2':
                        case 'modalEditInstitutionNPSN2':
                        case 'modalEditInstitutionLOGO2':
                        case 'modalEditInstitutionCATID2':
                        case 'modalEditInstitutionMARKID2':
                        case 'bsvalidationcheckbox2':
                            return '.col-12';
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

    const saveRecordBtn = document.querySelector('#editImageModalTB .modal-institu-save-btn');
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



});
