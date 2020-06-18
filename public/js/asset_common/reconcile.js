$('a#register_payment').addClass('mm-active');
// console.log($('a#register_payment').val);

$("#key").change(function() {
    var value = $("#key").val();
    $("input[name='filter']").val(value);
});

const swalWithBootstrapButtons = swal.mixin({
    confirmButtonClass: 'btn btn-success',
    cancelButtonClass: 'btn btn-danger',
    buttonsStyling: false,
})

function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

$(document).ready(function($) {
    $('body').on('click','.table-row',function(e){
        var code= $(this).children("td.cell_account_code").html();
        var date= $(this).children("td").find("input.date").val();
        var name= $(this).children("td").find("input.name").val();
        var amount= $(this).children("td").find("input.amount").val();
        if (date !== undefined){
            $('.account_line').append(`
                <tr class="mv_line">
                    <td class="cell_account_code">`+code+`</td>
                    <td class="cell_due_date">
                        `+date+`
                        <input type="hidden" class="date" value="`+date+`">
                    </td>
                    <td class="cell_label">
                        `+name+`
                        <input type="hidden" class="name" name="invoice_no[]" value="`+name+`">
                    </td>
                    <td class="cell_left">
                        <span class="">
                            <span class="line_amount">
                                Rp. `+formatNumber(amount)+`
                                <input type="hidden" class="amount" name="invoice_no[]" value="`+amount+`">
                            </span>
                        </span>
                    </td>
                    <td class="cell_right">
                    </td>
                    <td class="cell_info_popover">
                        <span class="line_info_button fa fa-info-circle"></span>
                    </td>
                </tr>
            `);
            $(this).remove();
            let total = parseInt($("input[name='amount_total']").val());
            total += parseInt(amount);
            $('#total.grand_total').html("Rp. "+formatNumber(total));
            $("input[name='amount_total']").val(total);
        }
    });

    $('body').on('click','.mv_line',function(e){
        var code= $(this).children("td.cell_account_code").html();
        var date= $(this).children("td").find("input.date").val();
        var name= $(this).children("td").find("input.name").val();
        var amount= $(this).children("td").find("input.amount").val();
        $('.item_line').append(`
            <tr class="table-row"> 
            <td class="cell_account_code">`+code+`</td>
            <td class="cell_due_date">
                `+date+`
                <input type="hidden" class="date" name="date[]" value="`+date+`">
            </td>
            <td class="cell_label">
                `+name+`
                <input type="hidden" class="name" name="name[]" value="`+name+`">
            </td>
            <td class="cell_left" id="payment-debit">
                Rp. `+formatNumber(amount)+`
                <input type="hidden" class="amount" name="amount[]" value="`+amount+`">
            </td>
            <td class="cell_right" id="payment-credit">
            </td>
            <td class="cell_info_popover">
            </td>
            <tr> 
        `);
        $(this).remove();
        let total = parseInt($("input[name='amount_total']").val());
        total -= parseInt(amount);
        $('#total.grand_total').html("Rp. "+formatNumber(total));
        $("input[name='amount_total']").val(total);
    });

    $("button[type='submit']").click(function(e){
        let total = parseInt($("input[name='amount_total']").val());
        if (0 > total){
            e.preventDefault();
            swalWithBootstrapButtons(
                    'Something Went Wrong',
                    'insufficient partner balance',
                    'error'
                )
        }
        let credit = $("input[name='payment-credit']").val();
        if (credit == total){
            e.preventDefault();
            swalWithBootstrapButtons(
                    'Something Went Wrong',
                    'invoice Record Is Empty',
                    'error'
                )
        }
    });
});