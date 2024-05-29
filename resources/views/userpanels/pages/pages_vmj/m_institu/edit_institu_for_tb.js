document.addEventListener('DOMContentLoaded', function () {
    const modalSelector = document.getElementById('editInstituModalTB');
    const modalToShow = new bootstrap.Modal(modalSelector);
    const targetedModalForm = document.querySelector('#editInstituModalTB #editInstituForm');


    $(document).on('click', '.edit-record', function () {
        var instituID = $(this).attr('institu_id_value');
        console.log('Edit button clicked for institu_id:', instituID);
        setTimeout(() => {

            // Make an AJAX request to fetch latitude and longitude based on instituID
            $.ajax({
                url: '/m-inst/get-inst',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    instituID: instituID
                },
                success: function (response) {
                    console.log(response);
                    // Update the input values in the modal with the fetched latitude and longitude
                    $('#modalEditInstitutionID2').val(response.inst_id);
                    $('#modalEditInstitutionName2').val(response.inst_name);
                    $('#modalEditInstitutionNPSN2').val(response.inst_npsn);

                    // Set the input file, the returned response.inst_logo, and the logo-preview src was returned response.inst_logo too
                    var addLogoPreview = $(modalSelector).find('.logo-add-preview-container');
                    var logoPreview = addLogoPreview.find('.logo-preview');
                    // Set the logo preview src to response.inst_logo if it exists
                    if (response.inst_logo) {
                        // Create a new Image element
                        var img = new Image();

                        // Set an event listener to handle the image load
                        img.onload = function () {
                            // Update the logo preview src when the image is loaded
                            logoPreview.attr('src', img.src);
                        };

                        // Set the src attribute of the Image element
                        img.src = response.inst_logo;
                    } else {
                        // If response.inst_logo is empty or null, reset the logo preview to default
                        logoPreview.attr('src', 'public/img/noimage.png');
                    }


                    setMarkList();
                    function setMarkList() {
                        // Populate the select options for modalEditInstitutionMARKID1
                        var markSelect = $('#editInstituModalTB #modalEditInstitutionMARKID2');
                        markSelect.empty(); // Clear existing options
                        markSelect.append($('<option>', { value: "", text: "Select Mark" }));

                        $.each(response.markList, function (index, markOption) {
                            var option = $('<option>', { value: markOption.value, text: `[${markOption.value}] ${markOption.text}` });
                            if (markOption.selected) {
                                option.attr('selected', 'selected'); // Select the option
                            }
                            markSelect.append(option);
                        });

                    }

                    setCategoryList();
                    function setCategoryList() {
                        // Populate the select options for modalEditInstitutionCATID1
                        var catSelect = $('#editInstituModalTB #modalEditInstitutionCATID2');
                        catSelect.empty(); // Clear existing options
                        catSelect.append($('<option>', { value: "", text: "Select Category" }));

                        $.each(response.catList, function (index, catOption) {
                            option = $('<option>', { value: catOption.value, text: `[${catOption.value}] ${catOption.text}` });
                            if (catOption.selected) {
                                option.attr('selected', 'selected'); // Select the option
                            }
                            catSelect.append(option);
                        });

                    }

                    // Show the modal
                    console.log('SHOWING MODAL');
                    modalToShow.show();
                    // loadSelectList(instituID);
                },
                error: function (error) {
                    console.log("Err:\n");
                    console.log(error);
                }
            });
        }, 200);

    });


    const editCancelBtn = document.querySelector('#editInstituModalTB #editInstituForm .modal-institu-cancel-btn');
    // To open Modal, to add edit record
    if (editCancelBtn) {
        editCancelBtn.addEventListener('click', function () {
            modalToShow.hide();
        });
    }



    // Form validation for Add new record
    const fv2 = FormValidation.formValidation(targetedModalForm, {
        fields: {
            modalEditInstitutionID2: {
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
                        case 'modalEditInstitutionID2':
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

    const saveRecordBtn = document.querySelector('#editInstituModalTB .modal-institu-save-btn');
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
