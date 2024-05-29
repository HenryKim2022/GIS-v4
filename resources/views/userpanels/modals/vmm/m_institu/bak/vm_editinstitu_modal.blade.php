<div class="offcanvas offcanvas-end" id="edit-old-record">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="exampleModalLabel">Edit Record</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
        <form class="edit-old-record pt-0 row g-3" id="form-edit-old-record" onsubmit="return false">
            <div class="col-sm-12">
                <div class="input-group input-group-merge">
                    <span id="institutionName2" class="input-group-text"><i
                            class="mdi mdi-account-outline"></i></span>
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="institutionName" class="form-control dt-edit-institu-name"
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
                            class="form-control dt-edit-cat-id" placeholder="Categories" aria-label="Categories"
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
                            class="form-control dt-edit-npsn" placeholder="NPSN" aria-label="NPSN"
                            aria-describedby="institutionNPSN2" />
                        <label for="institutionNPSN">NPSN</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="input-group input-group-merge">
                    <span id="institutionEditLOGO2" class="input-group-text"><i
                            class="mdi mdi-briefcase-outline"></i></span>
                    <div class="form-floating form-floating-outline">
                        <input type="file" id="institutionEditLOGO" name="institutionEditLOGO"
                            class="form-control dt-edit-logo" placeholder="LOGO" aria-label="LOGO"
                            aria-describedby="institutionEditLOGO2" />
                        <label for="institutionEditLOGO">LOGO</label>
                    </div>
                </div>
                <div class="logo-edit-preview-container mt-2 mb-2 d-flex justify-content-center"
                    id="editLogoPreview">
                    <img src="public/img/noimage.png" alt="" class="edit-logo-preview"
                        style="height: 96px; width: 96px;">
                </div>
                <script>
                    var editLogoPreview = document.getElementsByClassName('logo-edit-preview-container');
                    var editLogoInput = document.getElementById('institutionEditLOGO');
                    editLogoInput.addEventListener('change', function() {
                      const file = this.files[0];
                      if (file && file.type.startsWith('image/')) {
                        const img = document.createElement('img');
                        img.src = URL.createObjectURL(file);

                        img.onload = function() {
                          for (var i = 0; i < editLogoPreview.length; i++) {
                            editLogoPreview[i].querySelector('.edit-logo-preview').src = img.src;
                          }
                        };
                      } else {
                        for (var i = 0; i < editLogoPreview.length; i++) {
                          editLogoPreview[i].querySelector('.edit-logo-preview').src = 'public/img/noimage.png';
                        }
                      }
                    });
                </script>
            </div>

            <div class="col-sm-12">
                <div class="input-group input-group-merge">
                    <span id="institutionEditIMGS2" class="input-group-text"><i
                            class="mdi mdi-briefcase-outline"></i></span>
                    <div class="form-floating form-floating-outline">
                        <input type="file" id="institutionEditIMGS" name="institutionEditIMGS"
                            class="form-control dt-edit-imgs" placeholder="IMAGES" aria-label="IMAGES"
                            aria-describedby="institutionEditIMGS2" multiple />
                        <label for="institutionEditIMGS">IMAGES</label>
                    </div>
                </div>
                <div class="carousel slide mt-2 mb-2" id="editImagesPreview" data-bs-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators list-unstyled" id="carouselIndicatorsEdit"></ol>

                    <!-- Slides -->
                    <div class="carousel-inner d-flex justify-content-center" id="carouselInnerEdit">
                        <img src="public/img/noimage.png" alt="" class="edit-logo-preview"
                            style="height: 96px; width: 96px;">
                    </div>


                    <!-- Controls -->
                    <a class="carousel-control-prev" href="#editImagesPreview" role="button"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#editImagesPreview" role="button"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
                <script>
                    var editImagesInput = document.getElementById('institutionEditIMGS');
                    var carouselIndicatorsEdit = document.getElementById('carouselIndicatorsEdit');
                    var carouselInnerEdit = document.getElementById('carouselInnerEdit');

                    editImagesInput.addEventListener('change', function() {
                        carouselIndicatorsEdit.innerHTML = ''; // Clear previous indicators
                        carouselInnerEdit.innerHTML = ''; // Clear previous slides

                        if (this.files.length === 0) {
                            var defaultImage = document.createElement('img');
                            defaultImage.src = 'public/img/noimage.png';
                            defaultImage.alt = '';
                            defaultImage.classList.add('edit-image-preview');
                            defaultImage.style.height = '96px';
                            defaultImage.style.width = '96px';

                            carouselInnerEdit.appendChild(defaultImage);
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
                                indicator.setAttribute('data-bs-target', '#editImagesPreview');
                                indicator.setAttribute('data-bs-slide-to', i.toString());
                                if (i === 0) {
                                    indicator.classList.add('active');
                                }

                                carouselInnerEdit.appendChild(img);
                                carouselIndicatorsEdit.appendChild(indicator);
                            }
                        }

                        var defaultContent = document.querySelector('#carouselInnerEdit .edit-image-preview');
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

                        var sliderContainer = document.querySelector('#editImagesPreview .carousel-inner');
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
                        <label id="modalEditImage" name="modalEditImage" for="institutionEditIMGS"
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
                                    <input class="dt-edit-imgs" id="institutionEditIMGS" name="institutionEditIMGS"
                                        type="file" aria-label="IMAGES"
                                        aria-describedby="institutionEditIMGS2" multiple />
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
            <div class="col-sm-12">
                <div class="input-group input-group-merge">
                    <span id="institutionEditADDR2" class="input-group-text"><i
                            class="mdi mdi-briefcase-outline"></i></span>
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="institutionEditADDR" name="institutionEditADDR"
                            class="form-control dt-edit-addr" placeholder="INST-ADDRESS" aria-label="INST-ADDRESS"
                            aria-describedby="institutionEditADDR2" />
                        <label for="institutionEditADDR">INST-ADDRESS</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
                <button type="reset" class="btn btn-outline-secondary"
                    data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </form>
    </div>
</div>
