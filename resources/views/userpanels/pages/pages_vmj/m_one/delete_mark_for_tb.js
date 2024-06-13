document.addEventListener('DOMContentLoaded', function () {
    whichModal = "deleteMarkModalTB";
    const modalSelector = document.querySelector('#' + whichModal);
    const modalToShow = new bootstrap.Modal(modalSelector);

    setTimeout(() => {
        $('.delete-record').on('click', function () {
            var markID = $(this).attr('mark_id_value');
            $('#' + whichModal + ' #mark_id').val(markID);
            modalToShow.show();

            const modalDeleteImageTBCancelBtn = $(document.querySelector('#' + whichModal)).find('#cancel_modaldeleteMarkModalTB')[0];
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
//                 var markID = $(this).attr('mark_id_value');
//                 $.ajax({
//                     url: '/m-mark/delete-mark',
//                     method: 'POST',
//                     headers: {
//                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                     },
//                     data: {
//                         mark_id: markID
//                     },
//                     success: function (response) {
//                         // Handle success response, e.g., reload the table or show a success message
//                         console.log('Mark deleted successfully');
//                         dt_basic.row($(this).parents('tr')).remove().draw();
//                         location.reload(); // Reload the page to update the table
//                     },
//                     error: function (error) {
//                         // Handle error response, e.g., show an error message
//                         console.log('Error deleting mark:', error);
//                     }
//                 });
//             }


//         });
//     }, 200);

// });
