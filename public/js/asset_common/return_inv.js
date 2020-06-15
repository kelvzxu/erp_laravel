$('#report-return_inv').addClass('mm-active');
$('a#sales_report').addClass('mm-active');
const swalWithBootstrapButtons = swal.mixin({
    confirmButtonClass: 'btn btn-success',
    cancelButtonClass: 'btn btn-danger',
    buttonsStyling: false,
})

$(document).ready(function($) {
    $(".table-row").click(function() {
        window.document.location = $(this).data("href");
    });
});

if ($("#client_id").val() !== undefined){
    $.ajax  ({
        url: "/api/customer/search",
        type: 'post',
        dataType: 'json',
        data :{
            'id': $("#client_id").val()
        },
        success: function (result) {
            $("#client").html(result.data.name);
        }
    });
}
      
$("input[name='return_qty[]']").keyup(function(e){
    e.preventDefault();
    var old_qty= parseInt($(this).closest('tr').find("input[name='buy_qty[]']").val());
    var return_qty = parseInt($(this).val());
    if (return_qty > old_qty){
        $(this).val('0');
        swalWithBootstrapButtons(
            'Something Wrong',
            'quantity retur cannot be greater than quantity order',
            'error'
        )
    }
})