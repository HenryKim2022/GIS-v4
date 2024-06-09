document.addEventListener('DOMContentLoaded', function () {
    const modalSelector = document.getElementById('addCatModalTB');
    const modalToShow = new bootstrap.Modal(modalSelector);
    const targetedModalForm = document.querySelector('#addCatModalTB #addCatForm');

    if (modalSelector) {
        setTimeout(() => {
            $('.reset-all-categories-record').on('click', function () {
                // Delete Record
                var confirmed = confirm("Are you sure you want to reset all of categories records?");
                if (confirmed) {

                    // Send AJAX request to reset the marks record
                    $.ajax({
                        url: '/m-categories/reset',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            action: "reset-all-categories-record"
                        },
                        success: function (response) {
                            // Handle success response, e.g., reload the table or show a success message
                            console.log('Category reset successfully');

                            var tbody = $('#DataTables_Table_1 tbody');
                            tbody.empty();
                            tbody.append('<tr><td colspan="8" class="text-center">No data available in table</td></tr>');
                        },
                        error: function (error) {
                            // Handle error response, e.g., show an error message
                            console.log('Error deleting categories:', error);
                        }
                    });
                }


            });
        }, 200);


    }

});
