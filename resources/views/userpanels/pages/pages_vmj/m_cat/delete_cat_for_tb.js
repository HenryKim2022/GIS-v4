document.addEventListener('DOMContentLoaded', function () {
    whichModal = "deleteCatModalTB";
    const modalSelector = document.querySelector('#' + whichModal);
    const modalToShow = new bootstrap.Modal(modalSelector);

    setTimeout(() => {
        $('.delete-record').on('click', function () {
            var catID = $(this).attr('cat_id_value');
            $('#' + whichModal + ' #cat_id').val(catID);
            modalToShow.show();

            const modalDeleteMarkMAPSCancelBtn = $(document.querySelector('#' + whichModal)).find('#cancel_modaldeleteCatModalTB')[0];
            modalDeleteMarkMAPSCancelBtn.addEventListener('click', function () {
                modalToShow.hide();
            });

        });
    }, 200);

});
