$('a#invoices').addClass('mm-active');
$('a#invoicing').addClass('mm-active');

$(document).ready(function($) {
    $(".table-row").click(function() {
        window.document.location = $(this).data("href");
    });
});

$("#key").change(function () {
    var value = $("#key").val();
    $("input[name='filter']").val(value);
});

function pdf() {
    window.print();
}

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
            $("#client").val(result.data.name);
        }
    })
};
