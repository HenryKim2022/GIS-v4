document.addEventListener('DOMContentLoaded', function () {
    // const modalSelector = document.getElementById('editInstituModalTB');
    // const modalToShow = new bootstrap.Modal(modalSelector);
    // const targetedModalForm = document.querySelector('#editMarkModalTB #editMarkForm');
    resetBtnSelector = document.querySelector('.reset-all-institutions-record');
    if (resetBtnSelector) {
        setTimeout(() => {
            $('.reset-all-institutions-record').on('click', function () {
                // Delete Record
                var confirmed = confirm("Are you sure you want to reset all of institution records?");
                if (confirmed) {

                    // Send AJAX request to reset the institution record
                    $.ajax({
                        url: '/m-inst/reset',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            action: "reset-all-institutions-record"
                        },
                        success: function (response) {
                            // Handle success response, e.g., reload the table or show a success message
                            console.log('Institution reset successfully');

                            var tbody = $('#DataTables_Table_1 tbody');
                            tbody.empty();
                            tbody.append('<tr><td colspan="8" class="text-center">No data available in table</td></tr>');
                        },
                        error: function (error) {
                            // Handle error response, e.g., show an error message
                            console.log('Error deleting institution:', error);
                        }
                    });
                }


            });
        }, 200);


    }

});
