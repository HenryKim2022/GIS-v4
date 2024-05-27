document.addEventListener('DOMContentLoaded', function () {
    const modalSelector = document.getElementById('addCatModalTB');
    const modalToShow = new bootstrap.Modal(modalSelector);
    const targetedModalForm = document.querySelector('#addCatModalTB #addCatForm');


    if (modalSelector) {
        setTimeout(() => {
            const saveRecordBtn = document.querySelector('#addCatModalTB #addCatForm .modal-cat-save-btn');
            if (saveRecordBtn) {
                saveRecordBtn.addEventListener('click', function () {
                    var catID = $('#modalEditcatID').val();
                    var catName = $('#modalEditCategoryName1').val(response.catName);

                    // Make an AJAX request to save the data
                    $.ajax({
                        url: '/m-categories/add-cat',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: {
                            catID: catID,
                            catName: catName
                        },
                        success: function (response) {
                            // Handle the success response
                            console.log('Data saved successfully:', response);
                            // Close the modal if needed
                            modalToShow.hide();
                            // Additional actions after saving the data
                        },
                        error: function (error) {
                            // Handle the error response
                            console.log('Error occurred while saving the data:', error);
                        }
                    });

                });
            }
        }, 200);



        // Form validation for Add new record
        const fv2 = FormValidation.formValidation(targetedModalForm, {
            fields: {
                modalEditCategoryName1: {
                    validators: {
                        notEmpty: {
                            message: 'The category name field is required'
                        }
                    }
                },
                bsvalidationcheckbox: {
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
                            case 'modalEditCategoryName1':
                                return '.form-control';
                            case 'bsvalidationcheckbox':
                                return '.form-check-input';
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

        const saveRecordBtn = document.querySelector('#addCatModalTB .modal-cat-save-btn');
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
    }

});
