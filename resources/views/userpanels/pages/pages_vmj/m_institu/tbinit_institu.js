
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
            width: '0.1rem',
            className: 'control',
            responsivePriority: 1
            // "width": "auto"
        },
        {
            targets: 1, // Target the second column (index 1)
            width: '0.1rem', // Set the width of the second column
            responsivePriority: 2
        },
        {
            targets: 2, // Target the second column (index 1)
            responsivePriority: 3
        },
        {
            targets: 3, // Target the second column (index 1)
            responsivePriority: 8
        },
        {
            targets: 4, // Target the second column (index 1)
            responsivePriority: 5
        },
        {
            targets: 5, // Target the second column (index 1)
            responsivePriority: 6
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
        "data": "name"
    }, // Column '2': NAME
    {
        "data": "cat_id"
    }, // Column '3': CAT
    {
        "data": "npsn"
    }, // Column '4': NPSN
    {
        "data": "logo"
    }, // Column '5': LOGO
    {
        "data": "images"
    }, // Column '6': IMAGES
    {
        "data": "addr"
    } // Column '7': ADDR
    ]
});

// Fixed header
if (window.Helpers.isNavbarFixed()) {
    var navHeight = $('#layout-navbar').outerHeight();
    new $.fn.dataTable.FixedHeader(dt_fixedheader).headerOffset(navHeight);
} else {
    new $.fn.dataTable.FixedHeader(dt_fixedheader);
}


// // Delete Record
// $('#DataTables_Table_1 tbody').on('click', '.delete-record', function () {
//     var confirmed = confirm("Are you sure you want to this records?");
//     if (confirmed) {
//         dt_basic.row($(this).parents('tr')).remove().draw();
//     }

// });

// ResetRecord
$('.reset-record').on('click', function () {
    var confirmed = confirm("Are you sure you want to delete all records?");
    if (confirmed) {
        var tbody = $('#DataTables_Table_1 tbody');
        tbody.empty();
        tbody.append('<tr><td colspan="8" class="text-center">No data</td></tr>');
    }
});


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
function setDropZone() {
    Dropzone.autoDiscover = false;
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
            url: window.location.pathname,
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
    })

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
