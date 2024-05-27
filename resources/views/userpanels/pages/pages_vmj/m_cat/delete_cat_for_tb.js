document.addEventListener('DOMContentLoaded', function () {
    const modalSelector = document.getElementById('editCatModalTB');
    const modalToShow = new bootstrap.Modal(modalSelector);
    const targetedModalForm = document.querySelector('#editCatModalTB #editCatForm');


    if (modalSelector) {
        setTimeout(() => {
            $('.delete-record').on('click', function () {
                // Delete Record
                var confirmed = confirm("Are you sure you want to delete this records?");
                if (confirmed) {

                    // Send AJAX request to delete the mark record
                    var catD = $(this).attr('cat_id_value');
                    $.ajax({
                        url: '/m-categories/delete-cat',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            cat_id: catD
                        },
                        success: function (response) {
                            // Handle success response, e.g., reload the table or show a success message
                            console.log('Mark deleted successfully');
                            dt_basic.row($(this).parents('tr')).remove().draw();
                            // location.reload(); // Reload the page to update the table
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
