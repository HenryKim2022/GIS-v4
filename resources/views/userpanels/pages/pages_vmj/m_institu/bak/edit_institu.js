////////////////////////////////////////////////////////////////// PART: ADD INSTITU
$(document).ready(function () {
    let fv2, offCanvasEl2;
    const formEditOldRecord = document.getElementById('form-edit-old-record');
    setTimeout(() => {
        const offCanvasElement2 = document.querySelector('#edit-old-record');
        var lenEditRecordButtons = dt_basic.rows().count() + 1;
        if (lenEditRecordButtons > 0) {
          for (var i = 1; i < lenEditRecordButtons; i++) {
            const oldRecord = document.querySelector('.edit-record-' + i);

            // To open offCanvas, to add new record
            if (oldRecord) {
              oldRecord.addEventListener('click', function () {
                offCanvasEl2 = new bootstrap.Offcanvas(offCanvasElement2);
                // Empty fields on offCanvas open
                offCanvasElement2.querySelector('.dt-edit-institu-name').value = '';
                offCanvasElement2.querySelector('.dt-edit-cat-id').value = '';
                offCanvasElement2.querySelector('.dt-edit-npsn').value = '';
                offCanvasElement2.querySelector('.dt-edit-logo').value = '';
                offCanvasElement2.querySelector('.dt-edit-imgs').value = '';
                offCanvasElement2.querySelector('.dt-edit-addr').value = '';
                offCanvasEl2.show();
              });
            }
          }
        }
    }, 200);

    // Form validation for Add new record
    fv2 = FormValidation.formValidation(formEditOldRecord, {
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
    // const flatpickrDate2 = document.querySelector('[name="basicDate"]');

    // if (flatpickrDate2) {
    //     flatpickrDate2.flatpickr({
    //         enableTime: false,
    //         // See https://flatpickr.js.org/formatting/
    //         dateFormat: 'm/d/Y',
    //         // After selecting a date, we need to revalidate the field
    //         onChange: function () {
    //             fv2.revalidateField('basicDate');
    //         }
    //     });
    // }



    // ////////////////////////////////////////////////////// SET DROPZONE /////////////////////////////////////////////////////////////

    // setDropZone();

    // Add New record
    // ? Remove/Update this code as per your requirements
    var count2 = dt_basic.rows().count() + 1;

    // On form submit, if form is valid
    fv2.on('core.form.valid', async function () {
        var $new_edited_actions = `
                    <div class="d-inline-block">
                    <a href="javascript:;"
                        class="btn btn-sm btn-text-primary rounded-pill btn-icon dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-end m-0">
                        <a href="javascript:;"
                        class="dropdown-item btn-text-success btn-sm mdi mdi-image-text d-none">
                        Details</a>
                        <a href="javascript:;"
                        class="dropdown-item btn-text-warning btn-sm mdi mdi-pencil-outline">
                        Edit</a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:;"
                        class="dropdown-item text-danger delete-record btn-sm mdi mdi-trash-can-outline">
                        Delete</a>
                    </div>
                    </div>
                `;
        var $new_edited_number = count2;
        var $new_edited_name = $('.edit-old-record .dt-edit-institu-name').val();
        var $new_edited_cat_id = $('.edit-old-record .dt-edit-cat-id').val();
        var $new_edited_npsn = $('.edit-old-record .dt-edit-npsn').val();
        var $new_edited_logo = '';
        // var $old_edited_imgs = $('.edit-old-record .dt-edit-imgs').val();
        var $new_edited_addr = $('.edit-old-record .dt-edit-addr').val();

        // Convert the logo image file to Base64 format
        const edited_LogoFile = $('.edit-old-record .dt-edit-logo')[0].files[0];
        if (edited_LogoFile) {
            try {
                const logoBase64_2 = await imageToBase64(edited_LogoFile);
                $new_edited_logo = `
            <div class="d-flex align-items-center justify-content-around">
                <img src="${logoBase64_2}" class="hover-image mr-2" alt="Logo 1" style="height: 24px; width: 24px;">
            </div>
            `;
            } catch (error) {
                console.error('Error converting logo image to Base64:', error);
            }
        }


        var $old_edited_imgs = '';
        var edited_ImageFiles = $('.edit-old-record .dt-edit-imgs')[0].files;
        // Convert each image file to Base64 format
        if (edited_ImageFiles.length > 0) {
            $old_edited_imgs += `<div class="d-flex align-items-center justify-content-around gap-1 gap-md-0 gap-lg-0">`;
            for (var i = 0; i < edited_ImageFiles.length; i++) {
                try {
                    var imageBase64_2 = await imageToBase64(edited_ImageFiles[i]);
                    // var marginRight = (i === edited_ImageFiles.length - 1) ? '' : 'margin-right: 0.5rem;';
                    $old_edited_imgs += `<img src="${imageBase64_2}" class="hover-image mr-2" alt="Image ${i + 1}" style="height: 24px; width: 24px;">`;
                } catch (error) {
                    console.error(`Error converting image ${i + 1} to Base64:`, error);
                }
            }
            $old_edited_imgs += `</div>`;
        }



        if ($new_edited_name != '') {
            dt_basic.row
                .add({
                    action: $new_edited_actions, // Column '0': Actions
                    no: $new_edited_number, // Column '1': NO.
                    name: $new_edited_name, // Column '2': NAME
                    cat_id: $new_edited_cat_id, // Column '3': CAT
                    npsn: $new_edited_npsn, // Column '4': NPSN
                    logo: $new_edited_logo, // Column '5': LOGO
                    images: $old_edited_imgs, // Column '6': IMAGES
                    addr: $new_edited_addr // Column '7': ADDR
                })
                .draw();

            dt_basic
                .order([
                    [1, 'asc']
                ]) // Sort by the 'NO.' column in ascending order (index 1)
                .draw();

            count2++;

            // Hide offcanvas using javascript method
            offCanvasEl2.hide();
        }


    });
});
