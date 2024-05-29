////////////////////////////////////////////////////////////////// PART: ADD INSTITU
$(document).ready(function () {
    let fv, offCanvasEl;
    const formAddNewRecord = document.getElementById('form-add-new-record');
    setTimeout(() => {
        const newRecord = document.querySelector('.add-record');
        const offCanvasElement = document.querySelector('#add-new-record');

        // To open offCanvas, to add new record
        if (newRecord) {
            newRecord.addEventListener('click', function () {
                offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
                // Empty fields on offCanvas open
                (offCanvasElement.querySelector('.dt-add-institu-name').value = ''),
                    (offCanvasElement.querySelector('.dt-add-cat-id').value = ''),
                    (offCanvasElement.querySelector('.dt-add-npsn').value = ''),
                    (offCanvasElement.querySelector('.dt-add-logo').value = ''),
                    (offCanvasElement.querySelector('.dt-add-imgs').value = ''),
                    (offCanvasElement.querySelector('.dt-add-addr').value = '');
                // (offCanvasElement.querySelector('.dt-mark-id').value = ''),
                // (offCanvasElement.querySelector('.dt-date').value = ''),
                // (offCanvasElement.querySelector('.dt-salary').value = '');
                // Open offCanvas with form
                offCanvasEl.show();
            });
        }
    }, 200);

    // Form validation for Add new record
    fv = FormValidation.formValidation(formAddNewRecord, {
        fields: {
            institutionName: {
                validators: {
                    notEmpty: {
                        message: 'The name is required'
                    }
                }
            },
            institutionCATID: {
                validators: {
                    notEmpty: {
                        message: 'The categories field is required'
                    }
                }
            },
            institutionNPSN: {
                validators: {
                    notEmpty: {
                        message: 'The npsn field is required'
                    }
                }
            },
            institutionLOGO: {
                validators: {}
            },
            institutionIMGS: {
                validators: {}
            },
            institutionADDR: {
                validators: {
                    notEmpty: {
                        message: 'The address field is required'
                    }
                }
            }
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                // Use this for enabling/changing valid/invalid class
                // eleInvalidClass: '',
                eleValidClass: '',
                rowSelector: '.col-sm-12'
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
            autoFocus: new FormValidation.plugins.AutoFocus()
        },
        init: instance => {
            instance.on('plugins.message.placed', function (e) {
                if (e.element.parentElement.classList.contains('input-group')) {
                    e.element.parentElement.insertAdjacentElement('afterend', e
                        .messageElement);
                }
            });
        }
    });

    // // FlatPickr Initialization & Validation
    // const flatpickrDate = document.querySelector('[name="basicDate"]');

    // if (flatpickrDate) {
    //     flatpickrDate.flatpickr({
    //         enableTime: false,
    //         // See https://flatpickr.js.org/formatting/
    //         dateFormat: 'm/d/Y',
    //         // After selecting a date, we need to revalidate the field
    //         onChange: function () {
    //             fv.revalidateField('basicDate');
    //         }
    //     });
    // }




    // setDropZone();

    // Add New record
    // ? Remove/Update this code as per your requirements
    // var count_1 = 101;
    var count_1 = dt_basic.rows().count() + 1;

    // On form submit, if form is valid
    fv.on('core.form.valid', async function () {
        var $new_added_actions = `
                    <div class="d-inline-block">
                    <a href="javascript:;"
                        class="btn btn-sm btn-text-primary rounded-pill btn-icon dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-end m-0">
                        <a href="javascript:;"
                        class="dropdown-item btn-text-success btn-sm mdi mdi-image-text d-none">
                        Details</a>
                        <a href="javascript:;"
                        class="dropdown-item btn-text-warning edit-record-${count_1} btn-sm mdi mdi-pencil-outline">
                        Edit</a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:;"
                        class="dropdown-item text-danger delete-record btn-sm mdi mdi-trash-can-outline">
                        Delete</a>
                    </div>
                    </div>
                `;
        var $new_added_number = count_1;
        var $new_added_name = $('.add-new-record .dt-add-institu-name').val();
        var $new_added_cat_id = $('.add-new-record .dt-add-cat-id').val();
        var $new_added_npsn = $('.add-new-record .dt-add-npsn').val();
        var $new_added_logo = '';
        // var $new_added_imgs = $('.add-new-record .dt-add-imgs').val();
        var $new_added_addr = $('.add-new-record .dt-add-addr').val();

        // Convert the logo image file to Base64 format
        const added_LogoFile = $('.add-new-record .dt-add-logo')[0].files[0];
        if (added_LogoFile) {
            try {
                const logoBase64_1 = await imageToBase64(added_LogoFile);
                $new_added_logo = `
            <div class="d-flex align-items-center justify-content-around">
                <img src="${logoBase64_1}" class="hover-image" alt="Logo 1" style="height: 24px; width: 24px;">
            </div>
            `;
            } catch (error) {
                console.error('Error converting logo image to Base64:', error);
            }
        }


        var $new_added_imgs = '';
        var added_ImageFiles = $('.add-new-record .dt-add-imgs')[0].files;
        // Convert each image file to Base64 format
        if (added_ImageFiles.length > 0) {
            $new_added_imgs += `<div class="d-flex align-items-center justify-content-around gap-1 gap-md-0 gap-lg-0">`;
            for (var i = 0; i < added_ImageFiles.length; i++) {
                try {
                    var imageBase64_1 = await imageToBase64(added_ImageFiles[i]);
                    // var marginRight = (i === added_ImageFiles.length - 1) ? '' : 'margin-right: 0.5rem;';
                    $new_added_imgs += `<img src="${imageBase64_1}" class="hover-image mr-2" alt="Image ${i + 1}" style="height: 24px; width: 24px;">`;
                } catch (error) {
                    console.error(`Error converting image ${i + 1} to Base64:`, error);
                }
            }
            $new_added_imgs += `</div>`;
        }



        if ($new_added_name != '') {
            dt_basic.row
                .add({
                    action: $new_added_actions, // Column '0': Actions
                    no: $new_added_number, // Column '1': NO.
                    name: $new_added_name, // Column '2': NAME
                    cat_id: $new_added_cat_id, // Column '3': CAT
                    npsn: $new_added_npsn, // Column '4': NPSN
                    logo: $new_added_logo, // Column '5': LOGO
                    images: $new_added_imgs, // Column '6': IMAGES
                    addr: $new_added_addr // Column '7': ADDR
                })
                .draw();

            dt_basic
                .order([
                    [1, 'asc']
                ]) // Sort by the 'NO.' column in ascending order (index 1)
                .draw();

            count_1++;

            // Hide offcanvas using javascript method
            offCanvasEl.hide();
        }


    });


});
