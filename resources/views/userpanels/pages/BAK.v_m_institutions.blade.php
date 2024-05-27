{{-- EXTEND: BASE WRAPPER --}}
@extends('userpanels.layouts.v_main')

@section('head_page_cssjs')
    <link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/libs/dropzone/dropzone.css') }}" />
    <script src="{{ asset('public/materialize/assets/vendor/libs/dropzone/dropzone.js') }}"></script>

    <link rel="stylesheet"
        href="{{ asset('public/materialize/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('public/materialize/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('public/materialize/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('public/materialize/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('public/materialize/assets/vendor/libs/datatables-select-bs5/select.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('public/materialize/assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('public/materialize/assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css') }}" />
@endsection




<!-- CONTENT: M-INSTITUTIONS -->
@section('content')
    @php
        $page = Session::get('page');
        $page_title = $page['page_title'];
        $page_url = $page['page_url'];
    @endphp
    {{-- HTML BELOW --}}

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">UserPanels /</span> <a
                href="{{ $page_url }}">{{ $page_title }}</a></h4>


        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0 align-middle">{{ $page_title }} Data</h5>
                <div class="d-inline-block">
                    <a href="javascript:;"
                        class="btn btn-sm btn-text-primary rounded-pill btn-icon dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown"><i class="mdi mdi-table-cog"></i></a>
                    <div class="dropdown-menu dropdown-menu-end m-0">
                        <a href="javascript:;" class="dropdown-item text-success add-record btn-sm mdi mdi-image-text"> Add
                            New Data</a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:;"
                            class="dropdown-item text-danger reset-record btn-sm mdi mdi-database-settings"> ResetTable</a>
                    </div>
                </div>

            </div>
            <div class="card-datatable table-responsive">
                <!--/ TABLE -->
                <table id="DataTables_Table_1" class="dt-fixedheader table table-bordered">
                    <thead class="">
                        <tr>
                            <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1"
                                style="width: 18px;" aria-label="Actions">ACT</th>
                            <th>NO.</th>
                            <th>NAME</th>
                            <th>CAT</th>
                            <th>NPSN</th>
                            <th>LOGO</th>
                            <th>IMAGES</th>
                            <th>ADDR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 8;
                        @endphp
                        @for ($i = 1; $i < $count; $i++)
                            <tr>
                                <td class="dtr-hidden" tabindex="0" style="">
                                    <div class="d-inline-block">
                                        <a href="javascript:;"
                                            class="btn btn-sm btn-text-primary rounded-pill btn-icon dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end m-0">
                                            <a class="d-none" href="javascript:;"
                                                class="dropdown-item btn-text-success detail-record btn-sm mdi mdi-image-text">
                                                Details</a>
                                            <a href="javascript:;"
                                                class="dropdown-item btn-text-warning edit-record btn-sm mdi mdi-pencil-outline">
                                                Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="javascript:;"
                                                class="dropdown-item text-danger delete-record btn-sm mdi mdi-trash-can-outline">
                                                Delete</a>
                                        </div>
                                    </div>

                                </td>
                                <td>{{ $i }}</td>
                                <td>John Doe {{ $i }}</td>
                                <td>Category {{ $i }}</td>
                                <td>1234567890</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-around">
                                        <img src="{{ asset(env(key: 'APP_NOIMAGE')) }}" alt="Logo 1"
                                            style="height: 24px; width: 24px;">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-around">
                                        <img src="{{ asset(env(key: 'APP_NOIMAGE')) }}" alt="Logo 1" class="mr-2"
                                            style="height: 24px; width: 24px;">
                                        <img src="{{ asset(env(key: 'APP_NOIMAGE')) }}" alt="Logo 1" class="mr-2"
                                            style="height: 24px; width: 24px;">
                                        <img src="{{ asset(env(key: 'APP_NOIMAGE')) }}" alt="Logo 1" class="mr-2"
                                            style="height: 24px; width: 24px;">
                                    </div>
                                </td>
                                <td>Address 1</td>
                            </tr>
                        @endfor


                    </tbody>
                </table>
            </div>
        </div>
        <!--/ TABLE -->


        <!-- Modal to add new record -->
        <div class="offcanvas offcanvas-end" id="add-new-record">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="exampleModalLabel">New Record</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body flex-grow-1">
                <form class="add-new-record pt-0 row g-3" id="form-add-new-record" onsubmit="return false">
                    <div class="col-sm-12">
                        <div class="input-group input-group-merge">
                            <span id="institutionName2" class="input-group-text"><i
                                    class="mdi mdi-account-outline"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="institutionName" class="form-control dt-institu-name"
                                    name="institutionName" placeholder="SMA N 1 TOBOALI" aria-label="SMA N 1 TOBOALI"
                                    aria-describedby="institutionName2" />
                                <label for="institutionName">Institution Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="input-group input-group-merge">
                            <span id="institutionCATID2" class="input-group-text"><i
                                    class="mdi mdi-briefcase-outline"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="institutionCATID" name="institutionCATID"
                                    class="form-control dt-cat-id" placeholder="NPSN" aria-label="NPSN"
                                    aria-describedby="institutionCATID2" />
                                <label for="institutionCATID">CAT-ID</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="input-group input-group-merge">
                            <span id="institutionNPSN2" class="input-group-text"><i
                                    class="mdi mdi-briefcase-outline"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="institutionNPSN" name="institutionNPSN"
                                    class="form-control dt-npsn" placeholder="NPSN" aria-label="NPSN"
                                    aria-describedby="institutionNPSN2" />
                                <label for="institutionNPSN">NPSN</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="input-group input-group-merge">
                            <span id="institutionLOGO2" class="input-group-text"><i
                                    class="mdi mdi-briefcase-outline"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="file" id="institutionLOGO" name="institutionLOGO"
                                    class="form-control dt-logo" placeholder="LOGO" aria-label="LOGO"
                                    aria-describedby="institutionLOGO2" />
                                <label for="institutionLOGO">LOGO</label>
                            </div>
                        </div>
                        <div class="logo-add-preview-container mt-2 mb-2 d-flex justify-content-center"
                            id="addLogoPreview">
                            <img src="public/img/noimage.png" alt="" class="logo-preview"
                                style="height: 96px; width: 96px;">
                        </div>
                        <script>
                            var addLogoPreview = document.getElementsByClassName('logo-add-preview-container');
                            var addLogoInput = document.getElementById('institutionLOGO');
                            addLogoInput.addEventListener('change', function() {
                                const file = this.files[0];
                                if (file && file.type.startsWith('image/')) {
                                    const img = document.createElement('img');
                                    img.src = URL.createObjectURL(file);

                                    img.onload = function() {
                                        for (var i = 0; i < addLogoPreview.length; i++) {
                                            addLogoPreview[i].querySelector('.logo-preview').src = img.src;
                                        }
                                    };
                                } else {
                                    for (var i = 0; i < addLogoPreview.length; i++) {
                                        addLogoPreview[i].querySelector('.logo-preview').src = 'public/img/noimage.png';
                                    }
                                }
                            });
                        </script>
                    </div>

                    <div class="col-sm-12">
                        {{-- <div class="input-group input-group-merge">
                            <span id="institutionIMGS2" class="input-group-text"><i class="mdi mdi-briefcase-outline"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="file" id="institutionIMGS" name="institutionIMGS"
                                    class="form-control dt-imgs" placeholder="IMAGES" aria-label="IMAGES"
                                    aria-describedby="institutionIMGS2" multiple />
                                <label for="institutionIMGS">IMAGES</label>
                            </div>
                        </div>
                        <div class="images-add-preview-container mt-2 mb-2 d-flex justify-content-around" id="addImagesPreview">
                            <!-- No image placeholder -->
                        </div>
                        <script>
                            var addImagesPreview = document.getElementById('addImagesPreview');
                            var addImagesInput = document.getElementById('institutionIMGS');

                            addImagesInput.addEventListener('change', function() {
                                addImagesPreview.innerHTML = ''; // Clear previous previews

                                for (var i = 0; i < this.files.length; i++) {
                                    const file = this.files[i];
                                    if (file && file.type.startsWith('image/')) {
                                        const img = document.createElement('img');
                                        img.src = URL.createObjectURL(file);
                                        img.classList.add('images-preview');
                                        img.style.height = '96px';
                                        img.style.width = '96px';


                                        addImagesPreview.appendChild(img);
                                    }
                                }
                            });
                        </script> --}}


                        <div class="input-group input-group-merge">
                            <span id="institutionIMGS2" class="input-group-text"><i
                                    class="mdi mdi-briefcase-outline"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="file" id="institutionIMGS" name="institutionIMGS"
                                    class="form-control dt-imgs" placeholder="IMAGES" aria-label="IMAGES"
                                    aria-describedby="institutionIMGS2" multiple />
                                <label for="institutionIMGS">IMAGES</label>
                            </div>
                        </div>
                        <div class="carousel slide mt-2 mb-2" id="addImagesPreview" data-bs-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators list-unstyled" id="carouselIndicators"></ol>

                            <!-- Slides -->
                            <div class="carousel-inner d-flex justify-content-center" id="carouselInner">
                                <img src="public/img/noimage.png" alt="" class="logo-preview"
                                    style="height: 96px; width: 96px;">
                            </div>


                            <!-- Controls -->
                            <a class="carousel-control-prev" href="#addImagesPreview" role="button"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#addImagesPreview" role="button"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </div>
                        <script>
                            var addImagesInput = document.getElementById('institutionIMGS');
                            var carouselIndicators = document.getElementById('carouselIndicators');
                            var carouselInner = document.getElementById('carouselInner');

                            addImagesInput.addEventListener('change', function() {
                                carouselIndicators.innerHTML = ''; // Clear previous indicators
                                carouselInner.innerHTML = ''; // Clear previous slides

                                if (this.files.length === 0) {
                                    var defaultImage = document.createElement('img');
                                    defaultImage.src = 'public/img/noimage.png';
                                    defaultImage.alt = '';
                                    defaultImage.classList.add('logo-preview');
                                    defaultImage.style.height = '96px';
                                    defaultImage.style.width = '96px';

                                    carouselInner.appendChild(defaultImage);
                                    return; // Exit the function if no files selected
                                }

                                for (var i = 0; i < this.files.length; i++) {
                                    const file = this.files[i];
                                    if (file && file.type.startsWith('image/')) {
                                        const img = document.createElement('img');
                                        img.src = URL.createObjectURL(file);
                                        img.classList.add('carousel-item');
                                        if (i === 0) {
                                            img.classList.add('active');
                                        }

                                        const indicator = document.createElement('li');
                                        indicator.setAttribute('data-bs-target', '#addImagesPreview');
                                        indicator.setAttribute('data-bs-slide-to', i.toString());
                                        if (i === 0) {
                                            indicator.classList.add('active');
                                        }

                                        carouselInner.appendChild(img);
                                        carouselIndicators.appendChild(indicator);
                                    }
                                }

                                var defaultContent = document.querySelector('#carouselInner .logo-preview');
                                if (defaultContent) {
                                    defaultContent.remove(); // Remove default content if present
                                }

                                var sliderTextContainer = document.querySelector('.carousel-caption');
                                if (sliderTextContainer) {
                                    sliderTextContainer.remove(); // Remove previous slider text container if present
                                }

                                var sliderText = document.createElement('div');
                                sliderText.classList.add('carousel-caption', 'highlight');

                                var sliderTextLink = document.createElement('small');
                                sliderTextLink.classList.add('text-sm');
                                sliderTextLink.classList.add('text-bg-primary');
                                sliderTextLink.classList.add('p-2');
                                sliderTextLink.classList.add('rounded-pill');
                                sliderTextLink.innerText = truncateFilename(this.files[0].name, 20);

                                sliderText.appendChild(sliderTextLink);

                                var sliderContainer = document.querySelector('#addImagesPreview .carousel-inner');
                                sliderContainer.appendChild(sliderText);
                            });

                            // Function to truncate filename with an ellipsis (...) if it exceeds the given limit
                            function truncateFilename(filename, limit) {
                                if (filename.length <= limit) {
                                    return filename;
                                } else {
                                    return filename.substr(0, limit) + '...';
                                }
                            }
                        </script>



                        {{-- <div class="form-floating form-floating-outline form-control">
                            <div>
                                <label id="modalEditImage" name="modalEditImage" for="institutionIMGS"
                                    class="mb-2" disabled>Images</label>
                            </div>
                            <div class="card mb-2">
                                <div class="card-body dropzone">
                                    <div class="needsclick" id="dropzone-multi">
                                        <div class="dz-message needsclick text-sm">
                                            Drop files here or click to upload
                                            <span class="note needsclick text-sm">(This is just a demo dropzone.
                                                Selected files are
                                                <span class="fw-medium">not</span> actually uploaded.)</span>
                                        </div>
                                        <div class="fallback">
                                            <input class="dt-imgs" id="institutionIMGS" name="institutionIMGS"
                                                type="file" aria-label="IMAGES"
                                                aria-describedby="institutionIMGS2" multiple />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                    <div class="col-sm-12">
                        <div class="input-group input-group-merge">
                            <span id="institutionADDR2" class="input-group-text"><i
                                    class="mdi mdi-briefcase-outline"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="institutionADDR" name="institutionADDR"
                                    class="form-control dt-addr" placeholder="INST-ADDRESS" aria-label="INST-ADDRESS"
                                    aria-describedby="institutionADDR2" />
                                <label for="institutionADDR">INST-ADDRESS</label>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-sm-12">
                        <div class="input-group input-group-merge">
                            <span id="institutionMARKID2" class="input-group-text"><i
                                    class="mdi mdi-briefcase-outline"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="institutionMARKID" name="institutionMARKID" class="form-control dt-mark-id"
                                    placeholder="MARK-ID" aria-label="MARK-ID"
                                    aria-describedby="institutionMARKID2" />
                                <label for="institutionMARKID">MARK-ID</label>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="col-sm-12">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="mdi mdi-email-outline"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="basicEmail" name="basicEmail" class="form-control dt-email"
                                    placeholder="john.doe@example.com" aria-label="john.doe@example.com" />
                                <label for="basicEmail">Email</label>
                            </div>
                        </div>
                        <div class="form-text">You can use letters, numbers & periods</div>
                    </div>
                    <div class="col-sm-12">
                        <div class="input-group input-group-merge">
                            <span id="basicDate2" class="input-group-text"><i
                                    class="mdi mdi-calendar-month-outline"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control dt-date" id="basicDate" name="basicDate"
                                    aria-describedby="basicDate2" placeholder="MM/DD/YYYY" aria-label="MM/DD/YYYY" />
                                <label for="basicDate">Joining Date</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="input-group input-group-merge">
                            <span id="basicSalary2" class="input-group-text"><i class="mdi mdi-currency-usd"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="number" id="basicSalary" name="basicSalary" class="form-control dt-salary"
                                    placeholder="12000" aria-label="12000" aria-describedby="basicSalary2" />
                                <label for="basicSalary">Salary</label>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary"
                            data-bs-dismiss="offcanvas">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
<!-- CONTENT: M-INSTITUTIONS -->



@section('footer_page_js')
    {{-- <script src="{{ asset('public/materialize/assets/js/tables-datatables-extensions.js') }}"></script> --}}


    <script>
        // $(document).ready(function() {
        let fv, offCanvasEl;
        const formAddNewRecord = document.getElementById('form-add-new-record');
        setTimeout(() => {
            const newRecord = document.querySelector('.add-record'),
                offCanvasElement = document.querySelector('#add-new-record');

            // To open offCanvas, to add new record
            if (newRecord) {
                newRecord.addEventListener('click', function() {
                    offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
                    // Empty fields on offCanvas open
                    (offCanvasElement.querySelector('.dt-institu-name').value = ''),
                    (offCanvasElement.querySelector('.dt-cat-id').value = ''),
                    (offCanvasElement.querySelector('.dt-npsn').value = ''),
                    (offCanvasElement.querySelector('.dt-logo').value = ''),
                    (offCanvasElement.querySelector('.dt-imgs').value = ''),
                    (offCanvasElement.querySelector('.dt-addr').value = '');
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
                // institutionMARKID: {
                //     validators: {
                //         notEmpty: {
                //             message: 'The mark-id field is required'
                //         }
                //     }
                // }


                // basicEmail: {
                //     validators: {
                //         notEmpty: {
                //             message: 'The Email is required'
                //         },
                //         emailAddress: {
                //             message: 'The value is not a valid email address'
                //         }
                //     }
                // },
                // basicDate: {
                //     validators: {
                //         notEmpty: {
                //             message: 'Joining Date is required'
                //         },
                //         date: {
                //             format: 'MM/DD/YYYY',
                //             message: 'The value is not a valid date'
                //         }
                //     }
                // },
                // basicSalary: {
                //     validators: {
                //         notEmpty: {
                //             message: 'Basic Salary is required'
                //         }
                //     }
                // }
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
                instance.on('plugins.message.placed', function(e) {
                    if (e.element.parentElement.classList.contains('input-group')) {
                        e.element.parentElement.insertAdjacentElement('afterend', e
                            .messageElement);
                    }
                });
            }
        });

        // FlatPickr Initialization & Validation
        const flatpickrDate = document.querySelector('[name="basicDate"]');

        if (flatpickrDate) {
            flatpickrDate.flatpickr({
                enableTime: false,
                // See https://flatpickr.js.org/formatting/
                dateFormat: 'm/d/Y',
                // After selecting a date, we need to revalidate the field
                onChange: function() {
                    fv.revalidateField('basicDate');
                }
            });
        }



        // ////////////////////////////////////////////////////// DATATABLES /////////////////////////////////////////////////////////////

        var dt_fixedheader = $('.dt-fixedheader'),
            dt_basic;

        dt_basic = $('#DataTables_Table_1').DataTable({
            "paging": true,
            "searching": true,
            "pageLength": 10,
            "lengthMenu": [10, 25, 50, 75, 100, 150, 200, 250, 300, 350, 400],
            "info": true,
            "ordering": true,
            "columnDefs": [{
                    orderable: false,
                    targets: [0], // Disable sorting on the first and second columns
                    className: 'control',
                    // "width": "auto"
                },
                {
                    targets: 1, // Target the second column (index 1)
                    width: '18px', // Set the width of the second column
                },
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


        // Delete Record
        $('#DataTables_Table_1 tbody').on('click', '.delete-record', function() {
            var confirmed = confirm("Are you sure you want to this records?");
            if (confirmed) {
                dt_basic.row($(this).parents('tr')).remove().draw();
            }

        });

        // ResetRecord
        $('.reset-record').on('click', function() {
            var confirmed = confirm("Are you sure you want to delete all records?");
            if (confirmed) {
                var tbody = $('#DataTables_Table_1 tbody');
                tbody.empty();
                tbody.append('<tr><td colspan="8" class="text-center">No data</td></tr>');
            }
        });


        // setDropZone();

        // Add New record
        // ? Remove/Update this code as per your requirements
        // var count = 101;
        var count = dt_basic.rows().count() + 1;

        // Function to convert an image file to Base64 format
        function imageToBase64(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = () => resolve(reader.result);
                reader.onerror = error => reject(error);
            });
        }

        // On form submit, if form is valid
        fv.on('core.form.valid', async function() {
            var $new_actions = `
    <div class="d-inline-block">
      <a href="javascript:;"
        class="btn btn-sm btn-text-primary rounded-pill btn-icon dropdown-toggle hide-arrow"
        data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
      <div class="dropdown-menu dropdown-menu-end m-0">
        <a href="javascript:;"
          class="dropdown-item btn-text-success btn-sm mdi mdi-image-text">
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
            var $new_number = count;
            var $new_name = $('.add-new-record .dt-institu-name').val();
            var $new_cat_id = $('.add-new-record .dt-cat-id').val();
            var $new_npsn = $('.add-new-record .dt-npsn').val();
            var $new_logo = '';
            // var $new_imgs = $('.add-new-record .dt-imgs').val();
            var $new_addr = $('.add-new-record .dt-addr').val();

            // Convert the logo image file to Base64 format
            const logoFile = $('.add-new-record .dt-logo')[0].files[0];
            if (logoFile) {
                try {
                    const logoBase64 = await imageToBase64(logoFile);
                    $new_logo = `<img src="${logoBase64}" alt="Logo 1" style="height: 24px; width: 24px;">`;
                } catch (error) {
                    console.error('Error converting logo image to Base64:', error);
                }
            }


            var $new_imgs = '';
            var imageFiles = $('.add-new-record .dt-imgs')[0].files;
            // Convert each image file to Base64 format
            if (imageFiles.length > 0) {
                for (var i = 0; i < imageFiles.length; i++) {
                    try {
                        var imageBase64 = await imageToBase64(imageFiles[i]);
                        var marginRight = (i === imageFiles.length - 1) ? '' : 'margin-right: 0.5rem;';
                        $new_imgs +=
                            `<img src="${imageBase64}" alt="Image ${i + 1}" style="height: 24px; width: 24px; ${marginRight}">`;
                    } catch (error) {
                        console.error(`Error converting image ${i + 1} to Base64:`, error);
                    }
                }
            }



            if ($new_name != '') {
                dt_basic.row
                    .add({
                        action: $new_actions, // Column '0': Actions
                        no: $new_number, // Column '1': NO.
                        name: $new_name, // Column '2': NAME
                        cat_id: $new_cat_id, // Column '3': CAT
                        npsn: $new_npsn, // Column '4': NPSN
                        logo: $new_logo, // Column '5': LOGO
                        images: $new_imgs, // Column '6': IMAGES
                        addr: $new_addr // Column '7': ADDR
                    })
                    .draw();

                dt_basic
                    .order([
                        [1, 'asc']
                    ]) // Sort by the 'NO.' column in ascending order (index 1)
                    .draw();

                count++;

                // Hide offcanvas using javascript method
                offCanvasEl.hide();
            }


        });



        /////// DROPZONE
        function setDropZone() {
            Dropzone.autoDiscover = false;
            const dropzones = []
            $('.dropzone').each(function(i, el) {
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
                myDropzone.on("addedfile", function(file) {
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



        // });
    </script>


    <script>
        $(document).ready(() => {

        })
    </script>
@endsection
