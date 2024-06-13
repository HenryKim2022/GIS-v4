document.addEventListener('DOMContentLoaded', function () {
    const modalSelector = document.getElementById('editMarkModalTB');
    const modalToShow = new bootstrap.Modal(modalSelector);
    const targetedModalForm = document.querySelector('#editMarkModalTB #editMarkForm');


    if (modalSelector) {
        setTimeout(() => {
            $('.reset-all-marks-record').on('click', function () {
                // Delete Record
                var confirmed = confirm("Are you sure you want to reset all of mark records?");
                if (confirmed) {

                    // Send AJAX request to reset the marks record
                    $.ajax({
                        url: '/m-mark/reset',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            action: "reset-all-marks-record"
                        },
                        success: function (response) {
                            // Handle success response, e.g., reload the table or show a success message
                            console.log('Marks reset successfully');

                            var tbody = $('#DataTables_Table_1 tbody');
                            tbody.empty();
                            tbody.append('<tr><td colspan="8" class="text-center">No data available in table</td></tr>');
                        },
                        error: function (error) {
                            // Handle error response, e.g., show an error message
                            console.log('Error deleting mark:', error);
                        }
                    });
                }


            });
        }, 200);


    }

});
