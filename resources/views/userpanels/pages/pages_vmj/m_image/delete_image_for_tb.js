document.addEventListener('DOMContentLoaded', function () {
    setTimeout(() => {
        $('.delete-record').on('click', function () {
            // Delete Record
            var confirmed = confirm("Are you sure you want to delete this records?");
            if (confirmed) {

                // Send AJAX request to delete the mark record
                var imgID = $(this).attr('img_id_value');
                $.ajax({
                    url: '/m-image/delete-img',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        img_id: imgID
                    },
                    success: function (response) {
                        // Handle success response, e.g., reload the table or show a success message
                        console.log('Image deleted successfully');
                        dt_basic.row($(this).parents('tr')).remove().draw();
                        location.reload(); // Reload the page to update the table
                    },
                    error: function (error) {
                        // Handle error response, e.g., show an error message
                        console.log('Error deleting image:', error);
                    }
                });
            }


        });
    }, 200);

});
