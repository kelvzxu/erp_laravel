$('a#partner').addClass('mm-active');

$("#key").change(function() {
    var value = $("#key").val();
    $("input[name='filter']").val(value);
});

$(document).ready(function($) {
    $(".table-row").click(function() {
        window.document.location = $(this).data("href");
    });
});