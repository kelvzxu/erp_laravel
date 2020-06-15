$('a#purchases_orders').addClass('mm-active');

$(document).ready(function($) {
    $(".table-row").click(function() {
        window.document.location = $(this).data("href");
    });
});

$("#key").change(function() {
    var value = $("#key").val();
    $("input[name='filter']").val(value);
});

if ($("#client_id").val() !== undefined){
    $.ajax  ({
        url: "/api/partner/search",
        type: 'post',
        dataType: 'json',
        data :{
            'id': $("#client_id").val()
        },
        success: function (result) {
            $("#client").val(result.data.partner_name);
        }
    });
}