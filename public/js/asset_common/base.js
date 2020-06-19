const swalWithBootstrapButtons = swal.mixin({
    confirmButtonClass: 'btn btn-success',
    cancelButtonClass: 'btn btn-danger',
    buttonsStyling: false,
})

$(".development").click(function() {
    e.preventDefault();
    swalWithBootstrapButtons(
            'Something Went Wrong',
            'This feature is not yet available for the current version.',
            'warning'
        )
});