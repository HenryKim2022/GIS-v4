document.addEventListener('DOMContentLoaded', function () {
    whichModal = "deleteUserModalTB";
    const modalSelector = document.querySelector('#' + whichModal);
    const modalToShow = new bootstrap.Modal(modalSelector);

    setTimeout(() => {
        $('.delete-record').on('click', function () {
            var userID = $(this).attr('user_id_value');
            $('#' + whichModal + ' #user_id').val(userID);
            modalToShow.show();

            const modalDeleteImageTBCancelBtn = $(document.querySelector('#' + whichModal)).find('#cancel_modaldeleteUserModalTB')[0];
            modalDeleteImageTBCancelBtn.addEventListener('click', function () {
                modalToShow.hide();
            });

        });
    }, 200);

});



// document.addEventListener('DOMContentLoaded', function () {
//     setTimeout(() => {
//         $('.delete-record').on('click', function () {
//             // Delete Record
//             var confirmed = confirm("Are you sure you want to delete this records?");
//             if (confirmed) {

//                 // Send AJAX request to delete the mark record
//                 var userID = $(this).attr('user_id_value');
//                 $.ajax({
//                     url: '/m-userlist/delete-u',
//                     method: 'POST',
//                     headers: {
//                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                     },
//                     data: {
//                         user_id: userID
//                     },
//                     success: function (response) {
//                         // Handle success response, e.g., reload the table or show a success message
//                         console.log('User deleted successfully');
//                         dt_basic.row($(this).parents('tr')).remove().draw();
//                         location.reload(); // Reload the page to update the table
//                     },
//                     error: function (error) {
//                         // Handle error response, e.g., show an error message
//                         console.log('Error deleting user:', error);
//                     }
//                 });
//             }


//         });
//     }, 200);

// });
