$('a#setting').addClass('mm-active');
$('a#portal').addClass('mm-active');

$(document).ready(function($) {
    $(".table-row").click(function() {
        window.document.location = $(this).data("href");
    });
});

$("#key").change(function () {
    var value = $("#key").val();
    $("input[name='filter']").val(value);
});
