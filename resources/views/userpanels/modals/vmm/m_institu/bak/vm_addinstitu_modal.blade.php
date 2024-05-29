<div class="offcanvas offcanvas-end" id="add-new-record">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="exampleModalLabel">Add New-Record</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
        <form class="add-new-record pt-0 row g-3" id="form-add-new-record" onsubmit="return false">
            <div class="col-sm-12">
                <div class="input-group input-group-merge">
                    <span id="institutionName2" class="input-group-text"><i class="mdi mdi-account-outline"></i></span>
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="institutionName" class="form-control dt-add-institu-name"
                            name="institutionName" placeholder="e.g SMA N 1 TOBOALI" aria-label="SMA N 1 TOBOALI"
                            aria-describedby="institutionName2" />
                        <label for="institutionName">INSTITUTION NAME</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="input-group input-group-merge">
                    {{-- <span id="institutionCATID2" class="input-group-text"><i
                            class="mdi mdi-briefcase-outline"></i></span>
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="institutionCATID" name="institutionCATID"
                            class="form-control dt-add-cat-id" placeholder="Categories" aria-label="Categories"
                            aria-describedby="institutionCATID2" />
                        <label for="institutionCATID">CAT-ID</label>
                    </div> --}}

                    <div class="form-floating form-floating-outline">
                        <select class="select2 form-select form-select-lg dt-add-cat-id" data-allow-clear="true" id="institutionCATID" name="institutionCATID" aria-describedby="institutionCATID2">
                            <option value="AK">Alaska</option>
                            <option value="WA">WA</option>
                            <option value="NA">NA</option>
                            <option value="RA">RA</option>
                        </select>
                        <label for="institutionCATID">CATEGORY</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="input-group input-group-merge">
                    <span id="institutionNPSN2" class="input-group-text"><i
                            class="mdi mdi-briefcase-outline"></i></span>
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="institutionNPSN" name="institutionNPSN"
                            class="form-control dt-add-npsn" placeholder="e.g 0000001" aria-label="0000001"
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
                            class="form-control dt-add-logo" placeholder="e.g LOGO.png" aria-label="LOGO"
                            aria-describedby="institutionLOGO2" />
                        <label for="institutionLOGO">LOGO</label>
                    </div>
                </div>
                <div class="logo-add-preview-container mt-2 mb-2 d-flex justify-content-center" id="addLogoPreview">
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
                            class="form-control dt-add-imgs" placeholder="IMAGES" aria-label="IMAGES"
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
                            class="form-control dt-add-imgs" placeholder="e.g IMAGES.png" aria-label="IMAGES"
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
                    <a class="carousel-control-prev" href="#addImagesPreview" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#addImagesPreview" role="button" data-bs-slide="next">
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
                                    <input class="dt-add-imgs" id="institutionIMGS" name="institutionIMGS"
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
                            class="form-control dt-add-addr" placeholder="e.g Jl. Jalan Simpang, Desa Balonggede, Kota Bandung, Prov. West Java (40251), Negara Indonesia" aria-label="INST-ADDRESS"
                            aria-describedby="institutionADDR2" />
                        <label for="institutionADDR">ADDRESS</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="input-group input-group-merge">
                    {{-- <span id="institutionMARKID2" class="input-group-text"><i
                            class="mdi mdi-briefcase-outline"></i></span>
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="institutionMARKID" name="institutionMARKID" class="form-control dt-mark-id"
                            placeholder="MARK-ID" aria-label="MARK-ID"
                            aria-describedby="institutionMARKID2" />
                        <label for="institutionMARKID">MARK-ID</label>
                    </div> --}}

                </div>
            </div>
            <div class="col-sm-12">
                <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                        <select class="select2 form-select form-select-lg dt-add-lat" data-allow-clear="true" id="institutionMARKID" name="institutionMARKID" aria-describedby="institutionMARKID2">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        <label for="institutionMARKID">MARK-ID</label>
                    </div>
                </div>
            </div>


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
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </form>
    </div>
</div>
