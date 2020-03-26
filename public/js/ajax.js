$.ajax  ({
    url: 'api/country',
    type: 'get',
    dataType: 'json',
    success: function (result) {
        console.log(result);
        let hotel = result;
        $.each(hotel, function (i, data) {
            console.log('ajax ok');
            $('#country').append(console.log("ok lagi")`
            <option value="`+data.id+`">`+country_name+`</option>
            `);
        });
    }
});
