
// ////////////////////////////////////////////////////// INIT: DATATABLES /////////////////////////////////////////////////////////////
var dt_fixedheader = $('.dt-fixedheader'),
    dt_basic;

dt_basic = $('#DataTables_Table_1').DataTable({
    "paging": true,
    "searching": true,
    "pageLength": 10,
    "lengthMenu": [10, 25, 50, 75, 100, 150, 200, 250, 300, 350, 400],
    "info": true,
    // "ordering": true,
    // "responsive": true,
    "columnDefs": [
        {
            orderable: false,
            targets: 0, // Disable sorting on the first and second columns
            // width: '0.1rem',
            className: 'control',
            responsivePriority: 0
            // "width": "auto"
        },
        {
            targets: 1, // Target the second column (index 1)
            // width: '0.1rem', // Set the width of the second column
            responsivePriority: 1
        },
        {
            targets: 2, // Target the second column (index 1)
            responsivePriority: 2
        },
        {
            targets: 3, // Target the second column (index 1)
            responsivePriority: 3
        },
        {
            targets: 4, // Target the second column (index 1)
            responsivePriority: 4
        },
        {
            targets: 5, // Target the second column (index 1)
            responsivePriority: 5
        },
        {
            targets: 6, // Target the second column (index 1)
            responsivePriority: 6
        },
        {
            orderable: false,
            targets: 7, // Target the second column (index 1)
            responsivePriority: 7
        }
    ],
    "buttons": [{
        "extend": 'collection',
        "className": 'btn btn-label-primary dropdown-toggle me-2 waves-effect waves-light',
        "text": '<i class="mdi mdi-export-variant me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
        "buttons": [{
            "extend": 'csv',
            "className": 'btn btn-label-primary',
            "text": '<i class="mdi mdi-file-excel me-sm-1"></i> CSV'
        },
        {
            "extend": 'excel',
            "className": 'btn btn-label-primary',
            "text": '<i class="mdi mdi-file-excel me-sm-1"></i> Excel'
        },
            // Add more buttons as needed
        ]
    }],
    "columns": [{
        "data": "action"
    }, // Column '0': Actions
    {
        "data": "no"
    }, // Column '1': NO.
    {
        "data": "institu_name"
    }, // Column '2': LAT
    {
        "data": "institu_npsn"
    }, // Column '3': LON
    {
        "data": "mark_address"
    }, // Column '4': ADDRESS
    {
        "data": "institu_logo"
    }, // Column '5': LOGO
    {
        "data": "institu_image"
    }, // Column '6': MARK ADDRESS
    {
        "data": "updated_at"
    }  // Column '7': UPDATED
    ]
});



// Fixed header
if (window.Helpers.isNavbarFixed()) {
    var navHeight = $('#layout-navbar').outerHeight();
    new $.fn.dataTable.FixedHeader(dt_fixedheader).headerOffset(navHeight);
} else {
    new $.fn.dataTable.FixedHeader(dt_fixedheader);
}



const addRecordBtn = document.querySelector('.add-institution-record');
if (addRecordBtn) {
    addRecordBtn.addEventListener('click', function () {
        // Make an AJAX request to get the data mark & category select-list
        $.ajax({
            url: '/m-inst/load-select-list',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                action: 'Get Mark & Category List for Select-list usage'
            },
            success: function (response) {
                // Handle the success response
                console.log('Data mark & category select list loaded successfully:', response);

                // Close the modal if needed

                // Populate the select options for modalEditInstitutionMARKID1
                var markSelect = $('#addInstituModalTB #modalEditInstitutionMARKID1');
                markSelect.empty(); // Clear existing options

                $.each(response.markList, function (index, markOption) {
                    var option = $('<option>', { value: markOption.value, text: `[${markOption.value}] ${markOption.text}` });
                    if (markOption.selected) {
                        option.attr('selected', 'selected'); // Select the option
                    }
                    markSelect.append(option);
                });

                // Populate the select options for modalEditInstitutionCATID1
                var catSelect = $('#addInstituModalTB #modalEditInstitutionCATID1');
                catSelect.empty(); // Clear existing options

                $.each(response.catList, function (index, catOption) {
                    var option = $('<option>', { value: catOption.value, text: `[${catOption.value}] ${catOption.text}` });
                    if (catOption.selected) {
                        option.attr('selected', 'selected'); // Select the option
                    }
                    catSelect.append(option);
                });
            },
            error: function (error) {
                // Handle the error response
                console.log('Error occurred while loading the data:', error);
            }
        });

    });
}




// // Delete Record
// $('#DataTables_Table_1 tbody').on('click', '.delete-record', function () {
//     var confirmed = confirm("Are you sure you want to delete this records?");
//     if (confirmed) {
//         dt_basic.row($(this).parents('tr')).remove().draw();
//     }

// });

// // ResetRecord
// $('#DataTables_Table_1 tbody .reset-record').on('click', function () {
//     var confirmed = confirm("Are you sure you want to delete all records?");
//     if (confirmed) {
//         var tbody = $('#DataTables_Table_1 tbody');
//         tbody.empty();
//         tbody.append('<tr><td colspan="5" class="text-center">No data</td></tr>');
//     }
// });


// Function to convert an image file to Base64 format
function imageToBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}




// PART: SET DROPZONE
// setDropZone();
function setDropZone() {
    Dropzones.autoDiscover = false;
    const dropzones = []
    $('.dropzone').each(function (i, el) {
        const name = 'g_' + $(el).data('field')

        const previewTemplate = `<div class="dz-preview dz-file-preview">
                            <div class="dz-details">
                            <div class="dz-thumbnail">
                                <img data-dz-thumbnail>
                                <span class="dz-nopreview">No preview</span>
                                <div class="dz-success-mark"></div>
                                <div class="dz-error-mark"></div>
                                <div class="dz-error-message"><span data-dz-errormessage></span></div>
                                <div class="dz-complete">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
                                    </div>
                                </div>

                            </div>
                            <div class="dz-filename" data-dz-name></div>
                            <div class="dz-size" data-dz-size></div>
                            </div>
                        </div>`;


        var myDropzone = new Dropzone(el, {
            previewTemplate: previewTemplate,
            // url: window.location.pathname,
            url: '/public/storage/',
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,
            paramName: name,
            addRemoveLinks: true,
        });


        // Handle file added event
        myDropzone.on("addedfile", function (file) {
            // Show the input element
            $(el).find('.fallback input').css('display', 'block');
        });

        dropzones.push(myDropzone)
    });

    // document.querySelector("button[type=submit]").addEventListener("click", function(e) {
    //     // Make sure that the form isn't actually being sent.
    //     e.preventDefault();
    //     e.stopPropagation();
    //     let form = new FormData($('form')[0])

    //     dropzones.forEach(dropzone => {
    //         let {
    //             paramName
    //         } = dropzone.options
    //         dropzone.files.forEach((file, i) => {
    //             form.append(paramName + '[' + i + ']', file)
    //         })
    //     })
    //     $.ajax({
    //         method: 'POST',
    //         data: form,
    //         processData: false,
    //         contentType: false,
    //         success: function(response) {
    //             window.location.replace(response)
    //         }
    //     });
    // });
}
