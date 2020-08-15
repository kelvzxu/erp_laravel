const exceptiondialog = swal.mixin({
    confirmButtonClass: 'btn btn-success',
    cancelButtonClass: 'btn btn-danger',
    buttonsStyling: false,
})

$("a.development").click(function(e) {
    e.preventDefault();
    exceptiondialog(
            'Something Went Wrong',
            'This feature is not yet available for the current version.',
            'warning'
        )
});

function readFile(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            var htmlPreview =
                '<img width="100" src="' +
                e.target.result +
                '" />' +
                "<p>" +
                input.files[0].name +
                "</p>";
            console.log(e.target.result);
            var wrapperZone = $(input).parent();
            var previewZone = $(input)
                .parent()
                .parent()
                .find(".preview-zone");
            var boxZone = $(input)
                .parent()
                .parent()
                .find(".preview-zone")
                .find(".box")
                .find(".box-body");

            // wrapperZone.removeClass("dragover");
            //previewZone.removeClass("hidden");
            //boxZone.empty();
            console.log(e.target.result);
            boxZone.append(htmlPreview);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function reset(e) {
    e.wrap("<form>")
        .closest("form")
        .get(0)
        .reset();
    e.unwrap();
}

$("#dropzoneimg").change(function () {
    readFile(this);
});

$(".dropzone-wrapper").on("dragover", function (e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).addClass("dragover");
});

$(".dropzone-wrapper").on("dragleave", function (e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).removeClass("dragover");
});

function unactive(){
    $('.menu-item').removeClass('mm-active');
}
$('#dialog-close').click(function(){
    $('.dropdown-menu').removeClass('show');
});
$.ajax  ({
    url: "/api/employee/search",
    type: 'post',
    dataType: 'json',
    data :{
        'email':$("input[name='current_email']").val()
    },
    success: function (result) {
        if (result.data.photo == null)
        {
            $('div.profile').append(`
            <img width="42" id="picture_profile" class="o_m3o_avatar" height="50px" src="/images/icons/avatar.png"
                alt="">
                                `);
        }else{
            $('div.profile').append(`
                <img width="42" id="picture_profile" class="o_m3o_avatar" src="/uploads/Employees/`+result.data.photo+`"
                    alt="">
                                    `);
        }
        $(".widget-subheading").append(`<pre>`+result.data.jobs_name+`</pre>`)
        $("#image").val(result.data.photo);
    }
})

$(".remove-preview").on("click", function () {
    var boxZone = $(this)
        .parents(".preview-zone")
        .find(".box-body");
    var previewZone = $(this).parents(".preview-zone");
    var dropzone = $(this)
        .parents(".form-group")
        .find(".dropzone");
    boxZone.empty();
    previewZone.addClass("hidden");
    reset(dropzone);
}); 

$(document).ready(function () {
    $(document).on('change', '.btn-file :file', function () {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function (event, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = label;

        if (input.length) {
            input.val(log);
        } else {
            // if (log) alert(log);
        }

    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            $('#filename').val(input.files[0].name);
            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function () {
        readURL(this);
    });
});