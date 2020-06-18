$('a#register_payment').addClass('mm-active');
// console.log($('a#register_payment').val);

$("#key").change(function() {
    var value = $("#key").val();
    $("input[name='filter']").val(value);
});
$(document).ready(function($) {
    $(".table-row").click(function() {
        window.document.location = $(this).data("href");
    });
});