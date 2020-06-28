$.ajax  ({
    url: "/api/currency",
    type: 'get',
    dataType: 'json',
    success: function (result) {
        let currency= result;
        $.each(currency, function (i, data) {
            $('#currency_id').append(`
            <option value="`+data.id+`">`+data.currency_name+` (`+data.symbol+`)</option>
            `);
        });
    }
});
$.ajax  ({
    url: "/api/tz",
    type: 'get',
    dataType: 'json',
    success: function (result) {
        let currency= result;
        $.each(currency, function (i, data) {
            $('#tz').append(`
            <option value="`+data.timezone+`">`+data.timezone+`</option>
            `);
        });
    }
});
$.ajax  ({
    url: "/api/lang",
    type: 'get',
    dataType: 'json',
    success: function (result) {
        let lang= result;
        $.each(lang, function (i, data) {
            $('#lag').append(`
            <option value="`+data.id+`">`+data.lang_name+`</option>
            `);
        });
    }
});
$.ajax  ({
    url: "/api/industry",
    type: 'get',
    dataType: 'json',
    success: function (result) {
        let industry= result;
        $.each(industry, function (i, data) {
            $('#industry_id').append(`
            <option value="`+data.id+`">`+data.industry_name+`</option>
            `);
        });
    }
});
$.ajax  ({
    url: "/api/country",
    type: 'get',
    dataType: 'json',
    success: function (result) {
        let country= result;
        $.each(country, function (i, data) {
            $('#country').append(`
            <option value="`+data.id+`">`+data.country_name+`</option>
            `);
            $('#nationality').append(`
            <option value="`+data.id+`">`+data.country_name+`</option>
            `);
            $('#country_of_birth').append(`
            <option value="`+data.id+`">`+data.country_name+`</option>
            `);
        });
    }
});
function state(){
    $.ajax  ({
        url: "/api/state",
        type: 'get',
        dataType: 'json',
        success: function (result) {
            let state = result;
            $.each(state, function (i, data) {
                $('#state').append(`
                <option value="`+data.id+`">`+data.state_name+`</option>
                `);
            });
        }
    });
}
function removestate(){
    $('#state')
        .find('option')
        .remove()
        .end()
}
function statebycountry(){
    $.ajax  ({
        url: "/api/state/search",
        type: 'get',
        dataType: 'json',
        data :{
            'data': $("#country").val()
        },
        success: function (result) {
            let state = result.data;
            $.each(state, function (i, data) {
                // console.log(data.id);
                $('#state').append(`
                <option value="`+data.id+`">`+data.state_name+`</option>
                `);
            });
        }
    });
}
state();
$("#country").change(function() {
    removestate();
    var status = $("#country").val();
    if (status == "NULL"){
        state();
    }
    else{
        statebycountry();
    }
});